@extends('layouts.admin')

@section('content')
    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-11 h-11 bg-red-100 text-red-600 rounded-3xl flex items-center justify-center shadow-sm">
                    <i class="fas fa-tint text-3xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add New Blood Group</h1>
                    <p class="text-gray-500 mt-0.5">Create a new blood group entry</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.blood-groups.store') }}" class="space-y-8">
                        @csrf

                        <div class="space-y-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Blood Group Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base transition"
                                    placeholder="e.g. A+, B-, AB+, O+" required>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="5"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-blue-500 focus:ring-blue-500 py-4 px-5 text-base transition"
                                    placeholder="Enter detailed description about this blood group...">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-between pt-8 border-t border-gray-100">
                            <a href="{{ route('admin.blood-groups.index') }}"
                                class="inline-flex items-center px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-2xl transition font-medium">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Cancel
                            </a>

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl shadow-sm transition">
                                <i class="fas fa-save"></i>
                                Save Blood Group
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Text -->
            <p class="text-center text-xs text-gray-400 mt-6">
                Fields marked with <span class="text-red-500">*</span> are required
            </p>
        </div>
    </div>
@endsection
