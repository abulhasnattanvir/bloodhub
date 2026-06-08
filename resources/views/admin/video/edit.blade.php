@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-video text-2xl"></i>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900">Edit Video</h2>
                        <p class="text-gray-600 mt-1">Update video information</p>
                    </div>
                </div>

                <a href="{{ route('admin.videos.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 hover:border-gray-400 rounded-2xl text-gray-700 font-medium transition-all">
                    <i class="fas fa-arrow-left"></i>
                    Go Back
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.videos.update', $video) }}" method="POST" class="p-8 md:p-12 space-y-8">

                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Video Title <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $video->title) }}" required
                            class="w-full px-6 py-4 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-2xl focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all">
                        @error('title')
                            <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Video URL -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Video Link (YouTube / Direct) <span
                                class="text-red-500">*</span></label>
                        <input type="url" name="url" value="{{ old('url', $video->url) }}"
                            placeholder="https://youtu.be/xxxxxxxxx অথবা https://example.com/video.mp4" required
                            class="w-full px-6 py-4 border @error('url') border-red-500 @else border-gray-300 @enderror rounded-2xl focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all">
                        <small class="block mt-2 text-gray-500">YouTube will automatically show thumbnails when you provide
                            a link.</small>
                        @error('url')
                            <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <input type="text" name="category" value="{{ old('category', $video->category) }}"
                            placeholder="রক্তদান, বৃক্ষরোপণ, শিক্ষা, দুর্যোগ সাহায্য ইত্যাদি"
                            class="w-full px-6 py-4 border @error('category') border-red-500 @else border-gray-300 @enderror rounded-2xl focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all">
                        @error('category')
                            <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Details</label>
                        <textarea name="description" rows="5"
                            class="w-full px-6 py-4 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-3xl focus:outline-none focus:border-red-500 focus:ring-4 focus:ring-red-100 transition-all resize-y">{{ old('description', $video->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="pt-6 flex flex-col sm:flex-row gap-4">
                        <button type="submit"
                            class="flex-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold py-4 rounded-2xl text-lg transition-all duration-200 shadow-lg shadow-red-500/30 hover:shadow-xl">
                            Update Video
                        </button>

                        <a href="{{ route('admin.videos.index') }}"
                            class="flex-1 text-center py-4 border border-gray-300 hover:bg-gray-50 font-medium rounded-2xl text-gray-700 transition-all">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
