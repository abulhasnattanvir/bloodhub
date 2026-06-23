@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-lg p-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl font-bold text-gray-800">
                    Create New Notice Ticker
                </h2>
                <a href="{{ route('admin.notice-ticker.index') }}"
                    class="text-gray-500 hover:text-gray-700 flex items-center gap-2">
                    <span>←</span> Back to List
                </a>
            </div>

            <form action="{{ route('admin.notice-ticker.store') }}" method="POST">

                @csrf

                <!-- Title -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        placeholder="Enter notice title" required>
                </div>

                <!-- URL -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Link (URL)
                    </label>
                    <input type="url" name="url" value="{{ old('url') }}"
                        class="w-full border border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        placeholder="https://example.com">
                </div>

                <!-- Status -->
                <div class="mb-8">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 accent-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-700 font-medium">Active (Visible on website)</span>
                    </label>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-4 px-6 rounded-xl transition duration-200">
                        Save Notice Ticker
                    </button>

                    <a href="{{ route('admin.notice-ticker.index') }}"
                        class="flex-1 border border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-4 px-6 rounded-xl text-center transition">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
