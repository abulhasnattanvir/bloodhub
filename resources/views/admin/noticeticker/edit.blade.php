@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow">

        <form action="{{ route('admin.notice-ticker.update', $noticeTicker->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">

                <label class="block mb-2">
                    শিরোনাম
                </label>

                <input type="text" name="title" value="{{ $noticeTicker->title }}" class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    লিংক
                </label>

                <input type="url" name="url" value="{{ $noticeTicker->url }}" class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-4">

                <label class="flex items-center gap-2">

                    <input type="checkbox" name="is_active" value="1" {{ $noticeTicker->is_active ? 'checked' : '' }}>

                    সক্রিয়

                </label>

            </div>

            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg">

                আপডেট করুন

            </button>

        </form>

    </div>
@endsection
