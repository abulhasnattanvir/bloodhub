@extends('layouts.admin')

@section('content')
    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <a href="{{ route('admin.donors.index') }}"
                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Back to Donors List') }}
                        </a>
                    </div>

                    <!-- Donor Info -->
                    <div class="space-y-6">
                        <!-- Profile Photo and Basic Info -->
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Profile Photo -->
                            <div class="text-center">
                                @if ($donor->profile_photo)
                                    <img src="{{ Storage::url($donor->profile_photo) }}" alt="{{ $donor->full_name }}"
                                        class="w-48 h-48 rounded-full object-cover border-4 border-primary mx-auto mb-4">
                                @else
                                    <div
                                        class="w-48 h-48 rounded-full bg-gray-200 flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-user text-gray-500 text-3xl"></i>
                                    </div>
                                @endif

                                <h3 class="text-xl font-semibold text-gray-900">{{ $donor->full_name }}</h3>
                                <p class="text-gray-500">{{ $donor->bloodGroup->name }} Blood Group</p>
                            </div>

                            <!-- Contact Info -->
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-phone text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Phone Number') }}</p>
                                        <p class="text-gray-700">{{ $donor->phone_number }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-envelope text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Email') }}</p>
                                        <p class="text-gray-700">{{ $donor->email }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Address') }}</p>
                                        <p class="text-gray-700">{{ $donor->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Information') }}</h3>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('Gender') }}</p>
                                    <p class="text-gray-700">{{ ucfirst($donor->gender) }}</p>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('Last Donation Date') }}</p>
                                    @if ($donor->last_donation_date)
                                        <p class="text-gray-700">{{ $donor->last_donation_date->format('M d, Y') }}</p>
                                    @else
                                        <p class="text-gray-500">{{ __('Never') }}</p>
                                    @endif
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('Availability Status') }}</p>
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $donor->availability_status === 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($donor->availability_status) }}
                                    </span>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500">{{ __('Notes') }}</p>
                                    @if ($donor->notes)
                                        <p class="text-gray-700 whitespace-pre-wrap">{{ $donor->notes }}</p>
                                    @else
                                        <p class="text-gray-500">{{ __('No notes available') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
