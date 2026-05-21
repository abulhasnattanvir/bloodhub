<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Donor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.donors.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <!-- Full Name -->
                            <div class="sm:col-span-2">
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Full Name') }}
                                </label>
                                <input type="text" id="full_name" name="full_name" 
                                       value="{{ old('full_name') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm"
                                       required>
                                <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                            </div>

                            <!-- Profile Photo -->
                            <div>
                                <label for="profile_photo" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Profile Photo') }}
                                </label>
                                <input type="file" id="profile_photo" name="profile_photo" 
                                       accept="image/*"
                                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary-dark">
                                <x-input-error :messages="$errors->get('profile_photo')" class="mt-2" />
                                @if(old('profile_photo'))
                                    <p class="mt-1 text-sm text-gray-500">{{ __('Currently selected photo will be uploaded.') }}</p>
                                @endif
                            </div>

                            <!-- Blood Group -->
                            <div>
                                <label for="blood_group_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Blood Group') }} *
                                </label>
                                <select id="blood_group_id" name="blood_group_id" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm"
                                        required>
                                    <option value=""> {{ __('Select Blood Group') }} </option>
                                    @foreach($bloodGroups as $bloodGroup)
                                        <option value="{{ $bloodGroup->id }}" 
                                                {{ old('blood_group_id') == $bloodGroup->id ? 'selected' : '' }}>
                                            {{ $bloodGroup->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('blood_group_id')" class="mt-2" />
                            </div>

                            <!-- Phone Number -->
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Phone Number') }} *
                                </label>
                                <input type="tel" id="phone_number" name="phone_number" 
                                       value="{{ old('phone_number') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm"
                                       required>
                                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                            </div>

                            <!-- Gender -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Gender') }} *
                                </label>
                                <div class="mt-1 flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <input id="gender_male" type="radio" name="gender" value="male" 
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm {{ old('gender') == 'male' ? 'checked' : '' }}">
                                        <label for="gender_male" class="ml-2 text-sm text-gray-700">{{ __('Male') }}</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="gender_female" type="radio" name="gender" value="female" 
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm ml-6 {{ old('gender') == 'female' ? 'checked' : '' }}">
                                        <label for="gender_female" class="ml-2 text-sm text-gray-700">{{ __('Female') }}</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="gender_other" type="radio" name="gender" value="other" 
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm ml-6 {{ old('gender') == 'other' ? 'checked' : '' }}">
                                        <label for="gender_other" class="ml-2 text-sm text-gray-700">{{ __('Other') }}</label>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                            </div>

                            <!-- Address -->
                            <div class="sm:col-span-2">
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Address') }} *
                                </label>
                                <textarea id="address" name="address" rows="3" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm"
                                          required>{{ old('address') }}</textarea>
                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                            </div>

                            <!-- Last Donation Date -->
                            <div>
                                <label for="last_donation_date" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Last Donation Date') }}
                                </label>
                                <input type="date" id="last_donation_date" name="last_donation_date" 
                                       value="{{ old('last_donation_date') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">
                                <x-input-error :messages="$errors->get('last_donation_date')" class="mt-2" />
                            </div>

                            <!-- Availability Status -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Availability Status') }} *
                                </label>
                                <div class="mt-1 flex items-center space-x-4">
                                    <div class="flex items-center">
                                        <input id="available" type="radio" name="availability_status" value="available" 
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm {{ old('availability_status') == 'available' ? 'checked' : '' }}">
                                        <label for="available" class="ml-2 text-sm text-gray-700">{{ __('Available') }}</label>
                                    </div>
                                    <div class="flex items-center">
                                        <input id="not_available" type="radio" name="availability_status" value="not_available" 
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm ml-6 {{ old('availability_status') == 'not_available' ? 'checked' : '' }}">
                                        <label for="not_available" class="ml-2 text-sm text-gray-700">{{ __('Not Available') }}</label>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('availability_status')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Email') }}
                                </label>
                                <input type="email" id="email" name="email" 
                                       value="{{ old('email') }}" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Notes -->
                            <div class="sm:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('Notes') }}
                                </label>
                                <textarea id="notes" name="notes" rows="4" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">{{ old('notes') }}</textarea>
                                <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end sm:col-span-2">
                            <a href="{{ route('admin.donors.index') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" 
                                    class="ms-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                                {{ __('Create Donor') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>