@extends('layouts.app')

@section('title', 'Manage Tables')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Restaurant Tables</h2>
    <div class="flex space-x-4">
        <a href="{{ route('admin.dashboard') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
            <i class="fas fa-home mr-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.tables.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
            <i class="fas fa-plus mr-2"></i> New Table
        </a>
    </div>
</div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Tables Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse ($tables as $table)
                        <div class="bg-white rounded-lg shadow border hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">{{ $table->name }}</h3>
                                        <p class="text-sm text-gray-600">Capacity: {{ $table->capacity }} seats</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($table->status === 'available') bg-green-100 text-green-800
                                        @elseif($table->status === 'occupied') bg-red-100 text-red-800
                                        @elseif($table->status === 'reserved') bg-yellow-100 text-yellow-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($table->status) }}
                                    </span>
                                </div>

                                @if($table->location)
                                    <p class="mt-2 text-sm text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-2"></i>{{ $table->location }}
                                    </p>
                                @endif

                                @if($table->notes)
                                    <p class="mt-2 text-sm text-gray-500">
                                        <i class="fas fa-sticky-note mr-2"></i>{{ $table->notes }}
                                    </p>
                                @endif

                                <div class="mt-4 flex justify-end space-x-2">
                                    <a href="{{ route('admin.tables.edit', $table) }}"
                                        class="text-blue-600 hover:text-blue-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button"
                                        class="text-red-600 hover:text-red-900"
                                        onclick="document.getElementById('deleteModal{{ $table->id }}').classList.remove('hidden')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div id="deleteModal{{ $table->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                <div class="mt-3 text-center">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Table</h3>
                                    <div class="mt-2 px-7 py-3">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want to delete this table? This action cannot be undone.
                                        </p>
                                    </div>
                                    <div class="flex justify-end mt-4 space-x-3">
                                        <button type="button"
                                            class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400"
                                            onclick="document.getElementById('deleteModal{{ $table->id }}').classList.add('hidden')">
                                            Cancel
                                        </button>
                                        <form action="{{ route('admin.tables.destroy', $table) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="md:col-span-3 text-center py-12 text-gray-500">
                            No tables found. Click "New Table" to add one.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
