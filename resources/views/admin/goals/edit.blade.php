@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <div class="bg-white rounded-3xl shadow p-8">

            <h1 class="text-2xl font-bold text-gray-900 mb-6">লক্ষ্য সম্পাদনা করুন</h1>

            <form action="{{ route('admin.goals.update', $goal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">আইকন ক্লাস <span class="text-red-500">*</span></label>
                    <input type="text" name="icon" value="{{ old('icon', $goal->icon) }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-red-500"
                        placeholder="fa-graduation-cap" required>
                    <small class="text-gray-500">Font Awesome আইকন ক্লাস (যেমন: fa-heart)</small>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-medium mb-2">লক্ষ্যের বিবরণ <span
                            class="text-red-500">*</span></label>
                    <textarea name="text" rows="4"
                        class="w-full px-5 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-red-500" required>{{ old('text', $goal->text) }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="bg-red-600 text-white px-8 py-3 rounded-2xl hover:bg-red-700 transition font-medium">
                        আপডেট করুন
                    </button>

                    <a href="{{ route('admin.goals.index') }}"
                        class="bg-gray-200 text-gray-700 px-8 py-3 rounded-2xl hover:bg-gray-300 transition font-medium">
                        বাতিল করুন
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
