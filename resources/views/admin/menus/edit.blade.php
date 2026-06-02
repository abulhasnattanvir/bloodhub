@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="bg-white p-6 rounded-xl shadow space-y-4">

            <input type="text" name="title" value="{{ $menu->title }}" class="w-full border rounded p-2">

            <input type="text" name="url" value="{{ $menu->url }}" class="w-full border rounded p-2">

            <select name="parent_id" class="w-full border rounded p-2">

                <option value="">Parent Menu</option>

                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}" @selected($menu->parent_id == $parent->id)>
                        {{ $parent->title }}
                    </option>
                @endforeach

            </select>

            <button class="bg-red-600 text-white px-4 py-2 rounded">

                Update Menu

            </button>

        </div>

    </form>
@endsection
