{{-- Extend the frontend layout --}}
@extends('layouts.frontend')

@section('content')
    <!-- Search and Filter Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <h2 class="h4">Search Donors</h2>
                </div>
                {{-- <div class="col-md-6 text-md-end">
                    <a href="{{ route('donors.create') }}" class="btn btn-primary btn-sm d-none d-md-block">Add Donor</a>
                </div> --}}
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" id="search-input" name="search" class="form-control"
                            placeholder="Search by name, phone, or email" value="{{ $request->input('search') }}">
                        <button class="btn btn-outline-secondary" type="button" id="search-reset">Reset</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <select id="blood-group-select" name="blood_group" class="form-select">
                        <option value="">All Blood Groups</option>
                        @foreach ($bloodGroups as $bloodGroup)
                            <option value="{{ $bloodGroup->id }}"
                                {{ $request->input('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                                {{ $bloodGroup->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select id="availability-select" name="availability_status" class="form-select">
                        <option value="">All Status</option>
                        <option value="available"
                            {{ $request->input('availability_status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="not_available"
                            {{ $request->input('availability_status') == 'not_available' ? 'selected' : '' }}>Not Available
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Donors Table Section -->
    <section class="py-4">
        <div class="container">
            @if ($donors->isEmpty())
                <div class="alert alert-info">No donors found matching your criteria.</div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Blood Group</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Last Donation</th>
                                <th>Availability</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($donors as $donor)
                                <tr>
                                    <td>
                                        @if ($donor->profile_photo)
                                            <img src="{{ Storage::url($donor->profile_photo) }}" alt="Donor Photo"
                                                class="img-fluid rounded"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                                style="width: 50px; height: 50px;">
                                                <i class="fas fa-user text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $donor->full_name }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ str_contains($donor->bloodGroup->name, '+') ? 'success' : 'danger' }}">
                                            {{ $donor->bloodGroup->name }}
                                        </span>
                                    </td>
                                    <td>{{ $donor->phone_number }}</td>
                                    <td>
                                        @if ($donor->gender === 'male')
                                            <span class="badge bg-primary">Male</span>
                                        @elseif($donor->gender === 'female')
                                            <span class="badge bg-danger">Female</span>
                                        @else
                                            <span class="badge bg-secondary">Other</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($donor->last_donation_date)
                                            {{ $donor->last_donation_date->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($donor->availability_status === 'available')
                                            <span class="badge bg-success">Available</span>
                                        @else
                                            <span class="badge bg-secondary">Not Available</span>
                                        @endif
                                    </td>
                                    <td class="text-truncate" style="max-width: 200px;">{{ $donor->address }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $donors->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const bloodGroupSelect = document.getElementById('blood-group-select');
            const availabilitySelect = document.getElementById('availability-select');
            const searchReset = document.getElementById('search-reset');

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
                // Check if elements exist before accessing them
                if (!searchInput && !bloodGroupSelect && !availabilitySelect) {
                    return;
                }

                const params = new URLSearchParams(window.location.search);

                // Get values safely
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

            // Reset search
            function resetSearch() {
                if (searchInput) {
                    searchInput.value = '';
                    updateFilters();
                }
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

            if (searchReset) {
                searchReset.addEventListener('click', function(e) {
                    e.preventDefault();
                    resetSearch();
                });
            }
        });
    </script>
@endpush
