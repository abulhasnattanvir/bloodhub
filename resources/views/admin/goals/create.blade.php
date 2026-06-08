@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <div class="bg-white rounded-3xl shadow p-8">

            <h1 class="text-2xl font-bold text-gray-900 mb-6">Add New Goal</h1>

            <form action="{{ route('admin.goals.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-2">Icon Class <span class="text-red-500">*</span></label>
                    <input type="text" name="icon" value="{{ old('icon') }}"
                        class="w-full px-5 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-red-500"
                        placeholder="fa-graduation-cap" required>
                    <small class="text-gray-500">Font Awesome আইকন ক্লাস দিন (যেমন: fa-heart)</small>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-medium mb-2">Goal Details <span
                            class="text-red-500">*</span></label>
                    <textarea name="text" rows="4"
                        class="w-full px-5 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:border-red-500"
                        placeholder="মেধাবী ও দরিদ্র শিক্ষার্থীদের সহায়তা" required>{{ old('text') }}</textarea>
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="bg-red-600 text-white px-8 py-3 rounded-2xl hover:bg-red-700 transition font-medium">
                        Save
                    </button>

                    <a href="{{ route('admin.goals.index') }}"
                        class="bg-gray-200 text-gray-700 px-8 py-3 rounded-2xl hover:bg-gray-300 transition font-medium">
                        Remove
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
