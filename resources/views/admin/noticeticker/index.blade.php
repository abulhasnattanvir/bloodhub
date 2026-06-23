@extends('layouts.admin')

@section('content')
    <div class="bg-white rounded-xl shadow p-6">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-xl font-bold">
                Notice Ticker
            </h2>

            <a href="{{ route('admin.notice-ticker.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg">
                Add New
            </a>

        </div>

        <table class="w-full">

            <thead>
                <tr class="border-b">
                    <th class="text-left p-3">Title</th>
                    <th class="text-left p-3">Link</th>
                    <th class="text-left p-3">Status</th>
                    <th class="text-left p-3">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($tickers as $ticker)
                    <tr class="border-b">

                        <td class="p-3">
                            {{ $ticker->title }}
                        </td>

                        <td class="p-3">
                            {{ $ticker->url }}
                        </td>

                        <td class="p-3">

                            @if ($ticker->is_active)
                                <span class="text-green-600">
                                    Active
                                </span>
                            @else
                                <span class="text-red-600">
                                    Inactive
                                </span>
                            @endif

                        </td>

                        <td class="p-3 flex gap-2">

                            <a href="{{ route('admin.notice-ticker.edit', $ticker->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.notice-ticker.destroy', $ticker->id) }}" method="POST">

                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Are you sure you want to delete this notice ticker?')"
                                    class="bg-red-500 text-white px-3 py-1 rounded">

                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
@endsection
