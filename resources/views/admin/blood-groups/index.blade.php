@extends('layouts.admin')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Blood Groups</h1>
                    <p class="text-gray-500 mt-1">Manage all available blood groups</p>
                </div>

                <a href="{{ route('admin.blood-groups.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl shadow-sm transition">
                    <i class="fas fa-plus"></i>
                    Add Blood Group
                </a>
            </div>

            @if ($bloodGroups->isEmpty())
                <div class="bg-white rounded-2xl shadow-sm py-16 text-center">
                    <i class="fas fa-tint text-6xl text-gray-200 mb-4"></i>
                    <p class="text-gray-500 text-lg">No blood groups found</p>
                    <a href="{{ route('admin.blood-groups.create') }}"
                        class="mt-6 inline-flex items-center gap-2 px-6 py-3 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">
                        <i class="fas fa-plus"></i>
                        Add First Blood Group
                    </a>
                </div>
            @else
                <!-- Search Bar -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-6">
                    <form method="GET" action="{{ route('admin.blood-groups.index') }}"
                        class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Search by blood group name..."
                                class="w-full rounded-xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-3 px-4">
                        </div>
                        <button type="submit"
                            class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-xl transition flex items-center gap-2">
                            <i class="fas fa-search"></i>
                            Search
                        </button>

                        @if (request('search'))
                            <a href="{{ route('admin.blood-groups.index') }}"
                                class="px-6 py-3 text-gray-600 hover:bg-gray-100 rounded-xl transition flex items-center">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                <!-- Table Card -->
                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Blood Group
                                </th>
                                <th
                                    class="px-8 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Description
                                </th>
                                <th
                                    class="px-8 py-5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($bloodGroups as $bloodGroup)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-8 py-5">
                                        <span
                                            class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 font-semibold rounded-2xl text-lg">
                                            {{ $bloodGroup->name }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-gray-600">
                                        {{ $bloodGroup->description ?? '—' }}
                                    </td>
                                    <td class="px-8 py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.blood-groups.edit', $bloodGroup->id) }}"
                                                class="px-4 py-2 text-blue-600 hover:bg-blue-50 rounded-xl transition">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.blood-groups.destroy', $bloodGroup->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to delete this blood group?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 text-red-600 hover:bg-red-50 rounded-xl transition">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if ($bloodGroups->hasPages())
                    <div class="mt-8 flex items-center justify-between">
                        <p class="text-sm text-gray-500">
                            Showing {{ $bloodGroups->firstItem() }} to {{ $bloodGroups->lastItem() }}
                            of {{ $bloodGroups->total() }} results
                        </p>
                        <div class="mt-4">
                            {{ $bloodGroups->links() }}
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
