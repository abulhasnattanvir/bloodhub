@extends('layouts.admin')

@section('content')
    <div class="max-w-8xl mx-auto pb-5">
        <div class="bg-white rounded-3xl shadow p-6 md:p-8">

            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold">Menu Builder</h2>

                <a href="{{ route('admin.menus.create') }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-2xl flex items-center gap-2">
                    <i class="fas fa-plus"></i> Add New Menu
                </a>
            </div>

            <ul id="menu-list" class="space-y-3 min-h-[400px]">

                @foreach ($menus as $menu)
                    <li class="menu-item bg-gray-50 p-5 rounded-2xl border flex justify-between items-center cursor-move"
                        data-id="{{ $menu->id }}">

                        <div class="flex items-center gap-4">

                            <!-- Drag Handle -->
                            <div class="drag-handle cursor-move">
                                <i class="fas fa-grip-vertical text-gray-400 text-2xl"></i>
                            </div>

                            <span class="font-medium">{{ $menu->title }}</span>

                            @if ($menu->parent_id)
                                <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">
                                    Child
                                </span>
                            @endif
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                class="px-5 py-2 text-blue-600 hover:bg-blue-50 rounded-xl">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST"
                                onsubmit="return confirm('Delete this menu?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-5 py-2 text-red-600 hover:bg-red-50 rounded-xl">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach

            </ul>

            <button id="saveOrder"
                class="mt-8 bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-2xl font-medium flex items-center gap-2">
                <i class="fas fa-save"></i> Save New Order
            </button>

        </div>
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

                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline-block">

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
@endsection

@push('scripts')
    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const menuList = document.getElementById('menu-list');

            if (!menuList || typeof Sortable === 'undefined') {
                console.error('SortableJS not loaded or menu list not found');
                return;
            }

            // Init drag & drop
            new Sortable(menuList, {
                animation: 150,
                handle: '.drag-handle',
                ghostClass: 'bg-gray-200'
            });

            // Save order
            document.getElementById('saveOrder').addEventListener('click', function() {

                let menus = [];

                document.querySelectorAll('#menu-list .menu-item').forEach((item, index) => {
                    menus.push({
                        id: item.dataset.id,
                        sort_order: index + 1
                    });
                });

                fetch("{{ route('admin.menus.sort') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            menus
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            alert('Menu order saved successfully');
                        } else {
                            alert(data.message || 'Failed to save');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Something went wrong');
                    });

            });

        });
    </script>
@endpush
