@extends('layouts.admin')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Blog Tags</h1>
            <a href="{{ route('admin.blog.tags.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium flex items-center gap-2">
                <span>+ New Tag</span>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-2xl overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Tag Name</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Slug</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Posts Count</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tags as $tag)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-full text-sm font-medium">
                                    #{{ $tag->name }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-gray-500 font-mono text-sm">{{ $tag->slug }}</td>
                            <td class="px-6 py-5">
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                    {{ $tag->posts_count }} posts
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex gap-4">
                                    <a href="{{ route('admin.blog.tags.edit', $tag) }}"
                                        class="text-amber-600 hover:text-amber-700 font-medium">Edit</a>

                                    <form action="{{ route('admin.blog.tags.destroy', $tag) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this tag?')"
                                            class="text-red-600 hover:text-red-700 font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                No tags found. Create your first tag!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $tags->links() }}
        </div>
    </div>
@endsection
