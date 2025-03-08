@extends('layouts.app')
@section('title', 'About Us - Culinary Excellence')
@section('content')
<div class="bg-gradient-to-b from-gray-50 to-white py-16">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Hero Section with Background Image -->
        <div class="relative rounded-xl overflow-hidden mb-16 shadow-xl">
            <div class="absolute inset-0 bg-gradient-to-r from-amber-600/80 to-red-700/80 z-10"></div>
            <div class="relative z-20 py-20 px-8 text-center">
                <h1 class="text-5xl font-bold text-white mb-4">Our Culinary Journey</h1>
                <p class="text-xl text-white/90 max-w-2xl mx-auto font-light">
                    Where passion for extraordinary flavors meets the art of hospitality
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Our Story Section -->
            <div class="p-8 md:p-12">
                <div class="mb-16">
                    <div class="inline-block mb-6">
                        <span class="text-sm uppercase tracking-wider text-amber-600 font-semibold">Established 2010</span>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Story</h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <div>
                            <p class="text-gray-700 leading-relaxed mb-6">
                                Founded with a passion for culinary excellence, our restaurant began as a small family venture dedicated to bringing authentic, flavorful dishes to our community. What started as a modest establishment has grown into a beloved dining destination while maintaining our commitment to quality and personalized service.
                            </p>
                            <p class="text-gray-700 leading-relaxed">
                                Our journey has been shaped by our deep appreciation for seasonal ingredients, culinary traditions, and innovative techniques. Every dish we serve tells a story of dedication, creativity, and respect for the art of cooking.
                            </p>
                        </div>
                        <div class="bg-amber-50 p-8 rounded-lg border-l-4 border-amber-500">
                            <div class="flex items-start mb-4">
                                <i class="fas fa-quote-left text-amber-400 text-3xl mr-4 mt-1"></i>
                                <p class="text-gray-700 italic text-lg">
                                    "We believe that exceptional dining isn't just about the food—it's about creating memorable moments and connections around the table."
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="font-medium text-gray-900">Chef Maria Rodriguez</p>
                                <p class="text-sm text-gray-600">Executive Chef & Founder</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mission & Vision with improved layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-16">
                    <div class="bg-gray-50 p-8 rounded-xl shadow-sm transform transition hover:scale-105 duration-300">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-500 rounded-full mb-6">
                            <i class="fas fa-star text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Mission</h3>
                        <p class="text-gray-700 leading-relaxed">
                            To create extraordinary dining experiences that delight the senses and nourish both body and soul through exceptional cuisine, attentive service, and a warm atmosphere that makes every guest feel like family.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-8 rounded-xl shadow-sm transform transition hover:scale-105 duration-300">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-amber-500 rounded-full mb-6">
                            <i class="fas fa-eye text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Our Vision</h3>
                        <p class="text-gray-700 leading-relaxed">
                            To be recognized as a culinary landmark that sets the standard for restaurant excellence, innovation, and sustainability while fostering a culture of hospitality that inspires both our team and guests.
                        </p>
                    </div>
                </div>

                <!-- Core Values with improved visuals -->
                <div class="mb-16">
                    <div class="text-center mb-10">
                        <span class="inline-block mb-2 px-4 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">What Drives Us</span>
                        <h3 class="text-3xl font-bold text-gray-900">Our Core Values</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md">
                            <div class="w-14 h-14 bg-red-100 rounded-lg flex items-center justify-center mb-5">
                                <i class="fas fa-heart text-red-500 text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-semibold mb-3">Passion</h4>
                            <p class="text-gray-600">We bring enthusiasm and dedication to every dish we prepare and every guest we serve</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md">
                            <div class="w-14 h-14 bg-amber-100 rounded-lg flex items-center justify-center mb-5">
                                <i class="fas fa-medal text-amber-500 text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-semibold mb-3">Quality</h4>
                            <p class="text-gray-600">We source the finest seasonal ingredients and maintain exceptional standards in everything we do</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md">
                            <div class="w-14 h-14 bg-blue-100 rounded-lg flex items-center justify-center mb-5">
                                <i class="fas fa-users text-blue-500 text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-semibold mb-3">Community</h4>
                            <p class="text-gray-600">We create meaningful connections with our guests, team members, and local producers</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 transition hover:shadow-md">
                            <div class="w-14 h-14 bg-green-100 rounded-lg flex items-center justify-center mb-5">
                                <i class="fas fa-leaf text-green-500 text-2xl"></i>
                            </div>
                            <h4 class="text-xl font-semibold mb-3">Sustainability</h4>
                            <p class="text-gray-600">We embrace eco-friendly practices and support sustainable farming to protect our planet</p>
                        </div>
                    </div>
                </div>

                <!-- Our Team Section (New) -->
                <div class="mb-16">
                    <div class="text-center mb-10">
                        <span class="inline-block mb-2 px-4 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">The Faces Behind Our Food</span>
                        <h3 class="text-3xl font-bold text-gray-900">Meet Our Team</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="text-center">
                            <div class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-4 shadow-lg">
                                <!-- Replace with actual chef image or use gray bg as placeholder -->
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-4xl"></i>
                                </div>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900">Maria Rodriguez</h4>
                            <p class="text-amber-600 mb-3">Executive Chef</p>
                            <p class="text-gray-600 text-sm px-4">With 15 years of culinary expertise spanning three continents, Chef Maria brings creativity and passion to every dish</p>
                        </div>
                        <div class="text-center">
                            <div class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-4 shadow-lg">
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-4xl"></i>
                                </div>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900">James Chen</h4>
                            <p class="text-amber-600 mb-3">Sous Chef</p>
                            <p class="text-gray-600 text-sm px-4">A master of fusion cuisine, James combines traditional techniques with innovative approaches</p>
                        </div>
                        <div class="text-center">
                            <div class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-4 shadow-lg">
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-4xl"></i>
                                </div>
                            </div>
                            <h4 class="text-xl font-semibold text-gray-900">Sarah Johnson</h4>
                            <p class="text-amber-600 mb-3">Pastry Chef</p>
                            <p class="text-gray-600 text-sm px-4">Award-winning pastry artist known for creating unforgettable dessert experiences</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information with maps integration hint -->
                <div class="border-t border-gray-100 pt-12 mb-12">
                    <div class="text-center mb-10">
                        <span class="inline-block mb-2 px-4 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">Connect With Us</span>
                        <h3 class="text-3xl font-bold text-gray-900">Get in Touch</h3>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                <div class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-sm">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-phone text-indigo-600 text-xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-1">Call Us</p>
                                    <a href="tel:+12345678900" class="text-gray-700 font-medium hover:text-amber-600 transition">+1 234 567 8900</a>
                                </div>
                                <div class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-sm">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-envelope text-indigo-600 text-xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-1">Email Us</p>
                                    <a href="mailto:hello@finerestaurant.com" class="text-gray-700 font-medium hover:text-amber-600 transition">hello@finerestaurant.com</a>
                                </div>
                                <div class="flex flex-col items-center bg-gray-50 p-6 rounded-lg shadow-sm">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-map-marker-alt text-indigo-600 text-xl"></i>
                                    </div>
                                    <p class="text-sm text-gray-500 mb-1">Visit Us</p>
                                    <span class="text-gray-700 font-medium text-center">123 Culinary Avenue, Gourmet District</span>
                                </div>
                            </div>

                            <!-- Social media links -->
                            <div class="flex justify-center space-x-4 mt-8">
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-amber-500 hover:text-white transition">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-amber-500 hover:text-white transition">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-amber-500 hover:text-white transition">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-amber-500 hover:text-white transition">
                                    <i class="fab fa-yelp"></i>
                                </a>
                            </div>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-6">
                            <!-- Placeholder for a map - in real implementation, this would be a Google Maps embed -->
                            <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center">
                                <p class="text-gray-500"><i class="fas fa-map-marked-alt text-2xl mr-2"></i> Map Loading...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours with more visual appeal -->
                <div class="mb-8">
                    <div class="text-center mb-8">
                        <span class="inline-block mb-2 px-4 py-1 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">When to Visit</span>
                        <h3 class="text-3xl font-bold text-gray-900">Business Hours</h3>
                    </div>
                    <div class="max-w-xl mx-auto bg-amber-50 rounded-xl overflow-hidden shadow-sm">
                        <div class="p-8">
                            <div class="grid grid-cols-2 gap-y-4 text-lg">
                                <div class="text-right pr-8 font-medium text-gray-700">Monday - Thursday:</div>
                                <div class="text-left font-light text-gray-900">11:00 AM - 10:00 PM</div>

                                <div class="text-right pr-8 font-medium text-gray-700">Friday:</div>
                                <div class="text-left font-light text-gray-900">11:00 AM - 11:00 PM</div>

                                <div class="text-right pr-8 font-medium text-gray-700">Saturday:</div>
                                <div class="text-left font-light text-gray-900">10:00 AM - 11:00 PM</div>

                                <div class="text-right pr-8 font-medium text-gray-700">Sunday:</div>
                                <div class="text-left font-light text-gray-900">10:00 AM - 9:00 PM</div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-amber-200 text-center">
                                <span class="text-amber-600 font-medium">Happy Hour: </span>
                                <span class="text-gray-700">Monday - Friday, 4:00 PM - 6:00 PM</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reservation CTA (New) -->
                <div class="bg-amber-500 rounded-xl p-8 text-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Ready to Experience Our Cuisine?</h3>
                    <p class="text-white/90 mb-6 max-w-2xl mx-auto">Join us for a memorable dining experience with impeccable service and extraordinary food</p>
                    <a href="/reservations" class="inline-block px-8 py-3 bg-white text-amber-600 rounded-lg font-semibold shadow-md hover:bg-gray-50 transition">Make a Reservation</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
