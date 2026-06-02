@extends('layouts.admin')

@section('content')
    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex justify-between mb-5">
            <h2 class="text-xl font-bold">Menu Manager</h2>

            <a href="{{ route('admin.menus.create') }}" class="bg-red-600 text-white px-4 py-2 rounded">
                Add Menu
            </a>
        </div>

        <table class="w-full">

            <thead>
                <tr>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Parent</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($menus as $menu)
                    <tr class="border-t">

                        <td>{{ $menu->title }}</td>

                        <td>{{ $menu->url }}</td>

                        <td>{{ $menu->parent?->title }}</td>

                        <td>{{ $menu->sort_order }}</td>

                        <td>
                            {{ $menu->status ? 'Active' : 'Inactive' }}
                        </td>

                        <td>

                            <a href="{{ route('admin.menus.edit', $menu) }}" class="text-blue-600">
                                Edit
                            </a>

                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Delete Menu?')" class="text-red-600 ml-3">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection
