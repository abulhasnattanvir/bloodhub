@extends('layouts.admin')

@section('content')
    <div class="bg-white rounded-xl shadow p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-5">

            <h2 class="text-xl font-bold">Menu Manager</h2>
            <a href="{{ route('admin.menus.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition">
                + Add Menu
            </a>

        </div>


        <div class="bg-white p-6 mb-6 rounded-xl shadow">

            <div class="flex justify-between mb-4">
                <h2 class="text-xl font-bold">Menu Builder</h2>
            </div>

            <!-- MENU LIST -->
            <ul id="menu-list" class="space-y-2">

                @foreach ($menus as $menu)
                    <li class="menu-item bg-gray-50 p-3 rounded border flex justify-between items-center"
                        data-id="{{ $menu->id }}">

                        <div class="flex items-center gap-3">

                            <i class="fas fa-grip-vertical cursor-move text-gray-400"></i>

                            <span class="font-medium">{{ $menu->title }}</span>

                            @if ($menu->parent_id)
                                <span class="text-xs text-blue-500">(Child)</span>
                            @endif

                        </div>

                    </li>
                @endforeach

            </ul>

            <button id="saveOrder" class="mt-5 bg-red-600 text-white px-4 py-2 rounded">
                Save Order
            </button>

        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Wrapper (IMPORTANT for responsive) -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[800px] text-sm border">

                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-3">#</th>
                        <th class="p-3">Title</th>
                        <th class="p-3">URL</th>
                        <th class="p-3">Parent</th>
                        <th class="p-3">Order</th>
                        <th class="p-3">Target</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($menus as $menu)
                        <tr class="border-t hover:bg-gray-50">

                            <!-- Serial -->
                            <td class="p-3">
                                {{ $loop->iteration }}
                            </td>

                            <!-- Title -->
                            <td class="p-3 font-medium text-gray-800">
                                {{ $menu->title }}
                            </td>

                            <!-- URL -->
                            <td class="p-3 text-gray-600">
                                {{ $menu->url }}
                            </td>

                            <!-- Parent -->
                            <td class="p-3">
                                @if ($menu->parent)
                                    <span class="text-blue-600 font-medium">
                                        {{ $menu->parent->title }}
                                    </span>
                                @else
                                    <span class="text-gray-400">Main Menu</span>
                                @endif
                            </td>

                            <!-- Order -->
                            <td class="p-3">
                                {{ $menu->sort_order }}
                            </td>

                            <!-- Target -->
                            <td class="p-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-700">
                                    {{ $menu->target_blank ? '_blank' : '_self' }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="p-3">
                                @if ($menu->status)
                                    <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">
                                        Active
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-700 rounded-full">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- Action -->
                            <td class="p-3 text-right space-x-2">

                                <a href="{{ route('admin.menus.edit', $menu) }}"
                                    class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                    Edit
                                </a>

                                <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST"
                                    class="inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Delete Menu?')"
                                        class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-8 text-gray-500">
                                No menu found
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="mt-5">
            {{ $menus->links() }}
        </div>

    </div>
@endsection
