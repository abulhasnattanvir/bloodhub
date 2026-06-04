@extends('layouts.admin')

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-semibold text-gray-800">Edit Slider</h1>
                <p class="text-gray-500 mt-1">Update slider information</p>
            </div>

            <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data"
                class="bg-white rounded-2xl shadow-lg p-6 sm:p-8 space-y-8">

                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Title <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $slider->title) }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Icon -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Icon Class (FontAwesome)</label>
                    <div class="flex gap-3">
                        <input type="text" name="icon" value="{{ old('icon', $slider->icon) }}"
                            placeholder="fas fa-heartbeat"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <a href="https://fontawesome.com/icons" target="_blank"
                            class="px-5 py-3 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium flex items-center whitespace-nowrap">
                            Browse
                        </a>
                    </div>
                    @error('icon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Highlight Text -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Highlight Text</label>
                    <input type="text" name="highlight_text" value="{{ old('highlight_text', $slider->highlight_text) }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    @error('highlight_text')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-y">{{ old('description', $slider->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text) }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                        <input type="text" name="button_link" value="{{ old('button_link', $slider->button_link) }}"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>
                </div>

                <!-- Order & Status -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                        <input type="number" name="order" value="{{ old('order', $slider->order) }}" min="0"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <div class="flex items-center gap-3 pt-6">
                        <input type="checkbox" name="status" value="1" id="status"
                            {{ $slider->status ? 'checked' : '' }}
                            class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="status" class="text-sm font-medium text-gray-700 cursor-pointer">
                            Active (Visible on website)
                        </label>
                    </div>
                </div>

                <!-- Current Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                    <div class="mt-2 border border-gray-200 rounded-2xl p-3 inline-block bg-gray-50">
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="Current Slider Image"
                            class="w-48 h-28 object-cover rounded-xl shadow-sm">
                    </div>
                </div>

                <!-- Change Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Change Image (Optional)</label>
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-2xl hover:border-blue-400 transition">
                        <div class="space-y-2 text-center">
                            <div class="mx-auto h-12 w-12 text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M4 16v-4m0 0l4 4m-4-4l4-4m12 0v4m0 0l-4-4m4 4l-4 4" />
                                </svg>
                            </div>
                            <div class="text-sm text-gray-600">
                                <label for="image"
                                    class="relative cursor-pointer font-medium text-blue-600 hover:text-blue-700">
                                    <span>Upload New Image</span>
                                    <input id="image" name="image" type="file" class="sr-only">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, WEBP • Max 5MB</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <!-- New Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                        <img class="w-full max-h-64 object-cover rounded-2xl shadow" alt="New Preview">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6">
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-2xl transition-all duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                        <span>Update Slider</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Image Preview for new upload
        document.getElementById('image').addEventListener('change', function(e) {
            const previewContainer = document.getElementById('imagePreview');
            const previewImg = previewContainer.querySelector('img');

            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endsection
