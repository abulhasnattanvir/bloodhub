@extends('layouts.admin')

@section('content')
    <div class="p-6">

        <h2 class="text-2xl font-bold mb-5">Donation Requests</h2>

        <div class="overflow-x-auto bg-white shadow rounded-xl">

            <table class="w-full text-sm">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2">Name</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Method</th>
                        <th>Transaction</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($donations as $donation)
                        <tr class="border-t">

                            <td class="p-2">{{ $donation->name }}</td>
                            <td>{{ $donation->phone }}</td>
                            <td>{{ $donation->amount }}</td>
                            <td>{{ $donation->method }}</td>
                            <td>{{ $donation->transaction_id }}</td>

                            <td>
                                <span
                                    class="px-2 py-1 rounded text-white
                            @if ($donation->status == 'approved') bg-green-600
                            @elseif($donation->status == 'rejected') bg-red-600
                            @else bg-yellow-500 @endif">
                                    {{ $donation->status }}
                                </span>
                            </td>

                            <td class="flex gap-2 p-2">

                                <form method="POST" action="{{ route('admin.donations.approve', $donation->id) }}">
                                    @csrf
                                    <button class="bg-green-600 text-white px-2 py-1 rounded">Approve</button>
                                </form>

                                <form method="POST" action="{{ route('admin.donations.reject', $donation->id) }}">
                                    @csrf
                                    <button class="bg-yellow-500 text-white px-2 py-1 rounded">Reject</button>
                                </form>

                                <form method="POST" action="{{ route('admin.donations.destroy', $donation->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                </form>

                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        <div class="mt-5">
            {{ $donations->links() }}
        </div>

    </div>
@endsection
