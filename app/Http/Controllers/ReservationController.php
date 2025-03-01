<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return view('reservations.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1|max:20',
            'reservation_date' => 'required|date|after:now',
            'special_requests' => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);

        // Here you would typically check table availability and assign
        // You might want to make this more complex in a real application

        return redirect()->route('reservations.confirmed', $reservation)
            ->with('success', 'Your reservation has been submitted!');
    }

    public function confirmed(Reservation $reservation)
    {
        return view('reservations.confirmed', compact('reservation'));
    }
}
