@extends('layouts.admin')

@section('content')
    <div class="bg-white p-6 rounded-xl shadow">

        <form action="{{ route('admin.notice-ticker.store') }}" method="POST">

            @csrf

            <div class="mb-4">

                <label class="block mb-2">
                    শিরোনাম
                </label>

                <input type="text" name="title" class="w-full border rounded-lg p-3" required>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    লিংক
                </label>

                <input type="url" name="url" class="w-full border rounded-lg p-3">

            </div>

            <div class="mb-4">

                <label class="flex items-center gap-2">

                    <input type="checkbox" name="is_active" value="1" checked>

                    সক্রিয়

                </label>

            </div>

            <button class="bg-green-600 text-white px-5 py-2 rounded-lg">

                সংরক্ষণ করুন

            </button>

        </form>

    </div>
@endsection
