@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="bg-white p-6 rounded-xl shadow space-y-4">

            <!-- Title -->
            <div>
                <label class="block mb-1 font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title', $menu->title) }}" class="w-full border rounded p-2"
                    required>
            </div>

            <!-- URL -->
            <div>
                <label class="block mb-1 font-medium">URL</label>
                <input type="text" name="url" value="{{ old('url', $menu->url) }}" class="w-full border rounded p-2">
            </div>

            <!-- Parent Menu -->
            <div>
                <label class="block mb-1 font-medium">Parent Menu</label>

                <select name="parent_id" class="w-full border rounded p-2">
                    <option value="">No Parent</option>

                    @foreach ($parents as $parent)
                        @if ($parent->id != $menu->id)
                            <option value="{{ $parent->id }}" @selected($menu->parent_id == $parent->id)>
                                {{ $parent->title }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block mb-1 font-medium">Sort Order</label>

                <input type="number" name="sort_order" value="{{ old('sort_order', $menu->sort_order) }}" min="0"
                    class="w-full border rounded p-2">
            </div>

            <!-- Target Blank -->
            <div>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="target_blank" value="1" {{ $menu->target_blank ? 'checked' : '' }}>

                    <span>Open In New Tab</span>
                </label>
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select name="status" class="w-full border rounded p-2">
                    <option value="1" {{ $menu->status ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ !$menu->status ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Update Menu
            </button>

        </div>

    </form>
@endsection
