@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-semibold text-gray-800">All Notices</h1>

            <a href="{{ route('admin.notices.create') }}"
                class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-medium transition">
                <i class="fas fa-plus"></i>
                Add New Notice
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Card -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-800">
                        <tr>
                            <th class="w-12 px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                #</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Title
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-4 text-center text-xs font-medium text-gray-300 uppercase tracking-wider w-56">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($notices as $notice)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $notice->title }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-600">
                                    {{ $notice->notice_date->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if ($notice->is_active)
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-center space-x-2">
                                    <!-- Edit -->
                                    <a href="{{ route('admin.notices.edit', $notice->id) }}"
                                        class="inline-flex items-center gap-1.5 bg-amber-500 hover:bg-amber-600 text-white text-sm px-4 py-2 rounded-xl transition">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>

                                    <!-- Download -->
                                    <a href="{{ route('admin.notices.download', $notice->id) }}" target="_blank"
                                        class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white text-sm px-4 py-2 rounded-xl transition">
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.notices.destroy', $notice->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this notice?')"
                                            class="inline-flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white text-sm px-4 py-2 rounded-xl transition">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    No notices found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t">
                {{ $notices->links() }}
            </div>
        </div>
    </div>
@endsection
