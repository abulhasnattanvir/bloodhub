@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <div class="max-w-2xl mx-auto">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Edit User</h1>
                    <p class="text-gray-600 mt-1">Update user information</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2">
                    ← Back to Users
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                placeholder="Enter full name" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                placeholder="user@example.com" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" name="password"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                placeholder="Leave blank to keep current password">
                            <p class="mt-1 text-xs text-gray-500">Only fill this if you want to change the password</p>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                            <select name="role"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all bg-white"
                                required>
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role', $user->hasRole($role->name) ? $role->name : '') == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 mt-10">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update User
                        </button>

                        <a href="{{ route('admin.users.index') }}"
                            class="flex-1 text-center border border-gray-300 hover:bg-gray-50 font-semibold py-4 px-6 rounded-xl transition-all">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
