@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <div class="bg-white rounded-3xl shadow p-8">
            <h1 class="text-2xl font-bold mb-6">নতুন কার্যক্রম যোগ করুন</h1>

            <form action="{{ route('admin.activities.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">আইকন ক্লাস <span class="text-red-500">*</span></label>
                    <input type="text" name="icon" value="{{ old('icon') }}"
                        class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:border-red-500 focus:outline-none"
                        placeholder="fa-book-open" required>
                    <small class="text-gray-500">Font Awesome আইকন (যেমন: fa-heart)</small>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">কার্যক্রমের বিবরণ <span
                            class="text-red-500">*</span></label>
                    <textarea name="text" rows="4"
                        class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:border-red-500 focus:outline-none" required>{{ old('text') }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-red-600 text-white px-8 py-4 rounded-2xl hover:bg-red-700 transition">
                        সংরক্ষণ করুন
                    </button>
                    <a href="{{ route('admin.activities.index') }}"
                        class="bg-gray-200 px-8 py-4 rounded-2xl hover:bg-gray-300 transition">
                        বাতিল
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
