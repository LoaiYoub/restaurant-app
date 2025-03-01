@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-center bg-cover h-96" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80')">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center">
            <h1 class="text-4xl font-bold text-white sm:text-5xl md:text-6xl">
                Delicious Food & Pleasant Atmosphere
            </h1>
            <p class="mt-3 text-xl text-white sm:mt-5 sm:max-w-xl">
                Experience the finest dining with our carefully crafted menu
            </p>
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                    View Our Menu
                </a>
                <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white hover:text-gray-800">
                    Make a Reservation
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Items Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Featured Dishes
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Explore our chef's selections and customer favorites
                </p>
            </div>

            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredItems as $item)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="h-48 bg-gray-200 bg-center bg-cover" style="background-image: url('{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1760&q=80' }}')"></div>
                        <div class="p-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $item->name }}</h3>
                            <p class="mt-1 text-gray-500 line-clamp-2">{{ $item->description }}</p>
                            <div class="mt-4 flex justify-between items-center">
                                <span class="text-amber-600 font-semibold">${{ number_format($item->price, 2) }}</span>
                                <a href="{{ route('menu.show', $item) }}" class="inline-flex items-center px-3 py-1 border border-amber-600 text-sm rounded-md text-amber-600 bg-white hover:bg-amber-600 hover:text-white">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                    View Full Menu
                </a>
            </div>
        </div>
    </div>

    <!-- About Section Preview -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-1/2 lg:pr-12">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Our Restaurant Story
                    </h2>
                    <p class="mt-4 text-lg text-gray-500">
                        Founded in 2010, our restaurant brings the authentic flavors of traditional cuisine with a modern twist. Our chef has crafted a menu that celebrates local ingredients while honoring classic recipes.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('about') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                            Learn More About Us
                        </a>
                    </div>
                </div>
                <div class="mt-10 lg:mt-0 lg:w-1/2">
                    <div class="rounded-lg overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1424847651672-bf20a4b0982b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="Restaurant interior" class="w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    What Our Customers Say
                </h2>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-500">
                            <!-- 5 stars -->
                            <span>★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"The food was absolutely amazing! Every dish was prepared with care and the flavors were outstanding. Will definitely be coming back!"</p>
                    <p class="mt-4 font-medium">- Sarah Johnson</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-500">
                            <!-- 5 stars -->
                            <span>★★★★★</span>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"Great atmosphere, friendly staff, and delicious food. What more could you ask for? This place has become our family's favorite restaurant."</p>
                    <p class="mt-4 font-medium">- Michael Brown</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="text-amber-500">
                            <!-- 4.5 stars -->
                            <span>★★★★½</span>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"The menu is diverse and everything we tried was excellent. The service was impeccable and the ambiance was perfect for our anniversary dinner."</p>
                    <p class="mt-4 font-medium">- Jennifer Smith</p>
                </div>
            </div>
        </div>
    </div>
@endsection
