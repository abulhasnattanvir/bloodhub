@extends('layouts.admin')

@section('content')

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with search and add button -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-lg font-medium text-gray-900">
                    {{ __('All Donors') }}
                </h3>
                <div class="space-y-2 sm:space-y-0 sm:space-x-3 mt-4 sm:mt-0">
                    <a href="{{ route('admin.donors.create') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + {{ __('Add Donor') }}
                    </a>
                </div>
            </div>

            <!-- Search and Filter Fields -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="sm:grid sm:grid-cols-3 gap-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Search by name') }}
                            </label>
                            <input type="text" id="search" value="{{ request()->input('search') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm"
                                placeholder="{{ __('Type to search...') }}">
                        </div>

                        <div>
                            <label for="blood_group" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Blood Group') }}
                            </label>
                            <select id="blood_group"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">
                                <option value=""> {{ __('All Blood Groups') }} </option>
                                @foreach ($bloodGroups as $bloodGroup)
                                    <option value="{{ $bloodGroup->id }}"
                                        {{ request()->input('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                                        {{ $bloodGroup->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="availability" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('Availability Status') }}
                            </label>
                            <select id="availability"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">
                                <option value=""> {{ __('All Statuses') }} </option>
                                <option value="available"
                                    {{ request()->input('availability_status') == 'available' ? 'selected' : '' }}>
                                    {{ __('Available') }}
                                </option>
                                <option value="not_available"
                                    {{ request()->input('availability_status') == 'not_available' ? 'selected' : '' }}>
                                    {{ __('Not Available') }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Donors Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($donors->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">{{ __('No donors found matching your criteria.') }}</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Photo') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Name') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Blood Group') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Phone') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Gender') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Last Donation') }}
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">{{ __('Actions') }}</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($donors as $donor)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($donor->profile_photo)
                                                        <img src="{{ Storage::url($donor->profile_photo) }}"
                                                            alt="{{ $donor->full_name }}"
                                                            class="h-10 w-10 rounded-full object-cover border-2 border-white">
                                                    @else
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                            <i class="fas fa-user text-gray-500"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $donor->full_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $donor->bloodGroup->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $donor->phone_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if ($donor->gender === 'male')
                                                    <span class="text-blue-600">{{ __('Male') }}</span>
                                                @elseif($donor->gender === 'female')
                                                    <span class="text-pink-600">{{ __('Female') }}</span>
                                                @else
                                                    <span class="text-gray-600">{{ __('Other') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if ($donor->last_donation_date)
                                                    {{ $donor->last_donation_date->format('M d, Y') }}
                                                @else
                                                    <span class="text-gray-400">{{ __('Never') }}</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                         {{ $donor->availability_status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ ucfirst($donor->availability_status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex space-x-2">
                                                    <!-- View Button -->
                                                    <a href="{{ route('admin.donors.show', $donor->id) }}"
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <!-- Edit Button -->
                                                    <a href="{{ route('admin.donors.edit', $donor->id) }}"
                                                        class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <!-- Delete Button -->
                                                    <form action="{{ route('admin.donors.destroy', $donor->id) }}"
                                                        method="POST" class="inline-block"
                                                        onsubmit="return confirm('{{ __('Are you sure you want to delete this donor?') }}');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6 flex items-center justify-between px-6">
                            <p class="text-sm text-gray-500">
                                Showing {{ $donors->firstItem() }} to {{ $donors->lastItem() }}
                                of {{ $donors->total() }} {{ __('results') }}
                            </p>

                            {{ $donors->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const bloodGroupSelect = document.getElementById('blood_group');
        const availabilitySelect = document.getElementById('availability');

        // Debounce function
        function debounce(func, delay) {
            let debounceTimer;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => func.apply(context, args), delay);
            };
        }

        // Update URL parameters and reload page
        function updateFilters() {
            const params = new URLSearchParams(window.location.search);

            // Get values
            const searchValue = searchInput ? searchInput.value.trim() : '';
            const bloodGroupValue = bloodGroupSelect ? bloodGroupSelect.value : '';
            const availabilityValue = availabilitySelect ? availabilitySelect.value : '';

            // Set or remove parameters
            if (searchValue) {
                params.set('search', searchValue);
            } else {
                params.delete('search');
            }

            if (bloodGroupValue) {
                params.set('blood_group', bloodGroupValue);
            } else {
                params.delete('blood_group');
            }

            if (availabilityValue) {
                params.set('availability_status', availabilityValue);
            } else {
                params.delete('availability_status');
            }

            // Reload page with new parameters
            const newUrl = `${window.location.pathname}?${params.toString()}`;
            window.location.href = newUrl;
        }

        // Add event listeners with debounce
        if (searchInput) {
            searchInput.addEventListener('input', debounce(function() {
                updateFilters();
            }, 500));

            // Also handle Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    updateFilters();
                }
            });
        }

        if (bloodGroupSelect) {
            bloodGroupSelect.addEventListener('change', debounce(function() {
                updateFilters();
            }, 300));
        }

        if (availabilitySelect) {
            availabilitySelect.addEventListener('change', debounce(function() {
                updateFilters();
            }, 300));
        }
    });
</script>
