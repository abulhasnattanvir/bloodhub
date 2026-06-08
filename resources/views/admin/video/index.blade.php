@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-video text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Video Gallery</h2>
                        <p class="text-gray-600 mt-1">List all Videos</p>
                    </div>
                </div>

                <a href="{{ route('admin.videos.create') }}"
                    class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-2xl transition-all duration-200 shadow-lg shadow-red-500/30 hover:shadow-xl hover:-translate-y-0.5">
                    <i class="fas fa-plus"></i>
                    Add New Video
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                <div class="overflow-x-auto">
                    <table class="w-full divide-y divide-gray-200">
                        <thead class="bg-green-900">
                            <tr>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider w-24">
                                    Thumbnail</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Video Link</th>
                                <th
                                    class="px-6 py-5 text-center text-xs font-semibold text-gray-300 uppercase tracking-wider w-40">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($videos as $video)
                                <tr class="hover:bg-red-50/50 transition-colors group">
                                    <!-- Thumbnail -->
                                    <td class="px-6 py-4">
                                        @if (str_contains($video->url, 'youtube'))
                                            @php
                                                $videoId = str_contains($video->url, 'v=')
                                                    ? substr($video->url, strpos($video->url, 'v=') + 2, 11)
                                                    : (str_contains($video->url, 'youtu.be/')
                                                        ? substr($video->url, strpos($video->url, 'youtu.be/') + 9, 11)
                                                        : '');
                                            @endphp
                                            <img src="https://img.youtube.com/vi/{{ $videoId }}/hqdefault.jpg"
                                                class="w-20 h-16 object-cover rounded-2xl shadow-sm border border-gray-200"
                                                alt="Video Thumbnail">
                                        @else
                                            <div class="w-20 h-16 bg-gray-100 rounded-2xl flex items-center justify-center">
                                                <i class="fas fa-video text-3xl text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <!-- Title -->
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-900 line-clamp-2">{{ $video->title }}</div>
                                    </td>

                                    <!-- Category -->
                                    <td class="px-6 py-4">
                                        @if ($video->category)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                                {{ $video->category }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>

                                    <!-- Video URL -->
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 line-clamp-1 max-w-xs">
                                            {{ $video->url }}
                                        </div>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.videos.edit', $video) }}"
                                                class="inline-flex items-center justify-center w-9 h-9 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl transition-all">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Do you want to delete this video?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-9 h-9 bg-red-100 hover:bg-red-200 text-red-700 rounded-xl transition-all">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-video text-6xl text-gray-300 mb-4"></i>
                                            <p class="text-gray-500 text-lg">No video found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-5 border-t border-gray-100 bg-gray-50 flex justify-center">
                    {{ $videos->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
