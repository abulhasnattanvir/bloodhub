@extends('layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header with title and actions -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    Dashboard Overview
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    Monitor your blood donation center's performance
                </p>
            </div>
            <div class="flex items-center space-x-3 mt-4 sm:mt-0">
                <a href="{{ route('admin.donors.create') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Donor
                </a>
                <a href="{{ route('admin.blood-groups.create') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <i class="fas fa-tint mr-2"></i>
                    Add Blood Group
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Total Donors -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-blue-500">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-500">
                            Total Donors
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center bg-blue-500/10 rounded-full">
                            <i class="fas fa-users text-blue-600"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">
                            {{ $totalDonors }}
                        </span>
                        <span class="ml-1 text-sm font-medium text-gray-500">
                            donors
                        </span>
                    </div>
                    <div class="mt-2 text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $availableDonors }} available
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Available Donors -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-green-500">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-500">
                            Available Donors
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center bg-green-500/10 rounded-full">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">
                            {{ $availableDonors }}
                        </span>
                        <span class="ml-1 text-sm font-medium text-gray-500">
                            donors
                        </span>
                    </div>
                    <div class="mt-2 text-sm">
                        @php
                            $availabilityPercent = $totalDonors > 0 ? round(($availableDonors / $totalDonors) * 100, 1) : 0;
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ $availabilityPercent }}% availability
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Blood Groups -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-indigo-500">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-500">
                            Blood Groups
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center bg-indigo-500/10 rounded-full">
                            <i class="fas fa-tint text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">
                            {{ count($bloodGroupStats) }}
                        </span>
                        <span class="ml-1 text-sm font-medium text-gray-500">
                            types
                        </span>
                    </div>
                    <div class="mt-2 text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ count($bloodGroupStats) }} groups tracked
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Today's Activity -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border-l-4 border-yellow-500">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm font-medium text-gray-500">
                            Today's Activity
                        </div>
                        <div class="flex h-10 w-10 items-center justify-center bg-yellow-500/10 rounded-full">
                            <i class="fas fa-calendar-alt text-yellow-600"></i>
                        </div>
                    </div>
                    <div class="mt-3 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">
                            {{ $todayDonations }}
                        </span>
                        <span class="ml-1 text-sm font-medium text-gray-500">
                            donations
                        </span>
                    </div>
                    <div class="mt-2 text-sm">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            {{ $todayDonors }} donors
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Tables -->
        <div class="grid gap-6 mb-8">
            <!-- Recent Donors Table -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            Recent Donors
                        </h3>
                        <a href="{{ route('admin.donors.index') }}"
                           class="text-sm font-medium text-blue-600 hover:text-blue-700">
                            View All <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if($recentDonors->isEmpty())
                        <div class="text-center py-8">
                            <i class="fas fa-users-slash text-gray-300 mb-4 h-12 w-12"></i>
                            <p class="text-sm text-gray-500">
                                No recent donors found
                            </p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($recentDonors as $donor)
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                    <!-- Profile Image -->
                                    <div class="relative h-11 w-11 flex-shrink-0">
                                        @if($donor->profile_photo)
                                            <img src="{{ Storage::url($donor->profile_photo) }}" 
                                                 alt="{{ $donor->full_name }}" 
                                                 class="h-11 w-11 rounded-full object-cover border-2 border-white">
                                        @else
                                            <div class="h-11 w-11 rounded-full bg-gray-200 flex items-center justify-center">
                                                <i class="fas fa-user text-gray-500"></i>
                                            </div>
                                        @endif
                                        <!-- Status Indicator -->
                                        <div class="absolute bottom-0 right-0 h-2.5 w-2.5 {{ $donor->availability_status === 'available' ? 'bg-green-500' : 'bg-red-500' }} rounded-full border-2 border-white"></div>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900 truncate max-w-xs">
                                            {{ $donor->full_name }}
                                        </h4>
                                        <p class="text-sm text-gray-500 truncate">
                                            {{ $donor->bloodGroup->name }} • {{ $donor->availability_status }}
                                        </p>
                                    </div>
                                    
                                    <!-- Action Button -->
                                    <a href="{{ route('admin.donors.show', $donor->id) }}"
                                       class="text-sm font-medium text-blue-600 hover:text-blue-700">
                                        View <i class="fas fa-eye ml-1"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Blood Group Distribution -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">
                            Blood Group Distribution
                        </h3>
                        <a href="{{ route('admin.blood-groups.index') }}"
                           class="text-sm font-medium text-blue-600 hover:text-blue-700">
                            Manage <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    @if(count($bloodGroupStats) > 0)
                        <div class="space-y-3">
                            @php
                                $maxCount = max($bloodGroupStats);
                                $totalCount = array_sum($bloodGroupStats);
                            @endphp
                            @foreach($bloodGroupStats as $bloodGroup => $count)
                                <div class="flex items-center">
                                    <div class="w-1/4 text-sm font-medium text-gray-700">
                                        @php
                                            $color = match($bloodGroup) {
                                                'O+' => 'bg-red-500',
                                                'O-' => 'bg-red-600',
                                                'A+', 'A-' => 'bg-blue-500',
                                                'B+', 'B-' => 'bg-green-500',
                                                'AB+', 'AB-' => 'bg-purple-500',
                                                default => 'bg-gray-500'
                                            };
                                        @endphp
                                        <span class="inline-flex h-2.5 w-2.5 me-2 rounded {{ $color }}"></span>
                                        {{ $bloodGroup }}
                                    </div>
                                    <div class="w-1/2 bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-500 h-2.5 rounded-full" 
                                             style="width: {{ $maxCount > 0 ? (($count / $maxCount) * 100) : 0 }}%;"></div>
                                    </div>
                                    <div class="w-1/4 text-sm font-medium text-gray-700 text-right">
                                        @php
                                            $percentage = $totalCount > 0 ? round(($count / $totalCount) * 100, 1) : 0;
                                        @endphp
                                        {{ $count }} ({{ $percentage }}%)
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-tint-slash text-gray-300 mb-4 h-12 w-12"></i>
                            <p class="text-sm text-gray-500">
                                No blood group data available
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Quick Actions -->
        <div class="bg-white overflow-hidden shadow-sm rounded-lg">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        Quick Actions
                    </h3>
                    <a href="{{ route('admin.donors.index') }}"
                       class="text-sm font-medium text-blue-600 hover:text-blue-700">
                        View All Actions <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Add Donor -->
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-blue-50/100 transition-colors duration-200">
                        <div class="flex items-center mb-3">
                            <div class="flex h-10 w-10 items-center justify-center bg-blue-500/10 rounded-full">
                                <i class="fas fa-user-plus text-blue-600"></i>
                            </div>
                            <h4 class="ml-3 font-medium text-gray-900">
                                Add New Donor
                            </h4>
                        </div>
                        <p class="text-sm text-gray-500">
                            Register a new blood donor in the system
                        </p>
                        <a href="{{ route('admin.donors.create') }}"
                           class="mt-3 inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                            Add Donor <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- Add Blood Group -->
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-green-50/100 transition-colors duration-200">
                        <div class="flex items-center mb-3">
                            <div class="flex h-10 w-10 items-center justify-center bg-green-500/10 rounded-full">
                                <i class="fas fa-tint text-green-600"></i>
                            </div>
                            <h4 class="ml-3 font-medium text-gray-900">
                                Add Blood Group
                            </h4>
                        </div>
                        <p class="text-sm text-gray-500">
                            Add new blood types to the system
                        </p>
                        <a href="{{ route('admin.blood-groups.create') }}"
                           class="mt-3 inline-flex items-center text-sm font-medium text-green-600 hover:text-green-700">
                            Add Group <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- View Reports -->
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-indigo-50/100 transition-colors duration-200">
                        <div class="flex items-center mb-3">
                            <div class="flex h-10 w-10 items-center justify-center bg-indigo-500/10 rounded-full">
                                <i class="fas fa-chart-bar text-indigo-600"></i>
                            </div>
                            <h4 class="ml-3 font-medium text-gray-900">
                                View Reports
                            </h4>
                        </div>
                        <p class="text-sm text-gray-500">
                            Check donation statistics and trends
                        </p>
                        <a href="{{ route('admin.donors.index') }}"
                           class="mt-3 inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-700">
                            View Reports <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- Backup Data -->
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-yellow-50/100 transition-colors duration-200">
                        <div class="flex items-center mb-3">
                            <div class="flex h-10 w-10 items-center justify-center bg-yellow-500/10 rounded-full">
                                <i class="fas fa-save text-yellow-600"></i>
                            </div>
                            <h4 class="ml-3 font-medium text-gray-900">
                                Backup Data
                            </h4>
                        </div>
                        <p class="text-sm text-gray-500">
                            Create a backup of all donation data
                        </p>
                        <a href="#"
                           class="mt-3 inline-flex items-center text-sm font-medium text-yellow-600 hover:text-yellow-700">
                            Backup <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- System Settings -->
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-gray-50/100 transition-colors duration-200">
                        <div class="flex items-center mb-3">
                            <div class="flex h-10 w-10 items-center justify-center bg-gray-500/10 rounded-full">
                                <i class="fas fa-cog text-gray-600"></i>
                            </div>
                            <h4 class="ml-3 font-medium text-gray-900">
                                System Settings
                            </h4>
                        </div>
                        <p class="text-sm text-gray-500">
                            Configure system preferences and settings
                        </p>
                        <a href="{{ route('admin.settings.index') }}"
                           class="mt-3 inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-700">
                            Settings <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <!-- Donor Communication -->
                    <div class="bg-gray-50 p-4 rounded-lg hover:bg-purple-50/100 transition-colors duration-200">
                        <div class="flex items-center mb-3">
                            <div class="flex h-10 w-10 items-center justify-center bg-purple-500/10 rounded-full">
                                <i class="fas fa-envelope text-purple-600"></i>
                            </div>
                            <h4 class="ml-3 font-medium text-gray-900">
                                Communicate
                            </h4>
                        </div>
                        <p class="text-sm text-gray-500">
                            Send notifications and updates to donors
                        </p>
                        <a href="#"
                           class="mt-3 inline-flex items-center text-sm font-medium text-purple-600 hover:text-purple-700">
                            Communicate <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Add any dashboard-specific JavaScript here
    document.addEventListener('DOMContentLoaded', function() {
        // Example: Add animation to stats cards on scroll
        const observerOptions = {
            threshold: 0.1
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.stats-card, .chart-card, .quick-action-card').forEach(card => {
            observer.observe(card);
        });
    });
</script>
@endpush