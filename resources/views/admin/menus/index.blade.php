@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto">
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
                        draggable="true" data-id="{{ $menu->id }}">

                        <div class="flex items-center gap-4">
                            <i class="fas fa-grip-vertical text-gray-400 text-2xl"></i>
                            <span class="font-medium">{{ $menu->title }}</span>
                            @if ($menu->parent_id)
                                <span class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-full">Child</span>
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
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const menuList = document.getElementById('menu-list');
            let draggedItem = null;

            // Drag & Drop Logic
            menuList.addEventListener('dragstart', function(e) {
                if (e.target.classList.contains('menu-item')) {
                    draggedItem = e.target;
                    setTimeout(() => {
                        e.target.style.opacity = '0.4';
                    }, 0);
                }
            });

            menuList.addEventListener('dragend', function(e) {
                if (draggedItem) draggedItem.style.opacity = '1';
                draggedItem = null;
            });

            menuList.addEventListener('dragover', function(e) {
                e.preventDefault();
                const afterElement = getDragAfterElement(menuList, e.clientY);
                if (afterElement == null) {
                    menuList.appendChild(draggedItem);
                } else {
                    menuList.insertBefore(draggedItem, afterElement);
                }
            });

            function getDragAfterElement(container, y) {
                const draggableElements = [...container.querySelectorAll('.menu-item:not(.dragging)')];

                return draggableElements.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return {
                            offset: offset,
                            element: child
                        };
                    } else {
                        return closest;
                    }
                }, {
                    offset: Number.NEGATIVE_INFINITY
                }).element;
            }

            // Save Order
            document.getElementById('saveOrder').addEventListener('click', function() {

                let items = [];

                document.querySelectorAll('#menu-list .menu-item').forEach((el, index) => {
                    items.push({
                        id: el.dataset.id,
                        sort_order: index + 1
                    });
                });

                console.log('Sending data:', items); // For debugging

                fetch("{{ route('admin.menus.sort') }}", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            menus: items
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status || data.success) {
                            alert('✅ Menu order saved successfully!');
                        } else {
                            alert('❌ ' + (data.message || 'Failed to save'));
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Error saving order. Check console.');
                    });
            });
        });
    </script>
@endsection
