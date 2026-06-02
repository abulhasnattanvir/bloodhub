@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.menus.store') }}" method="POST">

        @csrf

        <div class="bg-white p-6 rounded-xl shadow space-y-4">

            <input type="text" name="title" placeholder="Menu Title" class="w-full border rounded p-2">

            <input type="text" name="url" placeholder="/about" class="w-full border rounded p-2">

            <select name="parent_id" class="w-full border rounded p-2">

                <option value="">Parent Menu</option>

                @foreach ($parents as $parent)
                    <option value="{{ $parent->id }}">
                        {{ $parent->title }}
                    </option>
                @endforeach

            </select>

            <input type="number" name="sort_order" value="0" class="w-full border rounded p-2">

            <button class="bg-red-600 text-white px-4 py-2 rounded">

                Save Menu

            </button>

        </div>

    </form>
@endsection
