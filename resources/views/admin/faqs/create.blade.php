@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">

        <div class="bg-white rounded-3xl shadow p-8">

            <h1 class="text-2xl font-bold mb-8">
                Add New FAQ
            </h1>

            <form action="{{ route('admin.faqs.store') }}" method="POST">

                @csrf

                <div class="mb-6">
                    <label class="block font-medium mb-2">
                        Question
                    </label>

                    <input type="text" name="question" value="{{ old('question') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:border-red-500" required>
                </div>

                <div class="mb-6">
                    <label class="block font-medium mb-2">
                        Answer
                    </label>

                    <textarea name="answer" rows="6"
                        class="w-full border rounded-xl px-4 py-3 focus:outline-none focus:border-red-500" required>{{ old('answer') }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block font-medium mb-2">
                        Position
                    </label>

                    <input type="number" name="position" value="0" class="w-full border rounded-xl px-4 py-3">
                </div>

                <div class="mb-8">
                    <label class="flex items-center gap-3">

                        <input type="checkbox" name="status" value="1" checked>

                        <span>Active</span>

                    </label>
                </div>

                <div class="flex gap-4">

                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl">
                        Save FAQ
                    </button>

                    <a href="{{ route('admin.faqs.index') }}" class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>
@endsection
