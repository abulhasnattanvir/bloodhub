@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gray-800 px-8 py-5 border-b">
                <h2 class="text-2xl font-semibold text-white">Edit Notice</h2>
            </div>

            <div class="p-8">
                <form action="{{ route('admin.notices.update', $notice->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title', $notice->title) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required>
                    </div>

                    <!-- Notice Date -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Notice Date <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="notice_date"
                            value="{{ old('notice_date', $notice->notice_date->format('Y-m-d')) }}"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                            required>
                    </div>

                    <!-- Current PDF -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Current PDF
                        </label>
                        <a href="{{ route('admin.notices.download', $notice->id) }}" target="_blank"
                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 hover:underline">
                            <i class="fas fa-file-pdf"></i>
                            {{ $notice->pdf_file }}
                        </a>
                    </div>

                    <!-- New PDF -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Upload New PDF (Optional)
                        </label>
                        <input type="file" name="pdf_file" accept=".pdf"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition file:mr-4 file:py-2 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="mt-2 text-sm text-gray-500">Leave empty to keep the current PDF file.</p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea name="description" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">{{ old('description', $notice->description) }}</textarea>
                    </div>

                    <!-- Active Status -->
                    <div class="mb-8">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" name="is_active"
                                class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                                {{ old('is_active', $notice->is_active) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Keep this notice active</span>
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3.5 px-8 rounded-xl transition flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i>
                            Update Notice
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
