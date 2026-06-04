@extends('layouts.admin')

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-semibold text-gray-800">Sliders</h1>
                    <p class="text-gray-500 mt-1">Manage your website hero sliders</p>
                </div>

                <a href="{{ route('admin.sliders.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl transition shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Slider
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                @if ($sliders->isEmpty())
                    <div class="text-center py-20">
                        <div class="mx-auto w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                            <span class="text-4xl">🖼️</span>
                        </div>
                        <h3 class="text-xl font-medium text-gray-700">No sliders yet</h3>
                        <p class="text-gray-500 mt-2">Create your first slider to get started.</p>
                        <a href="{{ route('admin.sliders.create') }}"
                            class="mt-6 inline-block px-6 py-3 bg-red-600 text-white rounded-2xl hover:bg-red-700">
                            Create First Slider
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Image</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Slider Info</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Button</th>
                                    <th
                                        class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th
                                        class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach ($sliders as $slider)
                                    <tr class="hover:bg-gray-50 transition group">
                                        <!-- Image -->
                                        <td class="px-6 py-4">
                                            <div
                                                class="w-20 h-14 rounded-2xl overflow-hidden border border-gray-200 shadow-sm">
                                                <img src="{{ asset('storage/' . $slider->image) }}"
                                                    alt="{{ strip_tags($slider->title) }}"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                            </div>
                                        </td>

                                        <!-- Info -->
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900 text-base leading-tight">
                                                {!! $slider->title !!} {{-- HTML Supported --}}
                                            </div>
                                            @if ($slider->highlight_text)
                                                <div class="text-sm text-red-600 mt-1">
                                                    {{ $slider->highlight_text }}
                                                </div>
                                            @endif
                                            @if ($slider->order !== null)
                                                <div class="text-xs text-gray-400 mt-1">
                                                    Order: #{{ $slider->order }}
                                                </div>
                                            @endif
                                        </td>

                                        <!-- Button -->
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            @if ($slider->button_text)
                                                <span class="inline-block px-3 py-1 bg-gray-100 rounded-lg">
                                                    {{ $slider->button_text }}
                                                </span>
                                            @else
                                                <span class="text-gray-400">-</span>
                                            @endif
                                        </td>

                                        <!-- Status -->
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="inline-flex items-center px-4 py-1.5 rounded-2xl text-xs font-semibold
                                                {{ $slider->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $slider->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <!-- Actions -->
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                    class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-2xl flex items-center gap-1 text-sm font-medium transition">
                                                    ✏️ Edit
                                                </a>

                                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Delete this slider permanently?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-2xl flex items-center gap-1 text-sm font-medium transition">
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if (method_exists($sliders, 'hasPages') && $sliders->hasPages())
                        <div class="px-6 py-5 border-t border-gray-100">
                            {{ $sliders->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection
