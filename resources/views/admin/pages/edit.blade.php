@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-6">Edit Page</h2>

        <form action="{{ route('admin.pages.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-semibold">Title</label>
                <input type="text" name="title" value="{{ $page->title }}" class="w-full border rounded-lg px-4 py-3">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">Slug</label>
                <input type="text" name="slug" value="{{ $page->slug }}" class="w-full border rounded-lg px-4 py-3">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">Content</label>
                <textarea name="content" id="summernote">{{ $page->content }}</textarea>
            </div>

            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                Update Page
            </button>
        </form>
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
