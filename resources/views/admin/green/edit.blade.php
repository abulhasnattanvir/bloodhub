@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">সবুজ উদ্যোগ সম্পাদনা</h2>
                    <p class="text-gray-600 mt-1">তথ্য আপডেট করুন</p>
                </div>

                <a href="{{ route('admin.green.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-white border border-gray-300 hover:border-gray-400 rounded-2xl text-gray-700 font-medium transition-all">
                    <i class="fas fa-arrow-left"></i>
                    ফিরে যান
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.green.update', $greenInitiative) }}" method="POST"
                    enctype="multipart/form-data" class="p-8 md:p-12 space-y-8">

                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">টাইটেল <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $greenInitiative->title ?? '') }}"
                            required
                            class="w-full px-6 py-4 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-2xl focus:outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100">
                        @error('title')
                            <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">বিবরণ <span
                                class="text-red-500">*</span></label>
                        <textarea name="description" rows="6" required
                            class="w-full px-6 py-4 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-3xl focus:outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100 resize-y">
                        {{ old('description', $greenInitiative->description ?? '') }}
                    </textarea>
                        @error('description')
                            <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">ছবি</label>

                        @if ($greenInitiative->image)
                            <div class="mb-6">
                                <p class="text-sm font-medium text-gray-600 mb-3">বর্তমান ছবি:</p>
                                <img src="{{ asset('storage/' . $greenInitiative->image) }}"
                                    class="w-56 h-56 object-cover rounded-2xl shadow border border-gray-200"
                                    onerror="this.style.display='none'">
                            </div>
                        @endif

                        <label
                            class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-gray-300 hover:border-green-400 rounded-3xl cursor-pointer bg-gray-50 transition-colors">
                            <div id="image-preview" class="hidden w-full h-full rounded-3xl overflow-hidden">
                                <img id="preview-img" class="w-full h-full object-cover">
                            </div>
                            <div id="upload-placeholder" class="flex flex-col items-center justify-center py-8 text-center">
                                <i class="fas fa-cloud-upload-alt text-6xl text-gray-400 mb-4"></i>
                                <p class="text-gray-700 font-medium">নতুন ছবি আপলোড করুন (ঐচ্ছিক)</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG (max 2MB)</p>
                            </div>
                            <input type="file" name="image" id="image-input" accept="image/*" class="hidden"
                                onchange="previewImage(this)">
                        </label>

                        @error('image')
                            <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date & Location -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">তারিখ</label>
                            <input type="date" name="date"
                                value="{{ old('date', $greenInitiative->date?->format('Y-m-d') ?? '') }}"
                                class="w-full px-6 py-4 border @error('date') border-red-500 @else border-gray-300 @enderror rounded-2xl focus:outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100">
                            @error('date')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">স্থান</label>
                            <input type="text" name="location"
                                value="{{ old('location', $greenInitiative->location ?? '') }}"
                                class="w-full px-6 py-4 border @error('location') border-red-500 @else border-gray-300 @enderror rounded-2xl focus:outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100">
                            @error('location')
                                <p class="mt-2 text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-4 rounded-2xl text-lg transition-all">
                            আপডেট করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('image-preview');
            const placeholder = document.getElementById('upload-placeholder');
            const img = document.getElementById('preview-img');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
