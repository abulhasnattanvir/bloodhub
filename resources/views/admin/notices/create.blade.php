@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gray-800 px-8 py-5 border-b">
                <h2 class="text-2xl font-semibold text-white">Add New Notice</h2>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.notices.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Notice Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Notice Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="notice_date" value="{{ old('notice_date', now()->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required>
                        @error('notice_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PDF File -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            PDF File <span class="text-red-500">*</span>
                        </label>
                        <input type="file" name="pdf_file" accept=".pdf"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition file:mr-4 file:py-2 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                            required>
                        @error('pdf_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">Maximum file size: 10 MB</p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description (Optional)
                        </label>
                        <textarea name="description" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('description') }}</textarea>
                    </div>

                    <!-- Active Status -->
                    <div class="mb-8">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active"
                                class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500" checked>
                            <span class="text-sm font-medium text-gray-700">Keep this notice active</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-medium py-3.5 px-8 rounded-xl transition flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i>
                            Save Notice
                        </button>

                        <a href="{{ route('admin.notices.index') }}"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-3.5 px-8 rounded-xl transition text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
