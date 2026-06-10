@extends('layouts.admin')
@section('title', 'Roles Management')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Roles Management</h1>
                <p class="text-gray-600 mt-1">Create and manage user roles and their permissions</p>
            </div>

            <a href="{{ route('admin.usermodule.create') }}"
                class="btn btn-primary flex items-center gap-2 px-5 py-3 rounded-xl shadow-sm hover:shadow-md transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Role
            </a>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Permissions</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($roles as $role)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="w-8 h-8 bg-gradient-to-br from-purple-500 to-violet-600 rounded-lg flex items-center justify-center text-white text-sm font-medium">
                                            {{ strtoupper(substr($role->name, 0, 1)) }}
                                        </div>
                                        <span class="ml-3 font-semibold text-gray-900">{{ ucfirst($role->name) }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-5">
                                    @if ($role->permissions->isNotEmpty())
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($role->permissions as $permission)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 text-xs font-medium bg-emerald-100 text-emerald-700 rounded-full">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm italic">No permissions assigned</span>
                                    @endif
                                </td>

                                <td class="px-6 py-5 text-center whitespace-nowrap">
                                    <a href="{{ route('admin.usermodule.edit', $role) }}"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-amber-600 hover:text-amber-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <div
                                        class="mx-auto w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                        <span class="text-3xl">🔑</span>
                                    </div>
                                    <p class="text-gray-500 font-medium">No roles found</p>
                                    <p class="text-sm text-gray-400 mt-1">Create your first role to get started</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
