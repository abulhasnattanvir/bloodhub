@extends('layouts.admin')

@section('content')
    <div class="p-6">

        <div class="flex justify-between mb-5">
            <h2 class="text-2xl font-bold">Council Management</h2>

            <a href="{{ route('admin.council.create') }}" class="bg-red-600 text-white px-4 py-2 rounded-lg">
                + Add Member
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-4">

            @foreach ($councils as $council)
                <div class="bg-white shadow rounded-xl p-4 text-center">

                    <img src="{{ asset($council->photo) }}" class="w-20 h-20 mx-auto rounded-full object-cover">

                    <h3 class="font-bold mt-2">{{ $council->name }}</h3>

                    <p class="text-sm text-red-500">
                        {{ ucfirst(str_replace('_', ' ', $council->position)) }}
                    </p>

                    <div class="mt-3 flex justify-center gap-2">

                        <a href="{{ route('admin.council.edit', $council->id) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('admin.council.destroy', $council->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-3 py-1 rounded text-sm"
                                onclick="return confirm('Delete?')">
                                Delete
                            </button>
                        </form>

                    </div>

                </div>
            @endforeach

        </div>

        <div class="mt-5">
            {{ $councils->links() }}
        </div>

    </div>
@endsection
