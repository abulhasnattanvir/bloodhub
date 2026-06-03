@extends('layouts.admin')

@section('content')
    <div class="py-6 md:py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center gap-3 mb-8">
                <div
                    class="w-11 h-11 bg-red-100 text-red-600 rounded-3xl flex items-center justify-center shadow-sm flex-shrink-0">
                    <i class="fas fa-hand-holding-heart text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Add New Donor</h1>
                    <p class="text-gray-500 text-sm md:text-base">Register a new blood donor</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">
                <div class="p-6 md:p-8">
                    <form method="POST" action="{{ route('admin.donors.store') }}" enctype="multipart/form-data"
                        class="space-y-8">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">

                            <!-- Full Name -->
                            <div>
                                <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base"
                                    required>
                                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                            </div>

                            <!-- Profile Photo -->
                            <div>
                                <label for="profile_photo" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Profile Photo
                                </label>
                                <input type="file" id="profile_photo" name="profile_photo" accept="image/*"
                                    class="block w-full text-base text-gray-500 file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                                <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                            </div>

                            <!-- Blood Group & Phone -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="blood_group_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Blood Group <span class="text-red-500">*</span>
                                    </label>
                                    <select id="blood_group_id" name="blood_group_id"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base"
                                        required>
                                        <option value="">Select Blood Group</option>
                                        @foreach ($bloodGroups as $bloodGroup)
                                            <option value="{{ $bloodGroup->id }}"
                                                {{ old('blood_group_id') == $bloodGroup->id ? 'selected' : '' }}>
                                                {{ $bloodGroup->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('blood_group_id')" class="mt-2" />
                                </div>

                                <div>
                                    <label for="phone_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number') }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base"
                                        required>
                                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Gender <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-wrap gap-x-8 gap-y-3">
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="male"
                                            {{ old('gender') == 'male' ? 'checked' : '' }}
                                            class="w-5 h-5 text-red-600 focus:ring-red-500">
                                        <span class="text-gray-700 text-base">Male</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="female"
                                            {{ old('gender') == 'female' ? 'checked' : '' }}
                                            class="w-5 h-5 text-red-600 focus:ring-red-500">
                                        <span class="text-gray-700 text-base">Female</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="radio" name="gender" value="other"
                                            {{ old('gender') == 'other' ? 'checked' : '' }}
                                            class="w-5 h-5 text-red-600 focus:ring-red-500">
                                        <span class="text-gray-700 text-base">Other</span>
                                    </label>
                                </div>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Address <span class="text-red-500">*</span>
                                </label>
                                <textarea id="address" name="address" rows="3"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base"
                                    required>{{ old('address') }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <!-- Last Donation + Availability -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="last_donation_date" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Last Donation Date
                                    </label>
                                    <input type="date" id="last_donation_date" name="last_donation_date"
                                        value="{{ old('last_donation_date') }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 py-4 px-5 text-base">
                                    <x-input-error :messages="$errors->get('last_donation_date')" class="mt-2" />
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                                        Availability <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex flex-wrap gap-x-6 gap-y-3">
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="availability_status" value="available"
                                                {{ old('availability_status') == 'available' ? 'checked' : '' }}
                                                class="w-5 h-5 text-green-600 focus:ring-green-500">
                                            <span class="text-gray-700">Available</span>
                                        </label>
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="radio" name="availability_status" value="not_available"
                                                {{ old('availability_status') == 'not_available' ? 'checked' : '' }}
                                                class="w-5 h-5 text-red-600 focus:ring-red-500">
                                            <span class="text-gray-700">Not Available</span>
                                        </label>
                                    </div>
                                    <x-input-error :messages="$errors->get('availability_status')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 py-4 px-5 text-base">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Notes -->
                            <div>
                                <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Notes
                                </label>
                                <textarea id="notes" name="notes" rows="4"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 py-4 px-5 text-base">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row items-center gap-3 pt-8 border-t border-gray-100">
                            <a href="{{ route('admin.donors.index') }}"
                                class="w-full sm:w-auto text-center px-6 py-4 text-gray-600 hover:bg-gray-100 rounded-2xl transition font-medium">
                                Cancel
                            </a>

                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl shadow-sm transition">
                                <i class="fas fa-save"></i>
                                Create Donor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
