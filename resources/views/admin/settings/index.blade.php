<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.settings.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <!-- Site Information -->
                            <div class="border-b border-gray-200 pb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    {{ __('Site Information') }}
                                </h3>
                                
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <!-- Site Name -->
                                    <div>
                                        <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">
                                            {{ __('Site Name') }} *
                                        </label>
                                        <input type="text" id="site_name" name="site_name" 
                                               value="{{ old('site_name', $settings['site_name']) }}" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm"
                                               required>
                                        <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Site Email -->
                                    <div>
                                        <label for="site_email" class="block text-sm font-medium text-gray-700 mb-1">
                                            {{ __('Site Email') }}
                                        </label>
                                        <input type="email" id="site_email" name="site_email" 
                                               value="{{ old('site_email', $settings['site_email']) }}" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">
                                        <x-input-error :messages="$errors->get('site_email')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Site Phone -->
                                    <div>
                                        <label for="site_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                            {{ __('Site Phone') }}
                                        </label>
                                        <input type="tel" id="site_phone" name="site_phone" 
                                               value="{{ old('site_phone', $settings['site_phone']) }}" 
                                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">
                                        <x-input-error :messages="$errors->get('site_phone')" class="mt-2" />
                                    </div>
                                    
                                    <!-- Site Address -->
                                    <div class="sm:col-span-2">
                                        <label for="site_address" class="block text-sm font-medium text-gray-700 mb-1">
                                            {{ __('Site Address') }}
                                        </label>
                                        <textarea id="site_address" name="site_address" rows="3" 
                                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">{{ old('site_address', $settings['site_address']) }}</textarea>
                                        <x-input-error :messages="$errors->get('site_address')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <!-- Application Settings -->
                            <div class="border-b border-gray-200 pb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">
                                    {{ __('Application Settings') }}
                                </h3>
                                
                                <div class="space-y-4">
                                    <!-- Maintenance Mode -->
                                    <div class="flex items-center">
                                        <input id="maintenance_mode" type="checkbox" name="maintenance_mode" 
                                               {{ old('maintenance_mode', $settings['maintenance_mode']) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                        <label for="maintenance_mode" class="ml-2 block text-sm font-medium text-gray-900">
                                            {{ __('Maintenance Mode') }}
                                        </label>
                                    </div>
                                    
                                    <!-- Allow Registration -->
                                    <div class="flex items-center">
                                        <input id="allow_registration" type="checkbox" name="allow_registration" 
                                               {{ old('allow_registration', $settings['allow_registration']) ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-indigo-600 shadow-sm">
                                        <label for="allow_registration" class="ml-2 block text-sm font-medium text-gray-900">
                                            {{ __('Allow User Registration') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit" 
                                    class="ms-3 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                                {{ __('Save Settings') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>