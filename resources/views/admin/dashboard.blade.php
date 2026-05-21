@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">
            <!-- Total Donors -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Total Donors</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ $totalDonors }}</div>
                </div>
            </div>
            
            <!-- Available Donors -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Available Donors</div>
                    <div class="text-2xl font-semibold text-success">{{ $availableDonors }}</div>
                </div>
            </div>
            
            <!-- Unavailable Donors -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Unavailable Donors</div>
                    <div class="text-2xl font-semibold text-danger">{{ $totalDonors - $availableDonors }}</div>
                </div>
            </div>
            
            <!-- Blood Groups -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="text-sm font-medium text-gray-500">Blood Groups</div>
                    <div class="text-2xl font-semibold text-gray-900">{{ count($bloodGroupStats) }}</div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Donors -->
        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <!-- Recent Donors -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Recent Donors</h3>
                        <a href="{{ route('admin.donors.index') }}" class="text-sm font-medium text-primary hover:text-primary-dark">
                            See All
                        </a>
                    </div>
                    
                    @if($recentDonors->isEmpty())
                        <p class="text-center text-gray-500 py-8">No donors found.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($recentDonors as $donor)
                                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                    @if($donor->profile_photo)
                                        <img src="{{ Storage::url($donor->profile_photo) }}" alt="{{ $donor->full_name }}" class="w-12 h-12 rounded-full object-cover border-2 border-white">
                                    @else
                                        <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500"></i>
                                        </div>
                                    @endif
                                    
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $donor->full_name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $donor->bloodGroup->name }}</p>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                            {{ $donor->availability_status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($donor->availability_status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Blood Group Stats (Simple Bar Chart Alternative) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Blood Group Distribution</h3>
                    </div>
                    
                    @if(count($bloodGroupStats) > 0)
                        <div class="space-y-3">
                            @foreach($bloodGroupStats as $bloodGroup => $count)
                                <div class="flex items-center">
                                    <div class="w-3/12 text-sm font-medium text-gray-700">{{ $bloodGroup }}</div>
                                    <div class="w-6/12 bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-primary h-2.5 rounded-full" 
                                             style="width: {{ (($count / max($bloodGroupStats)) * 100) }}%;"></div>
                                    </div>
                                    <div class="w-3/12 text-sm font-medium text-gray-700 text-right">{{ $count }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-8">No blood group data available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection