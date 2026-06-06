@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold">Edit Gallery Image</h1>
            </div>

            <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Select - Only Bengali Options -->
                    <div>
                        <label class="block mb-2 font-medium">Category</label>
                        <select name="category" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Select Category --</option>
                            <option value="শিক্ষা ও বৃত্তি"
                                {{ old('category', $gallery->category) == 'শিক্ষা ও বৃত্তি' ? 'selected' : '' }}>শিক্ষা ও
                                বৃত্তি</option>
                            <option value="রক্তদান"
                                {{ old('category', $gallery->category) == 'রক্তদান' ? 'selected' : '' }}>রক্তদান</option>
                            <option value="দুর্যোগ সাহায্য"
                                {{ old('category', $gallery->category) == 'দুর্যোগ সাহায্য' ? 'selected' : '' }}>দুর্যোগ
                                সাহায্য</option>
                            <option value="শীতবস্ত্র বিতরণ"
                                {{ old('category', $gallery->category) == 'শীতবস্ত্র বিতরণ' ? 'selected' : '' }}>শীতবস্ত্র
                                বিতরণ</option>
                            <option value="ঈদ সামগ্রী"
                                {{ old('category', $gallery->category) == 'ঈদ সামগ্রী' ? 'selected' : '' }}>ঈদ সামগ্রী
                            </option>
                            <option value="বাল্যবিবাহ ও যৌতুক প্রতিরোধ"
                                {{ old('category', $gallery->category) == 'বাল্যবিবাহ ও যৌতুক প্রতিরোধ' ? 'selected' : '' }}>
                                বাল্যবিবাহ ও যৌতুক প্রতিরোধ</option>
                            <option value="মাদকবিরোধী"
                                {{ old('category', $gallery->category) == 'মাদকবিরোধী' ? 'selected' : '' }}>মাদকবিরোধী
                            </option>
                            <option value="প্রযুক্তি সচেতনতা"
                                {{ old('category', $gallery->category) == 'প্রযুক্তি সচেতনতা' ? 'selected' : '' }}>
                                প্রযুক্তি সচেতনতা</option>
                            <option value="মানবিক সেবা"
                                {{ old('category', $gallery->category) == 'মানবিক সেবা' ? 'selected' : '' }}>মানবিক সেবা
                            </option>
                            <option value="সচেতনতা কর্মসূচি"
                                {{ old('category', $gallery->category) == 'সচেতনতা কর্মসূচি' ? 'selected' : '' }}>সচেতনতা
                                কর্মসূচি</option>
                            <option value="সমাজসেবা"
                                {{ old('category', $gallery->category) == 'সমাজসেবা' ? 'selected' : '' }}>সমাজসেবা</option>
                            <option value="অন্যান্য"
                                {{ old('category', $gallery->category) == 'অন্যান্য' ? 'selected' : '' }}>অন্যান্য</option>
                        </select>
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Event Date</label>
                        <input type="date" name="event_date"
                            value="{{ old('event_date', $gallery->event_date?->format('Y-m-d')) }}"
                            class="w-full border rounded-xl px-4 py-3">
                    </div>

                    <!-- Improved Image Upload -->
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Image</label>

                        <!-- Current Image Preview -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-500 mb-2">Current Image:</p>
                            <img id="current-image" src="{{ asset('storage/' . $gallery->image) }}"
                                class="w-56 h-56 object-cover rounded-2xl border shadow-sm">
                        </div>

                        <!-- New Image Upload Area -->
                        <div
                            class="border-2 border-dashed border-gray-300 rounded-2xl p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" name="image" id="image-upload" accept="image/*" class="hidden">

                            <div id="upload-area" class="cursor-pointer">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                                <p class="font-medium text-gray-700">Click to upload new image</p>
                                <p class="text-sm text-gray-500">JPG, PNG, WEBP (Max 5MB)</p>
                            </div>

                            <!-- New Image Preview -->
                            <div id="new-image-preview" class="hidden mt-4">
                                <img id="preview-image" class="w-56 h-56 object-cover rounded-2xl border shadow-sm mx-auto">
                                <button type="button" id="remove-preview"
                                    class="mt-3 text-red-600 text-sm hover:underline">
                                    Remove
                                </button>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Description</label>
                        <textarea name="description" rows="5" class="w-full border rounded-xl px-4 py-3">{{ old('description', $gallery->description) }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">
                        Update Gallery
                    </button>
                    <a href="{{ route('admin.gallery.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-xl">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const imageUpload = document.getElementById('image-upload');
        const uploadArea = document.getElementById('upload-area');
        const previewContainer = document.getElementById('new-image-preview');
        const previewImage = document.getElementById('preview-image');
        const removeBtn = document.getElementById('remove-preview');

        // Click to upload
        uploadArea.addEventListener('click', () => imageUpload.click());

        // Preview selected image
        imageUpload.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    document.getElementById('current-image').style.opacity = '0.3';
                }
                reader.readAsDataURL(file);
            }
        });

        // Remove preview
        removeBtn.addEventListener('click', () => {
            imageUpload.value = '';
            previewContainer.classList.add('hidden');
            document.getElementById('current-image').style.opacity = '1';
        });
    </script>
@endpush
