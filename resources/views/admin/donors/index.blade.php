@extends('layouts.admin')

@section('content')
    <div class="py-6 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-red-100 text-red-600 rounded-3xl flex items-center justify-center">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">All Donors</h1>
                        <p class="text-gray-500">Manage blood donors and their information</p>
                    </div>
                </div>

                <a href="{{ route('admin.donors.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-2xl shadow-sm transition">
                    <i class="fas fa-plus"></i>
                    Add New Donor
                </a>
            </div>

            <!-- Filters -->
            <div class="bg-white shadow-sm rounded-3xl p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Search by Name</label>
                        <input type="text" id="search" value="{{ request()->input('search') }}"
                            class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base"
                            placeholder="Type donor name...">
                    </div>

                    <!-- Blood Group -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Blood Group</label>
                        <select id="blood_group"
                            class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base">
                            <option value="">All Blood Groups</option>
                            @foreach ($bloodGroups as $bloodGroup)
                                <option value="{{ $bloodGroup->id }}"
                                    {{ request()->input('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                                    {{ $bloodGroup->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Availability -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Availability</label>
                        <select id="availability"
                            class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base">
                            <option value="">All Statuses</option>
                            <option value="available"
                                {{ request()->input('availability_status') == 'available' ? 'selected' : '' }}>
                                Available
                            </option>
                            <option value="not_available"
                                {{ request()->input('availability_status') == 'not_available' ? 'selected' : '' }}>
                                Not Available
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Photo</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Blood Group
                                </th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Phone</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Gender</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Last Donation
                                </th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-5 text-center text-xs font-semibold text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($donors as $donor)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-5">
                                        @if ($donor->profile_photo)
                                            <img src="{{ Storage::url($donor->profile_photo) }}"
                                                class="w-12 h-12 rounded-2xl object-cover border border-gray-200"
                                                alt="">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 font-medium text-gray-900">{{ $donor->full_name }}</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex px-4 py-2 bg-red-100 text-red-700 font-semibold rounded-2xl text-sm">
                                            {{ $donor->bloodGroup->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-700">{{ $donor->phone_number }}</td>
                                    <td class="px-6 py-5">
                                        @if ($donor->gender === 'male')
                                            <span class="text-blue-600">Male</span>
                                        @elseif ($donor->gender === 'female')
                                            <span class="text-pink-600">Female</span>
                                        @else
                                            <span class="text-gray-600">Other</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $donor->last_donation_date ? $donor->last_donation_date->format('M d, Y') : 'Never' }}
                                    </td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex px-4 py-1.5 text-xs font-semibold rounded-2xl
                                            {{ $donor->availability_status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                            {{ ucfirst($donor->availability_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex gap-2 justify-center items-center">
                                            <a href="{{ route('admin.donors.show', $donor->id) }}"
                                                class="flex justify-center items-center p-3 text-blue-600 hover:bg-blue-50 rounded-2xl transition">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.donors.edit', $donor->id) }}"
                                                class="flex justify-center items-center p-3 text-indigo-600 hover:bg-indigo-50 rounded-2xl transition">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form class="mb-0 flex flex justify-center items-center"
                                                action="{{ route('admin.donors.destroy', $donor->id) }}" method="POST"
                                                onsubmit="return confirm('Delete this donor?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-3 mb-0 text-red-600 hover:bg-red-50 rounded-2xl transition">
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

                @if ($donors->isEmpty())
                    <div class="py-16 text-center">
                        <i class="fas fa-users text-6xl text-gray-200"></i>
                        <p class="mt-4 text-gray-500">No donors found</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($donors->hasPages())
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-gray-500">
                        Showing {{ $donors->firstItem() }} to {{ $donors->lastItem() }} of {{ $donors->total() }} results
                    </p>
                    <div>
                        {{ $donors->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const bloodGroupSelect = document.getElementById('blood_group');
        const availabilitySelect = document.getElementById('availability');

        function debounce(func, delay) {
            let timer;
            return function() {
                clearTimeout(timer);
                timer = setTimeout(func, delay);
            };
        }

        function updateFilters() {
            const params = new URLSearchParams(window.location.search);

            const search = searchInput.value.trim();
            const blood = bloodGroupSelect.value;
            const avail = availabilitySelect.value;

            search ? params.set('search', search) : params.delete('search');
            blood ? params.set('blood_group', blood) : params.delete('blood_group');
            avail ? params.set('availability_status', avail) : params.delete('availability_status');

            window.location.href = `${window.location.pathname}?${params.toString()}`;
        }

        if (searchInput) searchInput.addEventListener('input', debounce(updateFilters, 600));
        if (bloodGroupSelect) bloodGroupSelect.addEventListener('change', updateFilters);
        if (availabilitySelect) availabilitySelect.addEventListener('change', updateFilters);
    });
</script>
