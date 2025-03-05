@extends('layouts.app')

@section('title', 'View Menu Item')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">{{ $menuItem->name }}</h2>
                    <a href="{{ route('admin.menu-items.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image and Basic Info -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="mb-6">
                            <img src="{{ $menuItem->image_url }}" alt="{{ $menuItem->name }}"
                                class="w-full h-64 object-cover rounded-lg shadow-md">
                        </div>
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Category</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $menuItem->category->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Price</h3>
                                <p class="mt-1 text-sm text-gray-600">${{ number_format($menuItem->price, 2) }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Status</h3>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $menuItem->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($menuItem->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">Description</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $menuItem->description }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Preparation Time</h3>
                                    <p class="mt-1 text-sm text-gray-600">{{ $menuItem->preparation_time }} minutes</p>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">Calories</h3>
                                    <p class="mt-1 text-sm text-gray-600">{{ $menuItem->calories ?? 'Not specified' }}</p>
                                </div>
                            </div>
                            <div class="flex space-x-4">
                                @if($menuItem->is_vegetarian)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Vegetarian
                                    </span>
                                @endif
                                @if($menuItem->is_gluten_free)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Gluten Free
                                    </span>
                                @endif
                                @if($menuItem->is_featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Featured
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    @if($menuItem->reviews->count() > 0)
                    <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Reviews</h3>
                        <div class="space-y-4">
                            @foreach($menuItem->reviews as $review)
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star{{ $i <= $review->rating ? '' : '-o' }}"></i>
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600">
                                            {{ $review->user->name }}
                                        </span>
                                    </div>
                                    <span class="text-sm text-gray-500">
                                        {{ $review->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                @if($review->comment)
                                    <p class="mt-2 text-sm text-gray-600">{{ $review->comment }}</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
