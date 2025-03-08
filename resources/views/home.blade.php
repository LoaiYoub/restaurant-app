@extends('layouts.app')
@section('content')
    <!-- Hero Section with Video Background Option -->
    <div class="relative bg-center bg-cover h-screen max-h-[800px]" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80')">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex flex-col justify-center">
            <div class="animate-fade-in-up">
                <h1 class="text-4xl font-bold text-white sm:text-5xl md:text-6xl lg:text-7xl">
                    A <span class="text-amber-400">Culinary Journey</span><br>For Your Senses
                </h1>
                <p class="mt-6 text-xl text-gray-200 sm:mt-5 sm:max-w-xl md:text-2xl">
                    Award-winning cuisine in an atmosphere of elegance and warmth
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-utensils mr-2"></i> Explore Our Menu
                    </a>
                    <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-base font-medium rounded-md text-white bg-transparent hover:bg-white hover:text-gray-800 shadow-lg hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        <i class="far fa-calendar-alt mr-2"></i> Reserve a Table
                    </a>
                </div>
            </div>
        </div>
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <!-- Featured Items Section with Enhanced Cards -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto">
                <span class="text-amber-600 font-semibold tracking-wider uppercase">Exquisite Tastes</span>
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl lg:text-5xl">
                    Signature Creations
                </h2>
                <p class="mt-4 text-xl text-gray-500">
                    Handcrafted dishes that showcase our chef's passion and creativity
                </p>
            </div>
            <div class="mt-16 grid gap-10 md:grid-cols-2 lg:grid-cols-4">
                @foreach($featuredItems as $item)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-300 hover:shadow-xl hover:-translate-y-2 group">
                        <div class="relative">
                            <div class="h-64 bg-gray-200 bg-center bg-cover" style="background-image: url('{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1760&q=80' }}')"></div>
                            @if($item->is_vegetarian || $item->is_spicy || $item->is_gluten_free)
                                <div class="absolute top-4 left-4 flex gap-2">
                                    @if($item->is_vegetarian)
                                        <span class="bg-green-600 text-white text-xs px-2 py-1 rounded-full">Vegetarian</span>
                                    @endif
                                    @if($item->is_spicy)
                                        <span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full">Spicy</span>
                                    @endif
                                    @if($item->is_gluten_free)
                                        <span class="bg-blue-600 text-white text-xs px-2 py-1 rounded-full">Gluten-Free</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-amber-600 transition">{{ $item->name }}</h3>
                                <span class="text-amber-600 font-bold">${{ number_format($item->price, 2) }}</span>
                            </div>
                            <p class="mt-3 text-gray-600 line-clamp-3">{{ $item->description }}</p>
                            <div class="mt-6 flex justify-between items-center">
                                <div class="flex items-center">
                                    <div class="flex text-amber-400 text-sm">
                                        @for($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                    <span class="ml-2 text-gray-600 text-sm">({{ rand(10, 50) }})</span>
                                </div>
                                <a href="{{ route('menu.show', $item) }}" class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-16 text-center">
                <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center px-6 py-3 border border-amber-600 text-base font-medium rounded-md text-amber-600 bg-white hover:bg-amber-600 hover:text-white transition duration-300">
                    <span>Explore Our Full Menu</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Daily Specials Carousel (New) -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="text-amber-600 font-semibold tracking-wider uppercase">Fresh & Seasonal</span>
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Today's Specials
                </h2>
            </div>
            <div class="mt-12 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1607330289024-1535c6b4e1c1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="Special of the day" class="h-full w-full object-cover">
                    </div>
                    <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                        <div class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-medium mb-4">
                            Chef's Special
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 md:text-3xl">Herb-Crusted Salmon</h3>
                        <p class="mt-4 text-gray-600 md:text-lg">
                            Locally sourced Atlantic salmon, encrusted with fresh herbs and lemon zest, served with roasted seasonal vegetables and a saffron-infused risotto.
                        </p>
                        <div class="mt-6 flex items-center text-amber-600 font-bold text-2xl">
                            <span>$29.95</span>
                            <span class="ml-3 text-sm text-gray-500 line-through">$34.95</span>
                        </div>
                        <div class="mt-8">
                            <a href="{{ route('reservations.index') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 transition">
                                Reserve to Try
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section Preview with Better Layout -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between lg:space-x-16">
                <div class="lg:w-1/2">
                    <img src="https://images.unsplash.com/photo-1424847651672-bf20a4b0982b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="Restaurant interior" class="w-full h-auto object-cover rounded-xl shadow-xl">
                </div>
                <div class="mt-10 lg:mt-0 lg:w-1/2">
                    <span class="text-amber-600 font-semibold tracking-wider uppercase">Our Heritage</span>
                    <h2 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Crafting Memories Since 2010
                    </h2>
                    <p class="mt-6 text-lg text-gray-600 leading-relaxed">
                        We began with a simple vision: to create a dining experience that celebrates the essence of good food and genuine hospitality. Our journey started in a small kitchen with big dreams, and has evolved into a beloved culinary destination.
                    </p>
                    <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                        Every dish tells a story of tradition, innovation, and our deep respect for quality ingredients. Our team of passionate chefs works closely with local farmers to bring you the freshest seasonal flavors.
                    </p>
                    <div class="mt-8 flex items-center space-x-4">
                        <a href="{{ route('about') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700 transition">
                            Our Full Story
                        </a>
                        @if (Route::has('team'))
                            <a href="{{ route('team') }}" class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition">
                                Meet Our Team
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section (New) -->
    <div class="py-16 bg-amber-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                    <div class="text-5xl font-bold text-white mb-2">12</div>
                    <div class="text-amber-200 uppercase tracking-wide text-sm">Years of Excellence</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                    <div class="text-5xl font-bold text-white mb-2">150+</div>
                    <div class="text-amber-200 uppercase tracking-wide text-sm">Unique Recipes</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                    <div class="text-5xl font-bold text-white mb-2">18</div>
                    <div class="text-amber-200 uppercase tracking-wide text-sm">Award-Winning Dishes</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-6">
                    <div class="text-5xl font-bold text-white mb-2">20k+</div>
                    <div class="text-amber-200 uppercase tracking-wide text-sm">Happy Customers</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section With Better Styling -->
    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="text-amber-600 font-semibold tracking-wider uppercase">Testimonials</span>
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Voices of Our Guests
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Hear what our customers have to say about their dining experiences
                </p>
            </div>
            <div class="mt-16 grid gap-8 md:grid-cols-3">
                <div class="bg-gray-50 p-8 rounded-xl shadow-md relative">
                    <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="pt-4">
                        <div class="flex items-center mb-4">
                            <div class="text-amber-500">
                                <!-- 5 stars -->
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-700 italic leading-relaxed">
                            "An unforgettable dining experience! Each dish was a masterpiece of flavors and presentation. The staff was attentive without being intrusive, creating the perfect atmosphere for our anniversary dinner."
                        </p>
                        <div class="mt-6 flex items-center">
                            <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden">
                                <div class="w-full h-full bg-center bg-cover" style="background-image: url('https://randomuser.me/api/portraits/women/56.jpg')"></div>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Sarah Johnson</p>
                                <p class="text-sm text-gray-600">Local Guide • 24 reviews</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow-md relative">
                    <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="pt-4">
                        <div class="flex items-center mb-4">
                            <div class="text-amber-500">
                                <!-- 5 stars -->
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <p class="text-gray-700 italic leading-relaxed">
                            "This restaurant has become our family's go-to place for celebrations. The menu offers something for everyone, including our picky eaters. The children's menu is thoughtful and just as high-quality as the adult options."
                        </p>
                        <div class="mt-6 flex items-center">
                            <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden">
                                <div class="w-full h-full bg-center bg-cover" style="background-image: url('https://randomuser.me/api/portraits/men/32.jpg')"></div>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Michael Brown</p>
                                <p class="text-sm text-gray-600">Frequent Diner • 12 reviews</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl shadow-md relative">
                    <div class="absolute -top-5 left-1/2 transform -translate-x-1/2 w-10 h-10 bg-amber-500 rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-quote-left"></i>
                    </div>
                    <div class="pt-4">
                        <div class="flex items-center mb-4">
                            <div class="text-amber-500">
                                <!-- 4.5 stars -->
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        <p class="text-gray-700 italic leading-relaxed">
                            "As someone with dietary restrictions, I'm always nervous about dining out. The chef here created a custom dish to accommodate my needs without sacrificing flavor. The waitstaff's knowledge about ingredients was impressive."
                        </p>
                        <div class="mt-6 flex items-center">
                            <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden">
                                <div class="w-full h-full bg-center bg-cover" style="background-image: url('https://randomuser.me/api/portraits/women/68.jpg')"></div>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900">Jennifer Smith</p>
                                <p class="text-sm text-gray-600">Food Blogger • 36 reviews</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Instagram Feed Preview (New) -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <span class="text-amber-600 font-semibold tracking-wider uppercase">@YourRestaurant</span>
                <h2 class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Share Your Experience
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Tag us in your photos for a chance to be featured
                </p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="#" class="block relative aspect-square overflow-hidden rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1476224203421-9ac39bcb3327?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" class="w-full h-full object-cover" alt="Food photo">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                        <i class="fab fa-instagram text-white text-3xl"></i>
                    </div>
                </a>
                <a href="#" class="block relative aspect-square overflow-hidden rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" class="w-full h-full object-cover" alt="Food photo">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                        <i class="fab fa-instagram text-white text-3xl"></i>
                    </div>
                </a>
                <a href="#" class="block relative aspect-square overflow-hidden rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" class="w-full h-full object-cover" alt="Food photo">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                        <i class="fab fa-instagram text-white text-3xl"></i>
                    </div>
                </a>
                <a href="#" class="block relative aspect-square overflow-hidden rounded-lg group">
                    <img src="https://images.unsplash.com/photo-1540914124281-342587941389?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1174&q=80" class="w-full h-full object-cover" alt="Food photo">
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                        <i class="fab fa-instagram text-white text-3xl"></i>
                    </div>
                </a>
            </div>
            <div class="mt-10 text-center">
                <a href="https://instagram.com" target="_blank" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-amber-600 to-red-600 text-base font-medium rounded-md text-white hover:from-amber-700 hover:to-red-700 shadow transition duration-300">
                    <i class="fab fa-instagram mr-2"></i> Follow Us on Instagram
                </a>
            </div>
        </div>
    </div>

    <!-- Newsletter & Reservation CTA (New) -->
    <div class="relative bg-gray-900 py-16">
        <div class="absolute inset-0 bg-center bg-cover opacity-20" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80')"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-1/2 lg:pr-16 mb-10 lg:mb-0">
                    <h2 class="text-3xl font-bold text-white sm:text-4xl">
                        Don't Miss Our Special Events
                    </h2>
                    <p class="mt-4 text-lg text-gray-300 mb-8">
                        Subscribe to our newsletter to receive updates on exclusive events, seasonal menus, and special promotions.
                    </p>
                    <form class="sm:flex">
                        <input type="email" placeholder="Enter your email" class="w-full rounded-l-md border-0 px-5 py-3 text-gray-900 focus:ring-2 focus:ring-amber-600">
                        <button type="submit" class="mt-3 sm:mt-0 w-full sm:w-auto rounded-r-md bg-amber-600 px-6 py-3 text-base font-medium text-white hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-600 focus:ring-offset-2">
                            Subscribe
                        </button>
                    </form>
                </div>
                <div class="lg:w-1/2 lg:pl-16">
                    <div class="bg-white/10 backdrop-blur-sm p-8 rounded-xl">
                        <h3 class="text-2xl font-bold text-white mb-4">Make a Reservation</h3>
                        <p class="text-gray-300 mb-6">Secure your table now for an unforgettable dining experience</p>
                        <div class="space-y-4">
                            <div class="flex space-x-4">
                                <div class="flex-1 min-w-0">
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Party Size</label>
                                    <select class="w-full rounded-md border-0 px-3 py-2 text-gray-900">
                                        <option>2 People</option>
                                        <option>3-4 People</option>
                                        <option>5-6 People</option>
                                        <option>7+ People</option>
                                    </select>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <label class="block text-sm font-medium text-gray-300 mb-1">Date</label>
                                    <input type="date" class="w-full rounded-md border-0 px-3 py-2 text-gray-900">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300 mb-1">Time</label>
                                <select class="w-full rounded-md border-0 px-3 py-2 text-gray-900">
                                    <option>5:00 PM</option>
                                    <option>6:00 PM</option>
                                    <option>7:00 PM</option>
                                    <option>8:00 PM</option>
                                    <option>9:00 PM</option>
                                </select>
                            </div>
                            <div>
                                <a href="{{ route('reservations.index') }}" class="block w-full text-center px-6 py-3 bg-amber-600 rounded-md text-white font-medium hover:bg-amber-700 transition">
                                    Check Availability
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

