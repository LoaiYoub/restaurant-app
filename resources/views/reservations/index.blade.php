@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:gap-12">
                <!-- Reservation Form -->
                <div class="md:w-1/2">
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">
                        Make a Reservation
                    </h1>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('reservations.store') }}" class="bg-white shadow-md rounded-lg p-6">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-medium mb-2">Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}" required>
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}" required>
                            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 text-sm font-medium mb-2">Phone</label>
                            <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('phone') }}" required>
                            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="guests" class="block text-gray-700 text-sm font-medium mb-2">Number of Guests</label>
                            <select name="guests" id="guests" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                            @error('guests')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-4">
                            <label for="reservation_date" class="block text-gray-700 text-sm font-medium mb-2">Date & Time</label>
                            <input type="datetime-local" name="reservation_date" id="reservation_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('reservation_date') }}" required>
                            @error('reservation_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="mb-6">
                            <label for="special_requests" class="block text-gray-700 text-sm font-medium mb-2">Special Requests</label>
                            <textarea name="special_requests" id="special_requests" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('special_requests') }}</textarea>
                            @error('special_requests')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Make Reservation
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Reservation Info -->
                <div class="mt-10 md:mt-0 md:w-1/2">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            Reservation Information
                        </h2>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Hours of Operation</h3>
                            <ul class="space-y-1 text-gray-600">
                                <li>Monday - Thursday: 11am - 10pm</li>
                                <li>Friday - Saturday: 11am - 11pm</li>
                                <li>Sunday: 12pm - 9pm</li>
                            </ul>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Reservation Policy</h3>
                            <ul class="space-y-2 text-gray-600">
                                <li>Reservations can be made up to 30 days in advance</li>
                                <li>For parties larger than 10, please call us directly</li>
                                <li>We hold reservations for 15 minutes past the reserved time</li>
                                <li>Special requests are accommodated based on availability</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Contact Us</h3>
                            <p class="text-gray-600">For immediate assistance or to modify a reservation, please call us at (123) 456-7890</p>
                        </div>
                    </div>

                    <div class="mt-6 bg-gray-100 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Location</h3>
                        <p class="text-gray-600 mb-4">123 Restaurant Street<br>City, State 12345</p>

                        <!-- Placeholder for a map -->
                        <div class="bg-gray-300 h-64 rounded-lg flex items-center justify-center">
                            <p class="text-gray-600">Map Location</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
