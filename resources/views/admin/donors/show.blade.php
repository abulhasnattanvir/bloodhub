@extends('layouts.admin')

@section('content')
    <div class="py-6 md:py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-red-100 text-red-600 rounded-3xl flex items-center justify-center shadow-sm">
                        <i class="fas fa-user text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Donor Profile</h1>
                        <p class="text-gray-500">View donor information</p>
                    </div>
                </div>

                <a href="{{ route('admin.donors.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 rounded-2xl text-gray-700 hover:bg-gray-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    Back to List
                </a>
            </div>

            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">
                <div class="p-6 md:p-10">

                    <div class="flex flex-col md:flex-row gap-8">

                        <!-- Profile Photo -->
                        <div class="flex-shrink-0 text-center md:text-left">
                            @if ($donor->profile_photo)
                                <img src="{{ Storage::url($donor->profile_photo) }}" alt="{{ $donor->full_name }}"
                                    class="w-40 h-40 md:w-48 md:h-48 rounded-3xl object-cover border-4 border-red-100 shadow-md mx-auto md:mx-0">
                            @else
                                <div
                                    class="w-40 h-40 md:w-48 md:h-48 rounded-3xl bg-gray-100 flex items-center justify-center mx-auto md:mx-0 border-4 border-gray-100">
                                    <i class="fas fa-user text-6xl text-gray-300"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Basic Information -->
                        <div class="flex-1">
                            <h2 class="text-3xl font-bold text-gray-900">{{ $donor->full_name }}</h2>
                            <div class="flex items-center gap-2 mt-2">
                                <span
                                    class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 font-semibold rounded-2xl text-lg">
                                    {{ $donor->bloodGroup->name ?? 'N/A' }}
                                </span>
                                <span
                                    class="px-3 py-1.5 text-sm font-medium rounded-2xl
                                    {{ $donor->availability_status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($donor->availability_status) }}
                                </span>
                            </div>

                            <div class="mt-8 space-y-5">
                                <div class="flex items-start gap-4">
                                    <div class="w-6 text-red-500 mt-0.5">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Phone Number</p>
                                        <p class="text-lg font-medium text-gray-800">{{ $donor->phone_number }}</p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-6 text-blue-500 mt-0.5">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Email Address</p>
                                        <p class="text-lg font-medium text-gray-800">{{ $donor->email ?? 'Not provided' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-6 text-red-500 mt-0.5">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Address</p>
                                        <p class="text-gray-700 leading-relaxed">{{ $donor->address }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="mt-12 border-t border-gray-100 pt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6">Additional Information</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div>
                                <p class="text-sm text-gray-500">Gender</p>
                                <p class="text-xl font-medium text-gray-800">{{ ucfirst($donor->gender) }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Last Donation Date</p>
                                <p class="text-xl font-medium text-gray-800">
                                    {{ $donor->last_donation_date
                                        ? $donor->last_donation_date->format('F d, Y')
                                        : '<span class="text-gray-400">Never Donated</span>' }}
                                </p>
                            </div>

                            <div class="sm:col-span-2">
                                <p class="text-sm text-gray-500 mb-2">Notes</p>
                                <div class="bg-gray-50 rounded-2xl p-5 text-gray-700 leading-relaxed min-h-[100px]">
                                    {{ $donor->notes ?? 'No notes available.' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 mt-12">
                        <a href="{{ route('admin.donors.edit', $donor->id) }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-2xl transition">
                            <i class="fas fa-edit"></i>
                            Edit Donor
                        </a>

                        <form action="{{ route('admin.donors.destroy', $donor->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Are you sure you want to delete this donor?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-6 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl transition">
                                <i class="fas fa-trash"></i>
                                Delete Donor
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
