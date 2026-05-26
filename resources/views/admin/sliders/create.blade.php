@extends('layouts.admin')

@section('content')
    <div class="py-6 max-w-3xl mx-auto">

        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded-lg shadow space-y-5">

            @csrf

            <!-- TITLE -->
            <div>
                <label class="text-sm font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Title"
                    class="w-full border rounded p-2 mt-1">
            </div>

            <!-- ICON -->
            <div>
                <label class="text-sm font-medium">Icon Class (FontAwesome)</label>
                <input type="text" name="icon" value="{{ old('icon') }}" class="w-full border rounded p-2 mt-1"
                    placeholder="fas fa-heartbeat">
            </div>

            <!-- HIGHLIGHT -->
            <div>
                <label class="text-sm font-medium">Highlight Text</label>
                <input type="text" name="highlight_text" value="{{ old('highlight_text') }}"
                    class="w-full border rounded p-2 mt-1" placeholder="Emergency Support">
            </div>

            <!-- DESCRIPTION -->
            <div>
                <label class="text-sm font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2 mt-1" placeholder="Description">{{ old('description') }}</textarea>
            </div>

            <!-- BUTTON TEXT -->
            <div>
                <label class="text-sm font-medium">Button Text</label>
                <input type="text" name="button_text" value="{{ old('button_text') }}"
                    class="w-full border rounded p-2 mt-1" placeholder="Learn More">
            </div>

            <!-- BUTTON LINK -->
            <div>
                <label class="text-sm font-medium">Button Link</label>
                <input type="text" name="button_link" value="{{ old('button_link') }}"
                    class="w-full border rounded p-2 mt-1" placeholder="/search">
            </div>

            <!-- ORDER -->
            <div>
                <label class="text-sm font-medium">Order</label>
                <input type="number" name="order" value="{{ old('order', 0) }}" class="w-full border rounded p-2 mt-1">
            </div>

            <!-- IMAGE -->
            <div>
                <label class="text-sm font-medium">Image</label>
                <input type="file" name="image" class="w-full border rounded p-2 mt-1">
            </div>

            <!-- STATUS (NEW IMPORTANT) -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="status" value="1" checked>

                <label class="text-sm font-medium">Active Slider</label>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
                Save Slider
            </button>

        </form>

    </div>
@endsection
