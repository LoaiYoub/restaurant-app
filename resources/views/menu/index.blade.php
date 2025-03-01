@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our Menu
                </h1>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Explore our carefully crafted dishes made with fresh ingredients
                </p>
            </div>

            <!-- Menu Categories -->
            @foreach($categories as $category)
                @if(count($category->menuItems) > 0)
                    <div class="mb-16">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 pb-2 border-b border-gray-200">
                            {{ $category->name }}
                        </h2>
                        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($category->menuItems as $item)
                                <div class="bg-white rounded-lg shadow overflow-hidden">
                                    <div class="h-48 bg-gray-200 bg-center bg-cover" style="background-image: url('{{ $item->image_path ? asset('storage/' . $item->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1760&q=80' }}')"></div>
                                    <div class="p-4">
                                        <div class="flex justify-between items-start">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $item->name }}</h3>
                                            <span class="text-amber-600 font-semibold">${{ number_format($item->price, 2) }}</span>
                                        </div>
                                        <p class="mt-1 text-gray-500 line-clamp-3">{{ $item->description }}</p>
                                        <div class="mt-4 flex gap-2">
                                            @if($item->is_vegetarian)
                                                <span class="inline-flex items-center px-2 py-1 bg-green-100 text-xs font-medium rounded text-green-800">Vegetarian</span>
                                            @endif
                                            @if($item->is_gluten_free)
                                                <span class="inline-flex items-center px-2 py-1 bg-blue-100 text-xs font-medium rounded text-blue-800">Gluten Free</span>
                                            @endif
                                        </div>
                                        <div class="mt-4">
                                            <a href="{{ route('menu.show', $item) }}" class="inline-flex items-center px-3 py-1 border border-amber-600 text-sm rounded-md text-amber-600 bg-white hover:bg-amber-600 hover:text-white">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
