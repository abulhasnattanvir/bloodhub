@extends('layouts.admin')

@section('content')
    {{-- <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

        <h2 class="text-xl font-bold mb-4">Admin Profile</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-4">

            @csrf
            @method('PATCH')

            <!-- NAME -->
            <div>
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border p-2 rounded">
            </div>

            <!-- EMAIL -->
            <div>
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border p-2 rounded">
            </div>

            <!-- IMAGE -->
            <div>
                <label>Profile Image</label>
                <input type="file" name="profile_image" class="w-full">

                @if ($user->profile_image)
                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="w-20 h-20 rounded-full mt-2">
                @endif
            </div>

            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Update Profile
            </button>

        </form>
    </div> --}}

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
@endsection
