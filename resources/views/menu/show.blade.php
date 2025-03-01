@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2">
                        <div class="h-64 md:h-full bg-gray-200 bg-center bg-cover" style="background-image: url('{{ $menuItem->image_path ? asset('storage/' . $menuItem->image_path) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1760&q=80' }}')"></div>
                    </div>
                    <div class="p-6 md:w-1/2">
                        <div class="flex justify-between items-start">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $menuItem->name }}</h1>
                            <span class="text-xl text-amber-600 font-semibold">${{ number_format($menuItem->price, 2) }}</span>
                        </div>
                        <p class="mt-4 text-gray-700">{{ $menuItem->description }}</p>

                        <div class="mt-6 flex gap-2">
                            <span class="text-gray-700 font-medium">Category:</span>
                            <span class="text-gray-600">{{ $menuItem->category->name }}</span>
                        </div>

                        <div class="mt-2 flex gap-3">
                            @if($menuItem->is_vegetarian)
                                <span class="inline-flex items-center px-2.5 py-1 bg-green-100 text-sm font-medium rounded text-green-800">Vegetarian</span>
                            @endif
                            @if($menuItem->is_gluten_free)
                                <span class="inline-flex items-center px-2.5 py-1 bg-blue-100 text-sm font-medium rounded text-blue-800">Gluten Free</span>
                            @endif
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('menu.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md text-amber-700 bg-amber-100 hover:bg-amber-200">
                                Back to Menu
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
