<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Blood Group') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-4">
                        <a href="{{ route('admin.blood-groups.index') }}" 
                           class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            <i class="fas fa-arrow-left mr-2"></i>
                            {{ __('Back to Blood Groups List') }}
                        </a>
                    </div>

                    <!-- Blood Group Info -->
                    <div class="space-y-6">
                        <!-- Basic Info -->
                        <div class="text-center">
                            <div class="w-48 h-48 rounded-full bg-primary flex items-center justify-center mx-auto mb-4">
                                <span class="text-4xl text-white font-bold">{{ $bloodGroup->name }}</span>
                            </div>
                            
                            <h3 class="text-xl font-semibold text-gray-900">{{ $bloodGroup->name }} Blood Group</h3>
                            @if($bloodGroup->description)
                                <p class="text-gray-500">{{ $bloodGroup->description }}</p>
                            @endif
                        </div>

                        <!-- Additional Info -->
                        <div class="border-t border-gray-200 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('Additional Information') }}</h3>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-info-circle text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Description') }}</p>
                                        <p class="text-gray-700">{{ $bloodGroup->description ?? __('No description provided') }}</p>
                                    </div>
                                </div>
                                
                                @php
                                $donorCount = $bloodGroup->donors()->count();
                                $availableDonors = $bloodGroup->donors()->where('availability_status', 'available')->count();
                                @endphp
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-users text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Total Donors') }}</p>
                                        <p class="text-gray-700">{{ $donorCount }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-check-circle text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Available Donors') }}</p>
                                        <p class="text-gray-700">{{ $availableDonors }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-calendar-alt text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Created At') }}</p>
                                        <p class="text-gray-700">{{ $bloodGroup->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 h-5 w-5">
                                        <i class="fas fa-sync-alt text-primary"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ __('Updated At') }}</p>
                                        <p class="text-gray-700">{{ $bloodGroup->updated_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>