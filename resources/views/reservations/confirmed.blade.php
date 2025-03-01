@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8 text-center">
                <div class="text-green-500 mb-4">
                    <!-- Success checkmark icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <h1 class="text-2xl font-bold text-gray-900 mb-2">
                    Reservation Confirmed!
                </h1>

                <p class="text-gray-600 mb-6">
                    Thank you for your reservation. We look forward to serving you!
                </p>

                <div class="bg-gray-50 p-6 rounded-lg text-left mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Reservation Details</h2>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Name</p>
                            <p class="font-medium">{{ $reservation->name }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Guests</p>
                            <p class="font-medium">{{ $reservation->guests }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Date & Time</p>
                            <p class="font-medium">{{ $reservation->reservation_date->format('F j, Y \a\t g:i A') }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Confirmation #</p>
                            <p class="font-medium">RES-{{ $reservation->id }}</p>
                        </div>
                    </div>

                    @if($reservation->special_requests)
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Special Requests</p>
                            <p class="font-medium">{{ $reservation->special_requests }}</p>
                        </div>
                    @endif
                </div>

                <p class="text-gray-600 mb-6">
                    A confirmation email has been sent to {{ $reservation->email }}.<br>
                    If you need to modify or cancel your reservation, please contact us at (123) 456-7890.
                </p>

                <div class="flex justify-center gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                        Back to Home
                    </a>
                    <a href="{{ route('menu.index') }}" class="inline-flex items-center px-4 py-2 border border-amber-600 text-base font-medium rounded-md text-amber-600 bg-white hover:bg-amber-600 hover:text-white">
                        View Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
