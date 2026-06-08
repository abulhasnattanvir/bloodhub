@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between mb-8">
            <h1 class="text-3xl font-bold">Categories</h1>
            <a href="{{ route('admin.blog.categories.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-xl">+ New
                Category</a>
        </div>

        <table class="w-full bg-white shadow-md rounded-xl">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Posts</th>
                    <th class="px-6 py-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-t">
                        <td class="px-6 py-4 font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4">{{ $category->posts_count }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.blog.categories.edit', $category) }}"
                                class="text-amber-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.blog.categories.destroy', $category) }}" method="POST"
                                class="inline ml-4" onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
