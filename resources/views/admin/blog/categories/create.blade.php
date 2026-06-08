@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">{{ isset($category) ? 'Edit' : 'Create' }} Category</h1>

        <form method="POST"
            action="{{ isset($category) ? route('admin.blog.categories.update', $category) : route('admin.blog.categories.store') }}">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif

            <div class="space-y-6">
                <div>
                    <label class="block font-medium mb-2">Category Name</label>
                    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}"
                        class="w-full border rounded-xl p-4" required>
                </div>

                <div>
                    <label class="block font-medium mb-2">Description (Optional)</label>
                    <textarea name="description" rows="4" class="w-full border rounded-xl p-4">{{ old('description', $category->description ?? '') }}</textarea>
                </div>

                <button type="submit" class="bg-green-600 text-white px-8 py-4 rounded-xl font-semibold">
                    {{ isset($category) ? 'Update Category' : 'Create Category' }}
                </button>
            </div>
        </form>
    </div>
@endsection
