<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Reservation::with('user');

    // Handle date filter
    if ($request->filled('date')) {
        $query->whereDate('reservation_date', $request->date);
    }

    // Handle status filter
    if ($request->filled('status') && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    // Handle search
    if ($request->filled('search')) {
        $searchTerm = "%{$request->search}%";
        $query->where(function($q) use ($searchTerm) {
            $q->where('name', 'like', $searchTerm)
              ->orWhere('email', 'like', $searchTerm)
              ->orWhere('phone', 'like', $searchTerm);
        });
    }

    // Handle sorting
    $sortField = $request->input('sort_by', 'reservation_date');
    $sortDirection = $request->input('sort_direction', 'asc');

    // Validate sort field to prevent SQL injection
    $allowedSortFields = ['name', 'reservation_date', 'status', 'guests'];
    if (in_array($sortField, $allowedSortFields)) {
        $query->orderBy($sortField, $sortDirection);
    } else {
        $query->orderBy('reservation_date', 'asc');
    }

    $reservations = $query->paginate(10)->withQueryString();

    return view('admin.reservations.index', [
        'reservations' => $reservations,
        'filters' => [
            'date' => $request->date,
            'status' => $request->status,
            'search' => $request->search,
            'sort_by' => $sortField,
            'sort_direction' => $sortDirection
        ]
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'customer')->get();
            $tables = Table::where('status', 'available')->get();

        return view('admin.reservations.create', compact('users', 'tables'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1',
            'reservation_date' => 'required|date|after:now',
            'special_requests' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled',
            'table_id' => 'nullable|exists:tables,id',
        ]);

        // Convert reservation_date to DateTime
        $validatedData['reservation_date'] = Carbon::parse($request->reservation_date);

        // Set table number if table_id is provided
        if ($request->filled('table_id')) {
            $table = Table::findOrFail($request->table_id);
            $validatedData['table_number'] = $table->table_number;

            // Update table status to 'reserved'
            $table->update(['status' => 'reserved']);
        }

        $reservation = Reservation::create($validatedData);

        // Log the creation of a new reservation
        Log::info("New reservation created: #{$reservation->id} for {$reservation->name}");

        return redirect()
            ->route('admin.reservations.index')
            ->with('success', 'Reservation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservation->load('user');
        $availableTables = Table::where('status', 'available')
                              ->orWhere('table_number', $reservation->table_number)
                              ->get();

        return view('admin.reservations.show', compact('reservation', 'availableTables'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        $users = User::where('role', 'customer')->get();
        $availableTables = Table::where('status', 'available')
                              ->orWhere('table_number', $reservation->table_number)
                              ->get();

        return view('admin.reservations.edit', compact('reservation', 'users', 'availableTables'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validatedData = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1',
            'reservation_date' => 'required|date',
            'special_requests' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled',
            'table_id' => 'nullable|exists:tables,id',
        ]);

        // Handle status change
        $statusChanged = $reservation->status !== $request->status;
        $oldStatus = $reservation->status;

        // Convert reservation_date to DateTime
        $validatedData['reservation_date'] = Carbon::parse($request->reservation_date);

        // Handle table assignment change
        if ($reservation->table_number) {
            // If we're changing tables or removing table assignment
            if (!$request->filled('table_id') ||
                (Table::find($request->table_id)->table_number != $reservation->table_number)) {

                // Free up the old table
                Table::where('table_number', $reservation->table_number)
                     ->update(['status' => 'available']);
            }
        }

        // Assign new table if provided
        if ($request->filled('table_id')) {
            $table = Table::findOrFail($request->table_id);
            $validatedData['table_number'] = $table->table_number;

            // Update table status to 'reserved'
            $table->update(['status' => 'reserved']);
        } else {
            $validatedData['table_number'] = null;
        }

        // Update reservation
        $reservation->update($validatedData);

        // Log status change
        if ($statusChanged) {
            Log::info("Reservation #{$reservation->id} status changed from {$oldStatus} to {$request->status}");

            // Here you would typically notify the customer about their reservation status
            // For example, you might dispatch a job to send an email or SMS
            // NotificationService::sendStatusUpdate($reservation, $oldStatus);
        }

        return redirect()
            ->route('admin.reservations.index')
            ->with('success', 'Reservation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        // Free up the table if one was assigned
        if ($reservation->table_number) {
            Table::where('table_number', $reservation->table_number)
                 ->update(['status' => 'available']);
        }

        $reservation->delete();

        // Log the deletion
        Log::info("Reservation #{$reservation->id} deleted");

        return redirect()
            ->route('admin.reservations.index')
            ->with('success', 'Reservation deleted successfully.');
    }

    /**
     * Update the status of a reservation.
     */
    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $oldStatus = $reservation->status;
        $reservation->status = $request->status;

        // If cancelling a reservation, free up the table
        if ($request->status === 'cancelled' && $reservation->table_number) {
            Table::where('table_number', $reservation->table_number)
                 ->update(['status' => 'available']);
            $reservation->table_number = null;
        }

        $reservation->save();

        // Log status change
        Log::info("Reservation #{$reservation->id} status changed from {$oldStatus} to {$request->status}");

        // Here you would typically notify the customer about their reservation status
        // For example, you might dispatch a job to send an email or SMS
        // NotificationService::sendStatusUpdate($reservation, $oldStatus);

        return redirect()
            ->back()
            ->with('success', 'Reservation status updated successfully.');
    }

    /**
     * Get available tables for a specific date and time.
     */
    public function getAvailableTables(Request $request)
    {
        $request->validate([
            'reservation_date' => 'required|date',
            'guests' => 'required|integer|min:1'
        ]);

        $reservationDateTime = Carbon::parse($request->reservation_date);
        $guests = $request->guests;

        // Find tables that can accommodate the party size
        $tables = Table::where('capacity', '>=', $guests)
                      ->where('status', 'available')
                      ->get();

        // Get tables already reserved at this time (within 2 hours before/after)
        $reservedTableNumbers = Reservation::where('status', '!=', 'cancelled')
            ->whereDate('reservation_date', $reservationDateTime->toDateString())
            ->whereTime('reservation_date', '>=', $reservationDateTime->copy()->subHours(2)->toTimeString())
            ->whereTime('reservation_date', '<=', $reservationDateTime->copy()->addHours(2)->toTimeString())
            ->pluck('table_number')
            ->filter()
            ->toArray();

        // Filter out tables that are already reserved
        $availableTables = $tables->filter(function($table) use ($reservedTableNumbers) {
            return !in_array($table->table_number, $reservedTableNumbers);
        });

        return response()->json($availableTables);
    }

    /**
     * Export reservations to CSV.
     */
    public function export(Request $request)
    {
        $query = Reservation::with('user');

        // Apply the same filters as in index
        if ($request->has('date')) {
            $query->whereDate('reservation_date', $request->date);
        }

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $reservations = $query->get();

        $filename = 'reservations-' . Carbon::now()->format('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($reservations) {
            $file = fopen('php://output', 'w');

            // CSV Headers
            fputcsv($file, [
                'ID', 'Name', 'Email', 'Phone', 'Guests',
                'Reservation Date', 'Table', 'Status', 'Special Requests'
            ]);

            // CSV Data
            foreach ($reservations as $reservation) {
                fputcsv($file, [
                    $reservation->id,
                    $reservation->name,
                    $reservation->email,
                    $reservation->phone,
                    $reservation->guests,
                    $reservation->reservation_date,
                    $reservation->table_number ?? 'Not assigned',
                    ucfirst($reservation->status),
                    $reservation->special_requests ?? 'None'
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display dashboard statistics for reservations.
     */
    public function dashboard()
    {
        $today = Carbon::today();

        $stats = [
            'today' => Reservation::whereDate('reservation_date', $today)->count(),
            'upcoming' => Reservation::whereDate('reservation_date', '>', $today)
                                    ->where('status', '!=', 'cancelled')
                                    ->count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
            'total' => Reservation::count()
        ];

        // Get recent reservations
        $recentReservations = Reservation::with('user')
                                       ->orderBy('created_at', 'desc')
                                       ->limit(5)
                                       ->get();

        // Get today's reservations
        $todayReservations = Reservation::with('user')
                                      ->whereDate('reservation_date', $today)
                                      ->orderBy('reservation_date', 'asc')
                                      ->get();

        return view('admin.reservations.dashboard', compact('stats', 'recentReservations', 'todayReservations'));
    }

    /**
     * Bulk update reservation statuses.
     */
    // public function bulkUpdate(Request $request)
    // {
    //     $request->validate([
    //         'reservation_ids' => 'required|array',
    //         'reservation_ids.*' => 'exists:reservations,id',
    //         'status' => 'required|in:pending,confirmed,cancelled'
    //     ]);

    //     $count = 0;
    //     foreach ($request->reservation_ids as $id) {
    //         $reservation = Reservation::findOrFail($id);
    //         $oldStatus = $reservation->status;

    //         // Only update if status is changing
    //         if ($oldStatus !== $request->status) {
    //             $reservation->status = $request->status;

    //             // If cancelling, free up table
    //             if ($request->status === 'cancelled' && $reservation->table_number) {
    //                 Table::where('table_number', $reservation->table_number)
    //                      ->update(['status' => 'available']);
    //                 $reservation->table_number = null;
    //             }

    //             $reservation->save();

    //             // Log status change
    //             Log::info("Reservation #{$reservation->id} status bulk-changed from {$oldStatus} to {$request->status}");

    //             // Here you would typically notify the customer about their reservation status
    //             // NotificationService::sendStatusUpdate($reservation, $oldStatus);

    //             $count++;
    //         }
    //     }

    //     return redirect()
    //         ->back()
    //         ->with('success', "{$count} reservations updated successfully.");
    // }

    public function bulkUpdate(Request $request)
{
    $request->validate([
        'status' => 'required|in:confirmed,pending,cancelled',
        'reservation_ids' => 'required|array',
        'reservation_ids.*' => 'exists:reservations,id'
    ]);

    $status = $request->status;
    $reservationIds = $request->reservation_ids;

    try {
        Reservation::whereIn('id', $reservationIds)->update(['status' => $status]);

        return redirect()->route('admin.reservations.index')
            ->with('success', count($reservationIds) . ' reservations have been updated to ' . $status);
    } catch (\Exception $e) {
        return redirect()->route('admin.reservations.index')
            ->with('error', 'Failed to update reservations. Please try again.');
    }
}

    /**
     * Get time slot availability for a specific date.
     */
    public function getTimeSlotAvailability(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'guests' => 'required|integer|min:1'
        ]);

        $date = Carbon::parse($request->date)->startOfDay();
        $guests = $request->guests;

        // Restaurant opening hours (e.g., 11:00 AM to 10:00 PM)
        $openingTime = 11; // 11:00 AM
        $closingTime = 22; // 10:00 PM
        $timeSlotDuration = 1; // 1 hour slots

        $timeSlots = [];
        $totalTables = Table::where('capacity', '>=', $guests)->count();

        // Generate time slots
        for ($hour = $openingTime; $hour < $closingTime; $hour += $timeSlotDuration) {
            $slotTime = $date->copy()->addHours($hour);

            // Count reservations in this time slot (consider 2-hour dining period)
            $reservedTables = Reservation::where('status', '!=', 'cancelled')
                ->whereDate('reservation_date', $slotTime->toDateString())
                ->whereTime('reservation_date', '>=', $slotTime->copy()->subHours(1)->toTimeString())
                ->whereTime('reservation_date', '<', $slotTime->copy()->addHours(3)->toTimeString())
                ->count();

            $availableTables = $totalTables - $reservedTables;

            $timeSlots[] = [
                'time' => $slotTime->format('H:i'),
                'available' => $availableTables > 0,
                'remaining_tables' => max(0, $availableTables)
            ];
        }

        return response()->json($timeSlots);
    }


}
