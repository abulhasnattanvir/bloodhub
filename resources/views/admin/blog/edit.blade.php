@extends('layouts.admin')

@section('content')
    <div class="max-w-10xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Edit Blog Post</h1>
            <a href="{{ route('admin.blog.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 rounded-2xl text-sm font-medium transition">
                <i class="fas fa-arrow-left"></i> Back to Posts
            </a>
        </div>

        <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Main Content -->
                <div class="lg:col-span-8 space-y-8">

                    <!-- Title -->
                    <div class="bg-white rounded-3xl shadow-sm border p-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Post Title</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}"
                            class="w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-2xl px-5 py-4 text-lg"
                            placeholder="Enter blog title..." required>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="bg-white rounded-3xl shadow-sm border p-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
                        <textarea name="content" id="summernote" rows="18" required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Sidebar Options -->
                <div class="lg:col-span-4 space-y-8">

                    <!-- Category -->
                    <div class="bg-white rounded-3xl shadow-sm border p-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Category</label>
                        <select name="blog_category_id"
                            class="w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-2xl px-5 py-4">
                            <option value="">Select Category</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('blog_category_id', $post->blog_category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('blog_category_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div class="bg-white rounded-3xl shadow-sm border p-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Tags <span
                                class="text-gray-400 text-xs">(comma separated)</span></label>
                        <input type="text" name="tags"
                            value="{{ old('tags', $post->tags->pluck('name')->join(', ')) }}"
                            placeholder="laravel, php, web development"
                            class="w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-2xl px-5 py-4">
                        @error('tags')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excerpt -->
                    <div class="bg-white rounded-3xl shadow-sm border p-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Excerpt</label>
                        <textarea name="excerpt" rows="4"
                            class="w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-2xl px-5 py-4">{{ old('excerpt', $post->excerpt) }}</textarea>
                        @error('excerpt')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-white rounded-3xl shadow-sm border p-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Featured Image</label>

                        @if ($post->featured_image)
                            <div class="mb-4">
                                <img src="{{ Storage::url($post->featured_image) }}" alt="Current Image"
                                    class="w-full rounded-2xl border shadow-sm">
                                <p class="text-xs text-gray-500 mt-2">Current Image</p>
                            </div>
                        @endif

                        <input type="file" name="featured_image" accept="image/*" id="featured_image"
                            class="w-full text-sm file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
                        <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image</p>

                        @error('featured_image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

                        <!-- New Image Preview -->
                        <div id="image-preview" class="mt-4 hidden">
                            <p class="text-xs text-gray-500 mb-1">New Image Preview:</p>
                            <img id="preview-img" class="w-full rounded-2xl border" alt="Preview">
                        </div>
                    </div>

                    <!-- Publish Status -->
                    <div class="bg-white rounded-3xl shadow-sm border p-8 space-y-4">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                                class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500">
                            <label for="is_published" class="font-medium text-gray-700 cursor-pointer">
                                Published
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Published At</label>
                            <input type="datetime-local" name="published_at"
                                value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}"
                                class="w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-2xl px-5 py-4">
                        </div>

                        @error('is_published')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                        @error('published_at')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-5 rounded-3xl text-lg transition shadow-lg shadow-red-200 flex items-center justify-center gap-3">
                        <i class="fas fa-save"></i>
                        Update Blog Post
                    </button>

                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Summernote Editor
            $('#summernote').summernote({
                height: 500,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Image Preview for New Upload
            $('#featured_image').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview-img').attr('src', e.target.result);
                        $('#image-preview').removeClass('hidden');
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
