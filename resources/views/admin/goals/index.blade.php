@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Our Goals</h1>
            <a href="{{ route('admin.goals.create') }}" class="bg-red-600 text-white px-5 py-2 rounded-xl hover:bg-red-700">
                + Add New
            </a>
        </div>

        <table class="w-full bg-white rounded-2xl shadow overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left">Icon</th>
                    <th class="px-6 py-4 text-left">Goals</th>
                    <th class="px-6 py-4 text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($goals as $goal)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <i class="fas {{ $goal->icon }} text-2xl text-red-600"></i>
                        </td>
                        <td class="px-6 py-4">{{ $goal->text }}</td>
                        <td class="px-6 py-4 text-center space-x-4">
                            <a href="{{ route('admin.goals.edit', $goal) }}"
                                class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-700">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.goals.destroy', $goal) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Do you want to delete this goal ?')"
                                    class="inline-flex items-center gap-1 text-red-600 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
