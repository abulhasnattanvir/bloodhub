@extends('layouts.admin')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Council Management</h1>
                    <p class="text-gray-500 mt-1">Manage your council members and their positions</p>
                </div>

                <a href="{{ route('admin.council.create') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-medium rounded-2xl shadow-sm transition">
                    <i class="fas fa-plus"></i>
                    Add New Member
                </a>
            </div>

            @if ($councils->isEmpty())
                <div class="bg-white rounded-3xl shadow-sm py-16 text-center">
                    <i class="fas fa-users text-6xl text-gray-200 mb-4"></i>
                    <p class="text-gray-500 text-lg">No council members found</p>
                </div>
            @else
                <!-- Council Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($councils as $council)
                        <div class="bg-white rounded-3xl shadow-sm overflow-hidden hover:shadow-md transition group">

                            <!-- Photo -->
                            <div class="h-48 bg-gray-100 flex items-center justify-center relative">
                                @if ($council->photo)
                                    <img src="{{ asset($council->photo) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                        alt="{{ $council->name }}">
                                @else
                                    <i class="fas fa-user text-6xl text-gray-300"></i>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-6 text-center">
                                <h3 class="font-semibold text-xl text-gray-900">{{ $council->name }}</h3>

                                <p class="text-red-600 font-medium mt-1">
                                    {{ ucfirst(str_replace('_', ' ', $council->position)) }}
                                </p>

                                <!-- Actions -->
                                <div class="flex justify-center gap-3 mt-6">
                                    <a href="{{ route('admin.council.edit', $council->id) }}"
                                        class="flex-1 inline-flex items-center justify-center gap-2 px-5 py-3 bg-blue-50 hover:bg-blue-100 text-blue-700 rounded-2xl transition text-sm font-medium">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>

                                    <form method="POST" action="{{ route('admin.council.destroy', $council->id) }}"
                                        class="flex-1"
                                        onsubmit="return confirm('Are you sure you want to delete this member?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-red-50 hover:bg-red-100 text-red-700 rounded-2xl transition text-sm font-medium">
                                            <i class="fas fa-trash"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Pagination -->
            @if ($councils->hasPages())
                <div class="mt-10 flex justify-center">
                    {{ $councils->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
