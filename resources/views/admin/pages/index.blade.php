@extends('layouts.admin')

@section('content')
    <div class="p-6 bg-white rounded-xl shadow">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">All Pages</h2>

            <a href="{{ route('admin.pages.create') }}" class="bg-red-600 text-white px-5 py-2 rounded-lg">
                Add Page
            </a>
        </div>

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="p-3 text-left">Title</th>
                    <th class="p-3 text-left">Slug</th>
                    <th class="p-3 text-left">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pages as $page)
                    <tr class="border-b">
                        <td class="p-3">{{ $page->title }}</td>
                        <td class="p-3">{{ $page->slug }}</td>
                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.pages.edit', $page->id) }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-4 py-2 rounded">
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
@push('scripts')
    <script>
        $('#summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endpush
