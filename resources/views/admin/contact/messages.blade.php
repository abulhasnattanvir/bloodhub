@extends('layouts.admin')

@section('content')
    <div class="p-8">
        <h1 class="text-3xl font-bold mb-8">Contact Messages <span class="text-red-600">({{ $messages->total() }})</span></h1>

        <div class="bg-white rounded-3xl shadow overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left">Name</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Subject</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $msg)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $msg->name }}</td>
                            <td class="px-6 py-4">{{ $msg->email }}</td>
                            <td class="px-6 py-4">{{ $msg->subject }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $msg->created_at->format('d M, Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($msg->status == 'new')
                                    <span
                                        class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">New</span>
                                @else
                                    <span
                                        class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Read</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.contact.messages.show', $msg->id) }}"
                                    class="text-red-600 hover:underline">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
