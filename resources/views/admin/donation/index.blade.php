@extends('layouts.admin')

@section('content')
    <div class="py-6 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Donation Requests</h1>
                    <p class="text-gray-500 mt-1">Manage all incoming donation requests</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Donor Name</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Phone</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Amount</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Method</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Transaction ID</th>
                                <th
                                    class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($donations as $donation)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-5 whitespace-nowrap font-medium text-gray-900">
                                        {{ $donation->name }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-gray-700">
                                        {{ $donation->phone }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap font-semibold text-gray-900">
                                        {{ number_format($donation->amount) }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="capitalize">{{ $donation->method }}</span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-gray-600 text-sm">
                                        {{ $donation->transaction_id ?? '—' }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-4 py-1.5 text-xs font-semibold rounded-2xl
                                            @if ($donation->status == 'approved') bg-green-100 text-green-700
                                            @elseif($donation->status == 'rejected') bg-red-100 text-red-700
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ ucfirst($donation->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-wrap gap-2 justify-center">
                                            @if ($donation->status != 'approved')
                                                <form method="POST"
                                                    action="{{ route('admin.donations.approve', $donation->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-2xl transition">
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($donation->status != 'rejected')
                                                <form method="POST"
                                                    action="{{ route('admin.donations.reject', $donation->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-2xl transition">
                                                        Reject
                                                    </button>
                                                </form>
                                            @endif

                                            <form method="POST"
                                                action="{{ route('admin.donations.destroy', $donation->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this donation request?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-2xl transition">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($donations->isEmpty())
                    <div class="p-12 text-center">
                        <i class="fas fa-donate text-5xl text-gray-200 mb-4"></i>
                        <p class="text-gray-500">No donation requests found</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($donations->hasPages())
                <div class="mt-8 flex justify-center">
                    {{ $donations->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
