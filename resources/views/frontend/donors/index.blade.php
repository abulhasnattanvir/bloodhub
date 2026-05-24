@extends('layouts.frontend')

@section('content')

    <!-- =========================
         FILTER SECTION
    ========================= -->
    <section class="py-10 bg-gradient-to-r from-red-50 to-white">
        <div class="max-w-7xl mx-auto px-4">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">
                {{ __('app.donor_list') }}
            </h2>

            <div class="grid md:grid-cols-3 gap-4">

                <input type="text" id="search-input"
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-400"
                    placeholder="Search name, phone, email" value="{{ request('search') }}">

                <select id="blood-group-select" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-400">

                    <option value="">All Blood Groups</option>

                    @foreach ($bloodGroups as $bloodGroup)
                        <option value="{{ $bloodGroup->id }}"
                            {{ request('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                            {{ $bloodGroup->name }}
                        </option>
                    @endforeach

                </select>

                <select id="availability-select" class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-400">

                    <option value="">All Status</option>
                    <option value="available" {{ request('availability_status') == 'available' ? 'selected' : '' }}>
                        Available
                    </option>
                    <option value="not_available" {{ request('availability_status') == 'not_available' ? 'selected' : '' }}>
                        Not Available
                    </option>

                </select>

            </div>

        </div>
    </section>

    <!-- =========================
         DESKTOP TABLE
    ========================= -->
    <section class="py-10 hidden md:block">
        <div class="max-w-7xl mx-auto px-4">

            @if ($donors->isEmpty())
                <div class="text-center text-gray-500 py-10">
                    No donors found
                </div>
            @else
                <div class="bg-white rounded-2xl shadow overflow-x-auto">

                    <table class="min-w-full text-sm">

                        <thead class="bg-red-600 text-white">
                            <tr>
                                <th class="p-4">Photo</th>
                                <th class="p-4">Name</th>
                                <th class="p-4">Blood</th>
                                <th class="p-4">Phone</th>
                                <th class="p-4">Gender</th>
                                <th class="p-4">Last Donation</th>
                                <th class="p-4">Status</th>
                                <th class="p-4">Address</th>
                                <th class="p-4">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($donors as $donor)
                                <tr class="border-b hover:bg-red-50 transition">

                                    <td class="p-3">
                                        @if ($donor->profile_photo)
                                            <img src="{{ Storage::url($donor->profile_photo) }}"
                                                class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <td class="p-3 font-semibold">{{ $donor->full_name }}</td>

                                    <td class="p-3">
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-bold
                                {{ str_contains($donor->bloodGroup->name, 'A') ? 'bg-red-100 text-red-600' : '' }}
                                {{ str_contains($donor->bloodGroup->name, 'B') ? 'bg-green-100 text-green-600' : '' }}
                                {{ str_contains($donor->bloodGroup->name, 'O') ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ str_contains($donor->bloodGroup->name, 'AB') ? 'bg-blue-100 text-blue-600' : '' }}">
                                            {{ $donor->bloodGroup->name }}
                                        </span>
                                    </td>

                                    <td class="p-3">{{ $donor->phone_number }}</td>

                                    <td class="p-3">{{ ucfirst($donor->gender) }}</td>

                                    <td class="p-3">
                                        {{ $donor->last_donation_date ? $donor->last_donation_date->format('M d, Y') : 'Never' }}
                                    </td>

                                    <td class="p-3">
                                        @if ($donor->availability_status == 'available')
                                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs">
                                                Available
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs">
                                                Not Available
                                            </span>
                                        @endif
                                    </td>

                                    <td class="p-3 text-gray-500 max-w-[180px] truncate">
                                        {{ $donor->address }}
                                    </td>

                                    <td class="p-3 flex gap-2">

                                        <button class="view-donor-btn px-3 py-1 bg-red-50 text-red-600 rounded-lg"
                                            data-donor-id="{{ $donor->id }}">
                                            View
                                        </button>

                                        <a href="tel:{{ $donor->phone_number }}"
                                            class="px-3 py-1 bg-green-50 text-green-600 rounded-lg">
                                            Call
                                        </a>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

                <div class="mt-5">
                    {{ $donors->links() }}
                </div>
            @endif

        </div>
    </section>

    <!-- =========================
         MOBILE CARD VIEW
    ========================= -->
    <section class="md:hidden py-6">
        <div class="max-w-7xl mx-auto px-4 space-y-4">

            @foreach ($donors as $donor)
                <div class="bg-white shadow rounded-2xl p-4">

                    <div class="flex items-center gap-3">

                        @if ($donor->profile_photo)
                            <img src="{{ Storage::url($donor->profile_photo) }}"
                                class="w-14 h-14 rounded-full object-cover">
                        @else
                            <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                        @endif

                        <div>
                            <h3 class="font-bold">{{ $donor->full_name }}</h3>
                            <p class="text-sm text-gray-500">{{ $donor->bloodGroup->name }}</p>
                        </div>

                    </div>

                    <div class="mt-3 text-sm text-gray-600 space-y-1">
                        <p><b>Phone:</b> {{ $donor->phone_number }}</p>
                        <p><b>Gender:</b> {{ ucfirst($donor->gender) }}</p>
                        <p><b>Status:</b> {{ $donor->availability_status }}</p>
                    </div>

                    <div class="mt-4 flex gap-2">

                        <a href="tel:{{ $donor->phone_number }}"
                            class="flex-1 bg-green-500 text-white py-2 rounded-lg text-center">
                            Call
                        </a>

                        <button class="view-donor-btn flex-1 bg-red-500 text-white py-2 rounded-lg"
                            data-donor-id="{{ $donor->id }}">
                            View
                        </button>

                    </div>

                </div>
            @endforeach

        </div>
    </section>

    <!-- =========================
         MODAL
    ========================= -->
    <div id="donorModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

        <div class="bg-white w-full max-w-lg rounded-2xl p-6 relative shadow-2xl">

            <button id="closeModal" class="absolute right-4 top-3 text-2xl text-gray-500 hover:text-red-500">
                ×
            </button>

            <div id="donorModalBody" class="text-gray-700">
                Loading...
            </div>

        </div>

    </div>

@endsection

<!-- =========================
     SCRIPT
========================= -->
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const search = document.getElementById('search-input');
            const blood = document.getElementById('blood-group-select');
            const status = document.getElementById('availability-select');

            function debounce(func, delay = 500) {
                let timer;
                return function(...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            }

            function updateFilters() {
                const params = new URLSearchParams();

                if (search?.value.trim()) params.append('search', search.value.trim());
                if (blood?.value) params.append('blood_group', blood.value);
                if (status?.value) params.append('availability_status', status.value);

                window.location.href = `?${params.toString()}`;
            }

            const debouncedUpdate = debounce(updateFilters, 500);

            search?.addEventListener('input', debouncedUpdate);
            blood?.addEventListener('change', debounce(updateFilters, 300));
            status?.addEventListener('change', debounce(updateFilters, 300));

            // MODAL
            const modal = document.getElementById('donorModal');
            const body = document.getElementById('donorModalBody');
            const close = document.getElementById('closeModal');

            function openModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function hideModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            close?.addEventListener('click', hideModal);

            modal?.addEventListener('click', (e) => {
                if (e.target === modal) hideModal();
            });

            document.querySelectorAll('.view-donor-btn').forEach(btn => {
                btn.addEventListener('click', function() {

                    const id = this.dataset.donorId;

                    openModal();

                    body.innerHTML = `
                <div class="text-center py-10 text-gray-500">
                    Loading...
                </div>
            `;

                    fetch(`/api/donors/${id}`)
                        .then(res => res.json())
                        .then(donor => {

                            body.innerHTML = `
                        <div class="space-y-2">
                            <h2 class="text-2xl font-bold">${donor.full_name}</h2>

                            <p><b>Phone:</b> ${donor.phone_number ?? 'N/A'}</p>
                            <p><b>Blood:</b> ${donor.blood_group?.name ?? 'N/A'}</p>
                            <p><b>Email:</b> ${donor.email ?? 'N/A'}</p>
                            <p><b>Gender:</b> ${donor.gender ?? 'N/A'}</p>
                            <p><b>Address:</b> ${donor.address ?? 'N/A'}</p>

                            <div class="mt-4">
                                <a href="tel:${donor.phone_number}"
                                   class="bg-green-500 text-white px-4 py-2 rounded-lg">
                                   Call Now
                                </a>
                            </div>
                        </div>
                    `;
                        })
                        .catch(() => {
                            body.innerHTML = `<p class="text-red-500">Failed to load</p>`;
                        });

                });
            });

        });
    </script>
@endpush
