{{-- Extend the frontend layout --}}
@extends('layouts.frontend')

{{-- Define the content for the slot --}}
@section('content')
    <!-- Search and Filter Section -->
    <section class="py-4 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <h2 class="h4">Donor List</h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('donors.create') }}" class="btn btn-primary btn-sm d-none d-md-block">Add Donor</a>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3">
                    <form method="GET" action="{{ route('donors.list') }}" class="input-group">
                         <input type="text" name="name" class="form-control" placeholder="Search by name" value="{{ $request->input('name') }}">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </form>
                </div>
                <div class="col-md-3">
                    <select name="blood_group" class="form-select" onchange="this.form.submit()">
                        <option value="">All Blood Groups</option>
                        @foreach($bloodGroups as $bloodGroup)
                            <option value="{{ $bloodGroup->id }}" {{ $request->input('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                                {{ $bloodGroup->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="gender" class="form-select" onchange="this.form.submit()">
                        <option value="">All Genders</option>
                        <option value="male" {{ $request->input('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $request->input('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ $request->input('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="availability_status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Status</option>
                        <option value="available" {{ $request->input('availability_status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="not_available" {{ $request->input('availability_status') == 'not_available' ? 'selected' : '' }}>Not Available</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Donors Table Section -->
    <section class="py-4">
        <div class="container">
            @if($donors->isEmpty())
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
                            @foreach($donors as $donor)
                                <tr>
                                    <td>
                                        @if($donor->profile_photo)
                                            <img src="{{ Storage::url($donor->profile_photo) }}" alt="Donor Photo" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                                <i class="fas fa-user text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $donor->full_name }}</td>
                                    <td>
                                        <span class="badge bg-{{ str_contains($donor->bloodGroup->name, '+') ? 'success' : 'danger' }}">
                                            {{ $donor->bloodGroup->name }}
                                        </span>
                                    </td>
                                    <td>{{ $donor->phone_number }}</td>
                                    <td>
                                        @if($donor->gender === 'male')
                                            <span class="badge bg-primary">Male</span>
                                        @elseif($donor->gender === 'female')
                                            <span class="badge bg-danger">Female</span>
                                        @else
                                            <span class="badge bg-secondary">Other</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($donor->last_donation_date)
                                            {{ $donor->last_donation_date->format('M d, Y') }}
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($donor->availability_status === 'available')
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