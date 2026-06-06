@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm p-8">
            <div class="mb-6">
                <h1 class="text-3xl font-bold">Add Gallery Image</h1>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Select -->
                    <div>
                        <label class="block mb-2 font-medium">ক্যাটেগরি</label>
                        <select name="category" class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- ক্যাটেগরি নির্বাচন করুন --</option>
                            <option value="শিক্ষা ও বৃত্তি" {{ old('category') == 'শিক্ষা ও বৃত্তি' ? 'selected' : '' }}>
                                শিক্ষা ও বৃত্তি</option>
                            <option value="রক্তদান" {{ old('category') == 'রক্তদান' ? 'selected' : '' }}>রক্তদান</option>
                            <option value="দুর্যোগ সাহায্য" {{ old('category') == 'দুর্যোগ সাহায্য' ? 'selected' : '' }}>
                                দুর্যোগ সাহায্য</option>
                            <option value="শীতবস্ত্র বিতরণ" {{ old('category') == 'শীতবস্ত্র বিতরণ' ? 'selected' : '' }}>
                                শীতবস্ত্র বিতরণ</option>
                            <option value="ঈদ সামগ্রী" {{ old('category') == 'ঈদ সামগ্রী' ? 'selected' : '' }}>ঈদ সামগ্রী
                            </option>
                            <option value="বাল্যবিবাহ" {{ old('category') == 'বাল্যবিবাহ' ? 'selected' : '' }}>বাল্যবিবাহ
                            </option>
                            <option value="যৌতুক প্রতিরোধ" {{ old('category') == 'যৌতুক প্রতিরোধ' ? 'selected' : '' }}>যৌতুক
                                প্রতিরোধ</option>
                            <option value="মাদকবিরোধী" {{ old('category') == 'মাদকবিরোধী' ? 'selected' : '' }}>মাদকবিরোধী
                            </option>
                            <option value="প্রযুক্তি সচেতনতা"
                                {{ old('category') == 'প্রযুক্তি সচেতনতা' ? 'selected' : '' }}>প্রযুক্তি সচেতনতা</option>
                            <option value="মানবিক সেবা" {{ old('category') == 'মানবিক সেবা' ? 'selected' : '' }}>মানবিক
                                সেবা</option>
                            <option value="সচেতনতা কর্মসূচি" {{ old('category') == 'সচেতনতা কর্মসূচি' ? 'selected' : '' }}>
                                সচেতনতা কর্মসূচি</option>
                            <option value="সমাজসেবা" {{ old('category') == 'সমাজসেবা' ? 'selected' : '' }}>সমাজসেবা
                            </option>
                            <option value="অন্যান্য" {{ old('category') == 'অন্যান্য' ? 'selected' : '' }}>অন্যান্য
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 font-medium">Event Date</label>
                        <input type="date" name="event_date" value="{{ old('event_date') }}"
                            class="w-full border rounded-xl px-4 py-3">
                    </div>

                    <!-- Improved Image Upload -->
                    <div class="md:col-span-2">
                        <label class="block mb-3 font-medium">Image *</label>

                        <div id="upload-area"
                            class="border-2 border-dashed border-gray-300 rounded-2xl p-8 text-center hover:border-blue-400 transition-all cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-5xl text-gray-400 mb-4"></i>
                            <p class="font-medium text-gray-700 text-lg">Click or drag image here</p>
                            <p class="text-sm text-gray-500 mt-1">JPG, PNG, WEBP (Max 5MB)</p>
                        </div>

                        <!-- Image Preview -->
                        <div id="preview-container" class="hidden mt-6">
                            <p class="text-sm text-gray-500 mb-2">Selected Image Preview:</p>
                            <img id="preview-image" class="w-64 h-64 object-cover rounded-2xl border shadow-md mx-auto">
                            <button type="button" id="remove-image"
                                class="mt-3 text-red-600 hover:text-red-700 text-sm flex items-center gap-1 mx-auto">
                                <i class="fas fa-times"></i> Remove Image
                            </button>
                        </div>

                        <input type="file" name="image" id="image-input" accept="image/*" class="hidden">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block mb-2 font-medium">Description</label>
                        <textarea name="description" rows="5" class="w-full border rounded-xl px-4 py-3">{{ old('description') }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl">
                        Save Gallery
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
        const uploadArea = document.getElementById('upload-area');
        const imageInput = document.getElementById('image-input');
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        const removeBtn = document.getElementById('remove-image');

        // Click to upload
        uploadArea.addEventListener('click', () => {
            imageInput.click();
        });

        // File selected
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    previewImage.src = ev.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Remove selected image
        removeBtn.addEventListener('click', () => {
            imageInput.value = '';
            previewContainer.classList.add('hidden');
        });

        // Optional: Drag & Drop Support
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#3b82f6';
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#d1d5db';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#d1d5db';
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                imageInput.files = e.dataTransfer.files;
                const reader = new FileReader();
                reader.onload = function(ev) {
                    previewImage.src = ev.target.result;
                    previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
