@extends('layouts.frontend')

@section('content')
    <!-- =========================
                                SEARCH HERO DASHBOARD
                            ========================= -->
    <section class="bg-gradient-to-r from-red-50 to-white py-10">
        <div class="max-w-7xl mx-auto px-4">

            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                {{ __('app.search_donors') }}
            </h1>

            <p class="text-gray-500 mb-6">
                Find blood donors instantly by filters or smart search
            </p>

            <!-- QUICK BLOOD FILTER BUTTONS -->
            <div class="flex flex-wrap gap-2 mb-6">

                <button onclick="setBlood('')" class="px-3 py-1 bg-gray-200 rounded-full">All</button>
                @foreach ($bloodGroups as $bg)
                    <button onclick="setBlood('{{ $bg->id }}')"
                        class="px-3 py-1 bg-red-100 text-red-600 rounded-full hover:bg-red-200">
                        {{ $bg->name }}
                    </button>
                @endforeach

            </div>

            <!-- MAIN FILTER BAR -->
            <div class="grid md:grid-cols-3 gap-4">

                <input type="text" id="search-input" class="w-full px-4 py-3 border rounded-xl"
                    placeholder="Search name, phone, email">

                <select id="blood-group-select" class="w-full px-4 py-3 border rounded-xl">
                    <option value="">All Blood Groups</option>
                    @foreach ($bloodGroups as $bloodGroup)
                        <option value="{{ $bloodGroup->id }}">
                            {{ $bloodGroup->name }}
                        </option>
                    @endforeach
                </select>

                <select id="availability-select" class="w-full px-4 py-3 border rounded-xl">
                    <option value="">All Status</option>
                    <option value="available">Available</option>
                    <option value="not_available">Not Available</option>
                </select>

            </div>

        </div>
    </section>

    <!-- =========================
                                RESULTS SECTION (CARDS)
                            ========================= -->
    <section class="py-10">
        <div class="max-w-7xl mx-auto px-4">

            @if ($donors->isEmpty())
                <div class="text-center py-10 text-gray-500">
                    No donors found 😢
                </div>
            @else
                <!-- STATS -->
                <div class="grid md:grid-cols-4 gap-4 mb-6">

                    <div class="bg-white p-4 rounded-xl shadow">
                        <p class="text-gray-500">Total Results</p>
                        <h2 class="text-2xl font-bold">{{ $donors->total() }}</h2>
                    </div>

                    <div class="bg-white p-4 rounded-xl shadow">
                        <p class="text-gray-500">Available</p>
                        <h2 class="text-2xl font-bold text-green-600">
                            {{ $donors->where('availability_status', 'available')->count() }}
                        </h2>
                    </div>

                </div>

                <!-- RESULT GRID -->
                <div class="grid md:grid-cols-3 gap-6">

                    @foreach ($donors as $donor)
                        <div class="bg-white rounded-2xl shadow p-5 hover:shadow-lg transition">

                            <!-- HEADER -->
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
                                    <h3 class="font-bold text-gray-800">
                                        {{ $donor->full_name }}
                                    </h3>

                                    <span class="text-sm text-gray-500">
                                        {{ $donor->bloodGroup->name }}
                                    </span>
                                </div>

                            </div>

                            <!-- INFO -->
                            <div class="mt-3 text-sm text-gray-600 space-y-1">

                                <p>📞 {{ $donor->phone_number }}</p>
                                <p>📍 {{ Str::limit($donor->address, 40) }}</p>

                                <p>
                                    Status:
                                    @if ($donor->availability_status == 'available')
                                        <span class="text-green-600 font-semibold">Available</span>
                                    @else
                                        <span class="text-gray-500">Not Available</span>
                                    @endif
                                </p>

                            </div>

                            <!-- ACTION -->
                            <div class="mt-4 flex gap-2">

                                <a href="tel:{{ $donor->phone_number }}"
                                    class="flex-1 bg-green-500 text-white py-2 rounded-lg text-center">
                                    Call
                                </a>

                                <button class="flex-1 bg-red-500 text-white py-2 rounded-lg view-donor-btn"
                                    data-donor-id="{{ $donor->id }}">
                                    View
                                </button>

                            </div>

                        </div>
                    @endforeach

                </div>

                <!-- PAGINATION -->
                <div class="mt-8">
                    {{ $donors->links() }}
                </div>
            @endif

        </div>
    </section>

    <!-- MODAL -->
    <div id="donorModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

        <div class="bg-white w-full max-w-lg rounded-2xl p-6 relative">

            <button id="closeModal" class="absolute top-3 right-4 text-2xl text-gray-500">
                ×
            </button>

            <div id="donorModalBody">Loading...</div>

        </div>

    </div>

@endsection

@push('scripts')
    <script>
        const searchInput = document.getElementById('search-input');
        const bloodGroupSelect = document.getElementById('blood-group-select');
        const availabilitySelect = document.getElementById('availability-select');

        // DEBOUNCE
        function debounce(func, delay = 500) {

            let timer;

            return function(...args) {

                clearTimeout(timer);

                timer = setTimeout(() => {
                    func.apply(this, args);
                }, delay);

            };
        }

        // APPLY FILTERS
        function applyFilters() {

            const params = new URLSearchParams();

            // SEARCH
            if (searchInput.value.trim()) {
                params.append('search', searchInput.value.trim());
            }

            // BLOOD GROUP
            if (bloodGroupSelect.value) {
                params.append('blood_group', bloodGroupSelect.value);
            }

            // STATUS
            if (availabilitySelect.value) {
                params.append('availability_status', availabilitySelect.value);
            }

            window.location.href = `?${params.toString()}`;
        }

        // QUICK BLOOD BUTTON
        function setBlood(id) {

            bloodGroupSelect.value = id;

            applyFilters();
        }

        // EVENTS
        searchInput.addEventListener(
            'input',
            debounce(applyFilters, 500)
        );

        bloodGroupSelect.addEventListener(
            'change',
            debounce(applyFilters, 300)
        );

        availabilitySelect.addEventListener(
            'change',
            debounce(applyFilters, 300)
        );
    </script>
@endpush
