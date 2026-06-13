@extends('layouts.admin')
{{-- @php
    $settings = \App\Models\ContactSetting::first();
@endphp --}}
@section('content')
    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Site Settings</h1>
                    <p class="text-gray-500 mt-1">Manage your website basic information</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data"
                        class="space-y-10">
                        @csrf

                        <!-- Basic Information -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-info-circle text-red-500"></i>
                                Basic Information
                            </h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Site Name</label>
                                    <input type="text" name="site_name"
                                        placeholder="Enter your organization or site name"
                                        value="{{ $settings['site_name'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tagline</label>
                                    <input type="text" name="tagline" placeholder="Enter tagline or slogan"
                                        value="{{ $settings['tagline'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                            </div>
                        </div>

                        <!-- Transaction Information -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fa-regular fa-credit-card text-red-500"></i>
                                Transaction Info (Mobile Banking)
                            </h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bkash Number</label>
                                    <input type="text" name="bkashNumber" placeholder="01XXXXXXXXX"
                                        value="{{ $settings['bkashNumber'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nagad Number</label>
                                    <input type="text" name="nagadNumber" placeholder="01XXXXXXXXX"
                                        value="{{ $settings['nagadNumber'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-building-columns text-red-500"></i>
                                Bank Account info
                            </h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Account Name</label>
                                    <input type="text" name="accName" placeholder="Enter account holder full name"
                                        value="{{ $settings['accName'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Account Number</label>
                                    <input type="text" name="accNumber" placeholder="Enter account number"
                                        value="{{ $settings['accNumber'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Bank Name</label>
                                    <input type="text" name="bankName"
                                        placeholder="Enter bank name (e.g. Dutch Bangla Bank)"
                                        value="{{ $settings['bankName'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Route Number</label>
                                    <input type="text" name="routeNumber" placeholder="Enter routing number"
                                        value="{{ $settings['routeNumber'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-address-book text-red-500"></i>
                                Contact Information
                            </h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                    <input type="email" name="email" placeholder="example@domain.com"
                                        value="{{ $settings['email'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                    <input type="text" name="phone" placeholder="01XXXXXXXXX"
                                        value="{{ $settings['phone'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Address</label>
                                    <input type="text" name="address" placeholder="Enter complete address"
                                        value="{{ $settings['address'] ?? '' }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                </div>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-footer text-red-500"></i>
                                Footer
                            </h2>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Footer Text</label>
                                <textarea name="footer_text" rows="4" placeholder="Enter footer copyright text or additional information..."
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">{{ $settings['footer_text'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <!-- Media -->
                        <div>
                            <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                                <i class="fas fa-image text-red-500"></i>
                                Website Media
                            </h2>

                            <div class="grid md:grid-cols-2 gap-8">
                                <!-- Logo -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Header Logo</label>

                                    @if (!empty($settings['logo']))
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $settings['logo']) }}"
                                                class="h-20 w-auto border border-gray-100 rounded-2xl p-1">
                                        </div>
                                    @endif
                                    <input type="file" name="logo"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                                </div>

                                <!-- Footer Logo -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Footer Logo</label>
                                    @if (!empty($settings['flogo']))
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $setting['flogo']) }}"
                                                class="h-20 w-auto border border-gray-100 rounded-2xl p-1">
                                        </div>
                                    @endif
                                    <input type="file" name="flogo"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                                </div>

                                <!-- Favicon -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Favicon</label>
                                    @if (!empty($settings['favicon']))
                                        <div class="mb-3">
                                            <img src="{{ asset('storage/' . $settings['favicon']) }}"
                                                class="h-12 w-auto border border-gray-100 rounded-xl p-1">
                                        </div>
                                    @endif
                                    <input type="file" name="favicon"
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6 border-t">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl shadow-sm transition">
                                <i class="fas fa-save"></i>
                                Save All Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
