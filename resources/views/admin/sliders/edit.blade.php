@extends('layouts.admin')

@section('content')
    <div class="py-6 max-w-3xl mx-auto">

        <form action="{{ route('admin.sliders.update', $slider->id) }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow space-y-5">

            @csrf
            @method('PUT')

            <!-- TITLE -->
            <div>
                <label class="text-sm font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title', $slider->title) }}"
                    class="w-full border rounded p-2 mt-1">
            </div>

            <!-- ICON -->
            <div>
                <label class="text-sm font-medium">Icon Class (FontAwesome)</label>
                <input type="text" name="icon" value="{{ old('icon', $slider->icon) }}"
                    class="w-full border rounded p-2 mt-1" placeholder="fas fa-heartbeat">
            </div>

            <!-- HIGHLIGHT TEXT -->
            <div>
                <label class="text-sm font-medium">Highlight Text</label>
                <input type="text" name="highlight_text" value="{{ old('highlight_text', $slider->highlight_text) }}"
                    class="w-full border rounded p-2 mt-1">
            </div>

            <!-- DESCRIPTION -->
            <div>
                <label class="text-sm font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2 mt-1">{{ old('description', $slider->description) }}</textarea>
            </div>

            <!-- BUTTON TEXT -->
            <div>
                <label class="text-sm font-medium">Button Text</label>
                <input type="text" name="button_text" value="{{ old('button_text', $slider->button_text) }}"
                    class="w-full border rounded p-2 mt-1">
            </div>

            <!-- BUTTON LINK -->
            <div>
                <label class="text-sm font-medium">Button Link</label>
                <input type="text" name="button_link" value="{{ old('button_link', $slider->button_link) }}"
                    class="w-full border rounded p-2 mt-1">
            </div>

            <!-- ORDER -->
            <div>
                <label class="text-sm font-medium">Order</label>
                <input type="number" name="order" value="{{ old('order', $slider->order) }}"
                    class="w-full border rounded p-2 mt-1">
            </div>

            <!-- STATUS -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" {{ $slider->status ? 'checked' : '' }}>

                <label class="text-sm font-medium">Active Slider</label>
            </div>

            <!-- CURRENT IMAGE -->
            <div>
                <label class="text-sm font-medium">Current Image</label>

                <img src="{{ asset('storage/' . $slider->image) }}" class="w-32 h-20 object-cover rounded mt-2">
            </div>

            <!-- IMAGE UPLOAD -->
            <div>
                <label class="text-sm font-medium">Change Image</label>
                <input type="file" name="image" class="w-full border rounded p-2 mt-1">
            </div>

            <!-- BUTTON -->
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                Update Slider
            </button>

        </form>

    </div>
@endsection
