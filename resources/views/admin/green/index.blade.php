@extends('layouts.admin')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Green Initiatives</h2>
                    <p class="text-gray-600 mt-1">List of Green Initiatives</p>
                </div>

                <a href="{{ route('admin.green.create') }}"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-2xl transition-all duration-200 shadow-lg shadow-green-500/30 hover:shadow-xl hover:-translate-y-0.5">
                    <i class="fas fa-plus"></i>
                    Add New
                </a>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full divide-y divide-gray-200">
                        <thead class="bg-green-900">
                            <tr>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Photo</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Title</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Location</th>
                                <th
                                    class="px-6 py-5 text-center text-xs font-semibold text-gray-300 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($greenInitiatives as $item)
                                <tr class="hover:bg-green-50/50 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                class="w-16 h-16 object-cover rounded-2xl border border-gray-200 shadow-sm">
                                        @else
                                            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400 text-2xl"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900 font-semibold line-clamp-2">{{ $item->title }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                        {{ $item->date ? $item->date->format('d M, Y') : '<span class="text-gray-400">-</span>' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $item->location ?? '<span class="text-gray-400">-</span>' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('admin.green.edit', $item) }}"
                                                class="inline-flex items-center justify-center w-9 h-9 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-xl transition-colors">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('admin.green.destroy', $item) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this Item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-9 h-9 bg-red-100 hover:bg-red-200 text-red-700 rounded-xl transition-colors">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="fas fa-seedling text-5xl text-gray-300 mb-4"></i>
                                            <p class="text-gray-500 text-lg">No results found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-5 border-t border-gray-100 bg-gray-50 flex justify-center">
                    {{ $greenInitiatives->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
