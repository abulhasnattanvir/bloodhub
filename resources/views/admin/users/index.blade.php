@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Users</h1>
                <p class="text-gray-600 mt-1">Manage system users and their roles</p>
            </div>

            <a href="{{ route('admin.users.create') }}"
                class="btn btn-primary bg-blue-600 text-white flex items-center gap-2 px-5 py-3 rounded-xl shadow-sm hover:shadow-md transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New User
            </a>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                            </th>
                            <th
                                class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-9 h-9 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-medium text-sm">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5 whitespace-nowrap text-gray-600">
                                    {{ $user->email }}
                                </td>

                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if ($user->roles->isNotEmpty())
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($user->roles as $role)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-700">
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">No role</span>
                                    @endif
                                </td>

                                <td class="px-6 py-5 whitespace-nowrap text-right space-x-3">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.595 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.595-1.858L5 7m5-4v6m4-6v6m1-10V9a1 1 0 00-1 1v1M12 4v6m2-3v6" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 flex justify-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
