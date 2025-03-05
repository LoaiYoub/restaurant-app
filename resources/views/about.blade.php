@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Hero Section -->
                <div class="mb-12 text-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">About Our Restaurant</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Welcome to our restaurant management system, where culinary excellence meets modern technology.</p>
                </div>

                <!-- Mission & Vision -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-star text-amber-500 text-2xl mr-3"></i>
                            <h3 class="text-xl font-semibold text-gray-900">Our Mission</h3>
                        </div>
                        <p class="text-gray-600">To provide an exceptional dining experience through outstanding service, quality ingredients, and innovative cuisine.</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-eye text-amber-500 text-2xl mr-3"></i>
                            <h3 class="text-xl font-semibold text-gray-900">Our Vision</h3>
                        </div>
                        <p class="text-gray-600">To be the leading restaurant in delivering memorable dining experiences while maintaining operational excellence.</p>
                    </div>
                </div>

                <!-- Core Values -->
                <div class="mb-12">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Our Core Values</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="text-center p-4">
                            <i class="fas fa-heart text-red-500 text-3xl mb-3"></i>
                            <h4 class="font-semibold mb-2">Passion</h4>
                            <p class="text-gray-600 text-sm">We are passionate about food and service excellence</p>
                        </div>
                        <div class="text-center p-4">
                            <i class="fas fa-medal text-amber-500 text-3xl mb-3"></i>
                            <h4 class="font-semibold mb-2">Quality</h4>
                            <p class="text-gray-600 text-sm">We never compromise on the quality of our ingredients</p>
                        </div>
                        <div class="text-center p-4">
                            <i class="fas fa-users text-blue-500 text-3xl mb-3"></i>
                            <h4 class="font-semibold mb-2">Community</h4>
                            <p class="text-gray-600 text-sm">We value our relationships with customers and staff</p>
                        </div>
                        <div class="text-center p-4">
                            <i class="fas fa-leaf text-green-500 text-3xl mb-3"></i>
                            <h4 class="font-semibold mb-2">Sustainability</h4>
                            <p class="text-gray-600 text-sm">We are committed to environmental responsibility</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="border-t border-gray-200 pt-8">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6 text-center">Get in Touch</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-center justify-center space-x-3 bg-gray-50 p-4 rounded-lg">
                            <i class="fas fa-phone text-indigo-600 text-xl"></i>
                            <div>
                                <p class="text-sm text-gray-500">Call Us</p>
                                <span class="text-gray-700 font-medium">+1 234 567 890</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center space-x-3 bg-gray-50 p-4 rounded-lg">
                            <i class="fas fa-envelope text-indigo-600 text-xl"></i>
                            <div>
                                <p class="text-sm text-gray-500">Email Us</p>
                                <span class="text-gray-700 font-medium">contact@restaurant.com</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-center space-x-3 bg-gray-50 p-4 rounded-lg">
                            <i class="fas fa-map-marker-alt text-indigo-600 text-xl"></i>
                            <div>
                                <p class="text-sm text-gray-500">Visit Us</p>
                                <span class="text-gray-700 font-medium">123 Restaurant Street, City</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Business Hours -->
                <div class="mt-12 text-center">
                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">Business Hours</h3>
                    <div class="inline-block bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div class="text-right text-gray-600">Monday - Friday:</div>
                            <div class="text-left font-medium">11:00 AM - 10:00 PM</div>
                            <div class="text-right text-gray-600">Saturday:</div>
                            <div class="text-left font-medium">10:00 AM - 11:00 PM</div>
                            <div class="text-right text-gray-600">Sunday:</div>
                            <div class="text-left font-medium">10:00 AM - 9:00 PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
