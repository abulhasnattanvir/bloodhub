@extends('layouts.admin')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">আমাদের কার্যক্রম</h1>
            <a href="{{ route('admin.activities.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-2xl flex items-center gap-2 transition">
                <i class="fas fa-plus"></i>
                নতুন কার্যক্রম যোগ করুন
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left w-16">আইকন</th>
                        <th class="px-6 py-4 text-left">কার্যক্রমের নাম</th>
                        <th class="px-6 py-4 text-left">স্লাগ</th>
                        <th class="px-6 py-4 text-center">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach ($activities as $activity)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-5">
                                <i class="fas {{ $activity->icon }} text-2xl text-red-600"></i>
                            </td>
                            <td class="px-6 py-5 font-medium text-gray-700">
                                {{ $activity->text }}
                            </td>
                            <td class="px-6 py-5 text-gray-500 text-sm">
                                {{ $activity->slug }}
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="flex justify-center gap-4">
                                    <a href="{{ route('admin.activities.edit', $activity) }}"
                                        class="text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.activities.destroy', $activity) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('আপনি কি এই কার্যক্রমটি মুছে ফেলতে চান?')"
                                            class="text-red-600 hover:text-red-700">
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

        <div class="mt-4">
            {{ $activities->links() }}
        </div>
    </div>
@endsection
