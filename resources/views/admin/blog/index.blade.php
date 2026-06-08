@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">Blog Posts</h1>
            <a href="{{ route('admin.blog.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create New Post
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Image</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Tags</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Published</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                @if ($post->featured_image)
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                        class="w-16 h-16 object-cover rounded-lg">
                                @else
                                    <div
                                        class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900">{{ $post->title }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($post->excerpt, 80) }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $post->category?->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->tags->count())
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($post->tags->take(3) as $tag)
                                            <span
                                                class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-full">#{{ $tag->name }}</span>
                                        @endforeach
                                        @if ($post->tags->count() > 3)
                                            <span class="text-xs text-gray-400">+{{ $post->tags->count() - 3 }}</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">No tags</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->is_published)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Published
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $post->published_at ? $post->published_at->format('M j, Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex gap-3">
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-900">View</a>

                                    <a href="{{ route('admin.blog.edit', $post) }}"
                                        class="text-amber-600 hover:text-amber-900">Edit</a>

                                    <form action="{{ route('admin.blog.destroy', $post) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                No blog posts yet. Create your first post!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
