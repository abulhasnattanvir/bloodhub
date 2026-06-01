@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">

        <h2 class="text-2xl font-bold mb-6">Add Council Member</h2>

        <form method="POST" action="{{ route('admin.council.store') }}" enctype="multipart/form-data"
            class="bg-white shadow rounded-xl p-6 space-y-4">

            @csrf

            {{-- NAME --}}
            <input type="text" name="name" placeholder="Full Name" class="w-full border p-3 rounded-lg">

            {{-- POSITION --}}
            <select name="position" class="w-full border p-3 rounded-lg">
                <option value="">Select Position</option>
                <option value="president">President</option>
                <option value="vice_president">Vice President</option>
                <option value="secretary">Secretary</option>
                <option value="joint_secretary">Joint Secretary</option>
                <option value="member">Member</option>
                <option value="advisor">Advisor</option>
            </select>

            {{-- PHONE --}}
            <input type="text" name="phone" placeholder="Phone" class="w-full border p-3 rounded-lg">

            {{-- EMAIL --}}
            <input type="email" name="email" placeholder="Email" class="w-full border p-3 rounded-lg">

            {{-- BIO --}}
            <textarea name="bio" rows="4" placeholder="Short Bio" class="w-full border p-3 rounded-lg"></textarea>

            {{-- PHOTO --}}
            <input type="file" name="photo" class="w-full border p-3 rounded-lg">

            {{-- SOCIAL LINKS --}}
            <div class="grid md:grid-cols-2 gap-3">

                <input type="text" name="facebook" placeholder="Facebook URL" class="border p-3 rounded-lg">

                <input type="text" name="twitter" placeholder="Twitter URL" class="border p-3 rounded-lg">

                <input type="text" name="linkedin" placeholder="LinkedIn URL" class="border p-3 rounded-lg">

                <input type="text" name="instagram" placeholder="Instagram URL" class="border p-3 rounded-lg">

            </div>

            {{-- STATUS --}}
            <select name="status" class="w-full border p-3 rounded-lg">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

            {{-- SUBMIT --}}
            <button class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition">
                Save Member
            </button>

        </form>

    </div>
@endsection
