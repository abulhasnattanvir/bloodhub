{{-- Extend the frontend layout --}}
@extends('layouts.frontend')

{{-- Define the content for the slot --}}
@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 mb-4">Save Lives with Every Drop</h1>
            <p class="lead mb-4">Find blood donors quickly and easily in your area</p>
            <a href="{{ route('search') }}" class="btn btn-primary btn-lg">Search Donors</a>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-3">
                    <div class="stats-card p-4">
                        <i class="fas fa-users fa-2x text-primary mb-3"></i>
                        <h3>{{ $totalDonors }}</h3>
                        <p class="text-muted">Total Donors</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card p-4">
                        <i class="fas fa-tint-slash fa-2x text-success mb-3"></i>
                        <h3>{{ $availableDonors }}</h3>
                        <p class="text-muted">Available Donors</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card p-4">
                        <i class="fas fa-heart-pulse fa-2x text-danger mb-3"></i>
                        <h3>85%</p>
                        <p class="text-muted">Match Success Rate</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card p-4">
                        <i class="fas fa-map-marked-alt fa-2x text-info mb-3"></i>
                        <h3>24/7</p>
                        <p class="text-muted">Emergency Support</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Recent Donors Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Recent Donors</h2>
            <div class="row g-4">
                @foreach($recentDonors as $donor)
                    <div class="col-md-3">
                        <div class="donor-card h-100 p-4">
                            @if($donor->profile_photo)
                                <img src="{{ Storage::url($donor->profile_photo) }}" alt="Donor Photo" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px;">
                                    <i class="fas fa-user fa-2x text-muted"></i>
                                </div>
                            @endif
                            <h5>{{ $donor->full_name }}</h5>
                            <span class="badge bg-{{ str_contains($donor->bloodGroup->name, '+') ? 'success' : 'danger' }} mb-2">{{ $donor->bloodGroup->name }}</span>
                            <p class="text-muted small mb-2">{{ $donor->phone_number }}</p>
                            @if($donor->availability_status === 'available')
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-secondary">Not Available</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">How It Works</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <i class="fas fa-search fa-2x text-primary mb-3"></i>
                        <h3>Search</h3>
                        <p>Find donors by blood group, location, and availability</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <i class="fas fa-hand-holding-heart fa-2x text-success mb-3"></i>
                        <h3>Connect</h3>
                        <p>Contact donors directly through our secure platform</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center p-4">
                        <i class="fas fa-tint fa-2x text-danger mb-3"></i>
                        <h3>Save Lives</h3>
                        <p>Every donation makes a difference in someone's life</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection