@extends('layouts.app')

@section('title', 'Manage Reservations')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold">Reservations</h2>
                    <div class="space-x-2">
                        <a href="{{ route('admin.reservations.export', request()->query()) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            <i class="fas fa-file-export mr-2"></i> Export CSV
                        </a>
                        <a href="{{ route('admin.reservations.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            <i class="fas fa-plus mr-2"></i> New Reservation
                        </a>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium mb-4"><i class="fas fa-filter mr-2"></i>Filters</h3>
                    <form action="{{ route('admin.reservations.index') }}" method="GET">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                <input type="date" id="date" name="date" value="{{ request('date') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="all">All Statuses</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>

                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                    placeholder="Name, Email or Phone"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div class="flex items-end space-x-2">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                    Apply Filters
                                </button>
                                <a href="{{ route('admin.reservations.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Bulk Actions -->
                <div class="bg-yellow-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-medium mb-4"><i class="fas fa-tasks mr-2"></i>Bulk Actions</h3>
                    <form action="{{ route('admin.reservations.bulk-update') }}" method="POST" id="bulk-form">
                        @csrf
                        <div class="flex space-x-4">
                            <select name="status" required class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select action...</option>
                                <option value="confirmed">Confirm Selected</option>
                                <option value="pending">Set to Pending</option>
                                <option value="cancelled">Cancel Selected</option>
                            </select>
                            <button type="submit" id="bulk-action-btn" disabled
                                class="inline-flex items-center px-4 py-2 bg-yellow-600 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 disabled:opacity-50">
                                Apply to Selected
                            </button>
                        </div>
                        <div id="selected-ids"></div>
                    </form>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                <!-- Reservations Table -->
                <div class="overflow-x-auto bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-14">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a href="{{ route('admin.reservations.index', array_merge(
                                        request()->except(['sort_by', 'sort_direction']),
                                        ['sort_by' => 'name', 'sort_direction' => request('sort_by') == 'name' && request('sort_direction') == 'asc' ? 'desc' : 'asc']
                                    )) }}" class="group inline-flex items-center space-x-1">
                                        <span>Customer</span>
                                        @if(request('sort_by') == 'name')
                                            <i class="fas fa-sort-{{ request('sort_direction') == 'asc' ? 'up' : 'down' }} text-indigo-600"></i>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Guests</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <a href="{{ route('admin.reservations.index', array_merge(
                                        request()->except(['sort_by', 'sort_direction']),
                                        ['sort_by' => 'reservation_date', 'sort_direction' => request('sort_by') == 'reservation_date' && request('sort_direction') == 'asc' ? 'desc' : 'asc']
                                    )) }}" class="group inline-flex items-center space-x-1">
                                        <span>Date & Time</span>
                                        @if(request('sort_by') == 'reservation_date' || !request('sort_by'))
                                            <i class="fas fa-sort-{{ request('sort_direction', 'asc') == 'asc' ? 'up' : 'down' }} text-indigo-600"></i>
                                        @endif
                                    </a>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Table</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($reservations as $reservation)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="reservation-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            value="{{ $reservation->id }}" name="reservation_ids[]">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $reservation->name }}</div>
                                        @if ($reservation->user)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Registered
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $reservation->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $reservation->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $reservation->guests }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $reservation->reservation_date->format('M d, Y') }}</div>
                                        <div class="text-sm text-gray-500">{{ $reservation->reservation_date->format('h:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($reservation->table_number)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $reservation->table_number }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Not assigned
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($reservation->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @elseif ($reservation->status == 'confirmed')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Confirmed
                                            </span>
                                        @elseif ($reservation->status == 'cancelled')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Cancelled
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.reservations.show', $reservation) }}"
                                                class="text-indigo-600 hover:text-indigo-900">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.reservations.edit', $reservation) }}"
                                                class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button"
                                                class="text-red-600 hover:text-red-900"
                                                onclick="document.getElementById('deleteModal{{ $reservation->id }}').classList.remove('hidden')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div id="deleteModal{{ $reservation->id }}" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                                            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                                                <div class="mt-3 text-center">
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Delete Reservation</h3>
                                                    <div class="mt-2 px-7 py-3">
                                                        <p class="text-sm text-gray-500">
                                                            Are you sure you want to delete this reservation?
                                                        </p>
                                                    </div>
                                                    <div class="flex justify-end mt-4 space-x-3">
                                                        <button type="button"
                                                            class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300"
                                                            onclick="document.getElementById('deleteModal{{ $reservation->id }}').classList.add('hidden')">
                                                            Cancel
                                                        </button>
                                                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        No reservations found matching your criteria.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $reservations->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.reservation-checkbox');
        const bulkActionBtn = document.getElementById('bulk-action-btn');
        const bulkForm = document.getElementById('bulk-form');
        const statusSelect = bulkForm.querySelector('select[name="status"]');
        const selectedIdsContainer = document.getElementById('selected-ids');

        function updateBulkButtonState() {
            const checkedBoxes = document.querySelectorAll('.reservation-checkbox:checked');
            const hasCheckedBoxes = checkedBoxes.length > 0;
            const hasSelectedStatus = statusSelect.value !== '';

            // Enable button only if both conditions are met
            bulkActionBtn.disabled = !(hasCheckedBoxes && hasSelectedStatus);

            // Add selected IDs to form
            selectedIdsContainer.innerHTML = '';
            if (hasCheckedBoxes) {
                checkedBoxes.forEach(checkbox => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'reservation_ids[]';
                    input.value = checkbox.value;
                    selectedIdsContainer.appendChild(input);
                });
            }
        }
        console.log('the button is not disabled');


        // Listen for status select changes
        statusSelect.addEventListener('change', updateBulkButtonState);

        // Handle select all checkbox
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            updateBulkButtonState();
        });

        // Handle individual checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allChecked = [...checkboxes].every(cb => cb.checked);
                const anyChecked = [...checkboxes].some(cb => cb.checked);
                selectAll.checked = allChecked;
                selectAll.indeterminate = anyChecked && !allChecked;
                updateBulkButtonState();
            });
        });

        // Handle form submission
        bulkForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const checkedBoxes = document.querySelectorAll('.reservation-checkbox:checked');

            if (checkedBoxes.length === 0) {
                alert('Please select at least one reservation.');
                return;
            }

            if (!statusSelect.value) {
                alert('Please select an action to perform.');
                return;
            }

            this.submit();
        });

        // Initialize button state
        updateBulkButtonState();
    });
</script>

@endsection

