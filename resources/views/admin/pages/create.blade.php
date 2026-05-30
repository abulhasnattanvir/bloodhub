@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow">

        <h2 class="text-2xl font-bold mb-6">Create Page</h2>

        <form action="{{ route('admin.pages.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block mb-2 font-semibold">Title</label>
                <input type="text" name="title" class="w-full border rounded-lg px-4 py-3">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">Slug</label>
                <input type="text" name="slug" class="w-full border rounded-lg px-4 py-3"
                    placeholder="privacy-policy">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">Content</label>
                <textarea name="content" class="max-w-xl" id="summernote"></textarea>
            </div>

            <div class="mb-4">
                <label>
                    <input type="checkbox" name="status" value="1" checked>
                    Active
                </label>
            </div>

            <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg">
                Save Page
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
