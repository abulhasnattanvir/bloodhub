@extends('layouts.admin')

@section('content')
    <div class="py-6 md:py-10">
        <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-red-100 text-red-600 rounded-3xl flex items-center justify-center">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Members</h1>
                        <p class="text-gray-500">Manage all registered members</p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white shadow-sm rounded-3xl p-6 mb-8">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">

                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Name, phone, email..."
                            class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                    </div>

                    <!-- Blood Group -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Blood Group</label>
                        <select name="blood_group"
                            class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                            <option value="">All Blood Groups</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                                <option value="{{ $bg }}" {{ request('blood_group') == $bg ? 'selected' : '' }}>
                                    {{ $bg }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">City</label>
                        <input type="text" name="city" value="{{ request('city') }}" placeholder="City"
                            class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                        <select name="status"
                            class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-end gap-3">
                        <button type="submit"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white py-4 px-6 rounded-2xl font-medium transition">
                            Filter
                        </button>
                        <a href="{{ route('admin.members.index') }}"
                            class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 py-4 px-6 rounded-2xl font-medium transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Members Table -->
            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Photo</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Name</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Phone</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Profession
                                </th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Gender</th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">Blood Group
                                </th>
                                <th class="px-6 py-5 text-left text-xs font-semibold text-gray-500 uppercase">City</th>
                                <th class="px-6 py-5 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-5 text-center text-xs font-semibold text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($members as $member)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-5">
                                        @if ($member->photo)
                                            <img src="{{ asset($member->photo) }}"
                                                class="w-12 h-12 rounded-2xl object-cover border border-gray-200"
                                                alt="">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 font-medium text-gray-900">{{ $member->name }}</td>
                                    <td class="px-6 py-5 text-gray-700">{{ $member->phone }}</td>
                                    <td class="px-6 py-5 text-gray-600">{{ $member->profession ?? '—' }}</td>
                                    <td class="px-6 py-5 capitalize">{{ $member->gender }}</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex px-4 py-2 bg-red-100 text-red-700 font-semibold rounded-2xl text-sm">
                                            {{ $member->blood_group }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-gray-700">{{ $member->city }}</td>
                                    <td class="px-6 py-5 text-center">
                                        <span
                                            class="inline-flex px-4 py-1.5 text-xs font-semibold rounded-2xl
                                            @if ($member->status == 'approved') bg-green-100 text-green-700
                                            @elseif($member->status == 'rejected') bg-red-100 text-red-700
                                            @else bg-yellow-100 text-yellow-700 @endif">
                                            {{ ucfirst($member->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-wrap gap-2 justify-center">
                                            @if ($member->status != 'approved')
                                                <form method="POST"
                                                    action="{{ route('admin.members.approve', $member->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-2xl transition">
                                                        Approve
                                                    </button>
                                                </form>
                                            @endif

                                            @if ($member->status != 'rejected')
                                                <form method="POST"
                                                    action="{{ route('admin.members.reject', $member->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm rounded-2xl transition">
                                                        Reject
                                                    </button>
                                                </form>
                                            @endif

                                            <a href="{{ route('admin.members.edit', $member->id) }}"
                                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-2xl transition">
                                                Edit
                                            </a>

                                            <form method="POST" action="{{ route('admin.member.destory', $member->id) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this member?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-2xl transition">
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

                @if ($members->isEmpty())
                    <div class="py-16 text-center">
                        <i class="fas fa-users text-6xl text-gray-200"></i>
                        <p class="mt-4 text-gray-500">No members found</p>
                    </div>
                @endif
            </div>

            <!-- Pagination -->
            @if ($members->hasPages())
                <div class="mt-8">
                    {{ $members->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 mt-6">

        <h3 class="text-xl font-semibold mb-4">
            Payment History
        </h3>

        <table class="w-full">

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Month</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($member->subscriptions as $subscription)
                    <tr>
                        <td>{{ $member->name }}</td>

                        <td>{{ $subscription->month }}</td>

                        <td>
                            ৳{{ number_format($subscription->expected_amount, 2) }}
                        </td>

                        <td>
                            @if ($subscription->status == 'paid')
                                <span class="text-green-600 font-medium">
                                    Paid
                                </span>
                            @else
                                <span class="text-red-600 font-medium">
                                    Due
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4">
                            No payment records found.
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>
@endsection
