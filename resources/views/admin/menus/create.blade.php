@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.menus.store') }}" method="POST">
        @csrf

        <div class="bg-white p-6 rounded-xl shadow space-y-4">

            <!-- Title -->
            <div>
                <label class="block mb-1 font-medium">Menu Title</label>
                <input type="text" name="title" placeholder="Menu Title" class="w-full border rounded p-2" required>
            </div>

            <!-- URL -->
            <div>
                <label class="block mb-1 font-medium">URL</label>
                <input type="text" name="url" placeholder="/about" class="w-full border rounded p-2">
            </div>

            <!-- Parent -->
            <div>
                <label class="block mb-1 font-medium">Parent Menu</label>

                <select name="parent_id" class="w-full border rounded p-2">
                    <option value="">No Parent</option>

                    @foreach ($parents as $parent)
                        <option value="{{ $parent->id }}">
                            {{ $parent->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="block mb-1 font-medium">Sort Order</label>

                <input type="number" name="sort_order" value="0" min="0" class="w-full border rounded p-2">
            </div>

            <!-- Open in New Tab -->
            <div>
                <label class="flex items-center gap-2">

                    <input type="checkbox" name="target_blank" value="1">

                    <span>Open In New Tab (_blank)</span>

                </label>
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1 font-medium">Status</label>

                <select name="status" class="w-full border rounded p-2">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Save Menu
            </button>

        </div>
    </form>
@endsection
