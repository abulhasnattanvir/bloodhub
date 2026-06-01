@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">

        <h2 class="text-2xl font-bold mb-6">Edit Council Member</h2>

        <form method="POST" action="{{ route('admin.council.update', $council->id) }}" enctype="multipart/form-data"
            class="bg-white shadow rounded-xl p-6 space-y-4">

            @csrf
            @method('PUT')

            {{-- NAME --}}
            <input type="text" name="name" value="{{ $council->name }}" class="w-full border p-3 rounded-lg">

            {{-- POSITION --}}
            <select name="position" class="w-full border p-3 rounded-lg">

                <option value="president" {{ $council->position == 'president' ? 'selected' : '' }}>President</option>
                <option value="vice_president" {{ $council->position == 'vice_president' ? 'selected' : '' }}>Vice President
                </option>
                <option value="secretary" {{ $council->position == 'secretary' ? 'selected' : '' }}>Secretary</option>
                <option value="joint_secretary" {{ $council->position == 'joint_secretary' ? 'selected' : '' }}>Joint
                    Secretary</option>
                <option value="member" {{ $council->position == 'member' ? 'selected' : '' }}>Member</option>
                <option value="advisor" {{ $council->position == 'advisor' ? 'selected' : '' }}>Advisor</option>

            </select>

            {{-- PHONE --}}
            <input type="text" name="phone" value="{{ $council->phone }}" class="w-full border p-3 rounded-lg">

            {{-- EMAIL --}}
            <input type="email" name="email" value="{{ $council->email }}" class="w-full border p-3 rounded-lg">

            {{-- BIO --}}
            <textarea name="bio" rows="4" class="w-full border p-3 rounded-lg">{{ $council->bio }}</textarea>

            {{-- CURRENT PHOTO --}}
            @if ($council->photo)
                <div class="mb-2">
                    <img src="{{ asset($council->photo) }}" class="w-20 h-20 rounded-full object-cover">
                </div>
            @endif

            {{-- PHOTO --}}
            <input type="file" name="photo" class="w-full border p-3 rounded-lg">

            {{-- SOCIAL LINKS --}}
            <div class="grid md:grid-cols-2 gap-3">

                <input type="text" name="facebook" value="{{ $council->facebook }}" class="border p-3 rounded-lg">

                <input type="text" name="twitter" value="{{ $council->twitter }}" class="border p-3 rounded-lg">

                <input type="text" name="linkedin" value="{{ $council->linkedin }}" class="border p-3 rounded-lg">

                <input type="text" name="instagram" value="{{ $council->instagram }}" class="border p-3 rounded-lg">

            </div>

            {{-- STATUS --}}
            <select name="status" class="w-full border p-3 rounded-lg">

                <option value="1" {{ $council->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $council->status == 0 ? 'selected' : '' }}>Inactive</option>

            </select>

            {{-- UPDATE --}}
            <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition">
                Update Member
            </button>

        </form>

    </div>
@endsection
