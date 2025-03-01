<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = MenuItem::count();
        $pendingReservations = Reservation::where('status', 'pending')->count();
        $todayReservations = Reservation::whereDate('reservation_date', today())->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalItems',
            'pendingReservations',
            'todayReservations',
            'recentOrders'
        ));
    }
}
