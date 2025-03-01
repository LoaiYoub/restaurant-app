@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-semibold text-gray-900 mb-6">Admin Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Stats Card - Total Menu Items -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-amber-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Total Menu Items
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $totalItems }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.menu-items.index') }}" class="font-medium text-amber-600 hover:text-amber-500">
                                View all
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats Card - Pending Reservations -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Pending Reservations
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $pendingReservations }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.reservations.index') }}" class="font-medium text-amber-600 hover:text-amber-500">
                                View all
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Stats Card - Today's Reservations -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">
                                        Today's Reservations
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900">
                                            {{ $todayReservations }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-5 py-3">
                        <div class="text-sm">
                            <a href="{{ route('admin.reservations.index') }}" class="font-medium text-amber-600 hover:text-amber-500">
                                View details
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Recent Orders
                    </h3>
                </div>
                <div class="bg-white overflow-hidden">
                    <ul class="divide-y divide-gray-200">
                        @forelse($recentOrders as $order)
                            <li>
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <div class="text-sm font-medium text-amber-600 truncate">
                                            Order #{{ $order->order_number }}
                                        </div>
                                        <div class="ml-2 flex-shrink-0 flex">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($order->status == 'completed') bg-green-100 text-green-800
                                                @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                                {{ $order->user ? $order->user->name : 'Guest' }}
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            <p>
                                                ${{ number_format($order->total, 2) }}
                                            </p>
                                            <p class="ml-4">
                                                {{ $order->created_at->format('M j, Y g:i A') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-4 sm:px-6 text-center text-gray-500">
                                No recent orders
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-8">
                <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Quick Actions
                    </h3>
                </div>
                <div class="px-4 py-5 sm:px-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.menu-items.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700">
                            Add Menu Item
                        </a>
                        <a href="{{ route('admin.reservations.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-
