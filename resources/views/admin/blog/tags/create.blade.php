@extends('layouts.admin')
@section('content')
    <div class="max-w-2xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold mb-8">Create New Tag</h1>

        <form method="POST" action="{{ route('admin.blog.tags.store') }}">
            @csrf

            <div class="bg-white shadow-md rounded-2xl p-8">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tag Name</label>
                        <input type="text" name="name"
                            class="w-full border border-gray-300 rounded-xl px-5 py-4 focus:outline-none focus:border-blue-500"
                            placeholder="e.g. Laravel, PHP, Tutorial" required>
                    </div>

                    <div class="flex gap-4">
                        <a href="{{ route('admin.blog.tags.index') }}"
                            class="px-8 py-4 border border-gray-300 rounded-xl font-medium hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-8 py-4 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700">
                            Create Tag
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
