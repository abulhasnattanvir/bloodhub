@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Gallery Management</h1>
                <p class="text-gray-500">Manage gallery images and events</p>
            </div>

            <a href="{{ route('admin.gallery.create') }}"
                class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow transition">
                <i class="fas fa-plus mr-2"></i>
                Add Gallery Image
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="mb-5 p-4 rounded-xl bg-green-100 text-green-700 border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

            {{-- Table Header --}}
            <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                <h2 class="font-semibold text-lg">
                    Gallery Images
                </h2>

                <span class="text-sm text-gray-500">
                    Total: {{ $galleries->total() }}
                </span>
            </div>

            @if ($galleries->count())
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    Image
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    Title
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    Category
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                    Event Date
                                </th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach ($galleries as $gallery)
                                <tr class="hover:bg-gray-50">

                                    {{-- Image --}}
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery->title }}"
                                            class="w-20 h-20 object-cover rounded-xl border">
                                    </td>

                                    {{-- Title --}}
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-800">
                                            {{ $gallery->title }}
                                        </div>

                                        @if ($gallery->description)
                                            <div class="text-sm text-gray-500 mt-1 line-clamp-2">
                                                {{ Str::limit($gallery->description, 80) }}
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Category --}}
                                    <td class="px-6 py-4">
                                        @if ($gallery->category)
                                            <span
                                                class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                                                {{ $gallery->category }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">
                                                N/A
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Date --}}
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $gallery->event_date ? \Carbon\Carbon::parse($gallery->event_date)->format('d M Y') : 'N/A' }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">

                                            <a href="{{ route('admin.gallery.edit', $gallery->id) }}"
                                                class="inline-flex items-center px-3 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="p-6 border-t">
                    {{ $galleries->links() }}
                </div>
            @else
                <div class="p-16 text-center">
                    <div class="text-6xl text-gray-300 mb-4">
                        <i class="fas fa-images"></i>
                    </div>

                    <h3 class="text-xl font-semibold text-gray-700 mb-2">
                        No Gallery Images Found
                    </h3>

                    <p class="text-gray-500 mb-6">
                        Start by adding your first gallery image.
                    </p>

                    <a href="{{ route('admin.gallery.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl">
                        <i class="fas fa-plus mr-2"></i>
                        Add Image
                    </a>
                </div>
            @endif

        </div>

    </div>
@endsection
