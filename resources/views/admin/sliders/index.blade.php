@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- HEADER -->
        <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
            <h3 class="text-xl font-semibold text-gray-900">
                Slider List
            </h3>

            <a href="{{ route('admin.sliders.create') }}"
                class="px-5 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 transition text-sm font-medium">
                + Add Slider
            </a>
        </div>

        <!-- TABLE CARD -->
        <div class="bg-white shadow-sm sm:rounded-xl overflow-hidden">

            <div class="p-6">

                @if ($sliders->count() == 0)
                    <div class="text-center py-12 text-gray-500">
                        No sliders found
                    </div>
                @else
                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-gray-200 text-sm">

                            <!-- HEAD -->
                            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                                <tr>
                                    <th class="px-6 py-3 text-left">Image</th>
                                    <th class="px-6 py-3 text-left">Title</th>
                                    <th class="px-6 py-3 text-left">Button</th>
                                    <th class="px-6 py-3 text-left">Status</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>

                            <!-- BODY -->
                            <tbody class="divide-y divide-gray-100">

                                @foreach ($sliders as $slider)
                                    <tr class="hover:bg-gray-50 transition">

                                        <!-- IMAGE -->
                                        <td class="px-6 py-4">
                                            <img src="{{ asset('storage/' . $slider->image) }}"
                                                class="w-20 h-14 rounded-lg object-cover border">
                                        </td>

                                        <!-- TITLE -->
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-gray-900">
                                                {!! $slider->title !!}
                                            </div>

                                            @if ($slider->highlight_text)
                                                <div class="text-sm text-gray-500">
                                                    {{ $slider->highlight_text }}
                                                </div>
                                            @endif
                                        </td>

                                        <!-- BUTTON -->
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $slider->button_text ?? '-' }}
                                        </td>

                                        <!-- STATUS -->
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 text-xs rounded-full font-medium
                                            {{ $slider->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $slider->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>

                                        <!-- ACTIONS -->
                                        <td class="px-6 py-4 text-right">

                                            <div class="flex justify-end gap-2">

                                                <!-- EDIT -->
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                    class="px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 text-xs">
                                                    Edit
                                                </a>

                                                <!-- DELETE -->
                                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this slider?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700 text-xs">
                                                        Delete
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                @endif

            </div>

        </div>

    </div>
@endsection
