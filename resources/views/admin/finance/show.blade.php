@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="px-8 py-6 border-b bg-gradient-to-r from-blue-600 to-indigo-600 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold">{{ $member->name }}</h1>
                        <p class="text-blue-100 mt-1">{{ $member->profession ?? 'Member' }}</p>
                    </div>

                    <a href="{{ route('admin.finance.index') }}"
                        class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-5 py-2.5 rounded-xl transition">
                        ← Back to Members
                    </a>
                </div>
            </div>

            <!-- Total Due Card -->
            <div class="p-8 border-b bg-gray-50">
                <div class="bg-white rounded-2xl shadow-sm p-6 max-w-md">
                    <p class="text-gray-500 text-sm font-medium">TOTAL DUE</p>
                    <p class="text-5xl font-bold text-gray-800 mt-2">
                        {{ number_format($totalDue) }} <span class="text-2xl font-normal">BDT</span>
                    </p>
                    @if ($totalDue > 0)
                        <span
                            class="inline-block mt-3 px-4 py-1.5 bg-red-100 text-red-700 text-sm font-semibold rounded-full">
                            Payment Pending
                        </span>
                    @else
                        <span
                            class="inline-block mt-3 px-4 py-1.5 bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-full">
                            Fully Paid
                        </span>
                    @endif
                </div>
            </div>

            <!-- Table Section -->
            <div class="p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Subscription History</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Month</th>
                                <th class="px-6 py-4 text-left font-semibold text-gray-700">Amount</th>
                                <th class="px-6 py-4 text-center font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-right font-semibold text-gray-700">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($subscriptions as $subscription)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5 font-medium text-gray-800">
                                        {{ $subscription->month }}
                                    </td>
                                    <td class="px-6 py-5 text-gray-700 font-medium">
                                        {{ number_format($subscription->expected_amount) }} BDT
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        @if ($subscription->status === 'paid')
                                            <span
                                                class="inline-flex items-center gap-1 px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium">
                                                <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                                Paid
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center gap-1 px-4 py-1.5 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">
                                                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-right">
                                        @if ($subscription->status !== 'paid')
                                            <form method="POST" action="{{ route('admin.payments.store') }}">
                                                @csrf
                                                <input type="hidden" name="subscription_id"
                                                    value="{{ $subscription->id }}">
                                                <input type="hidden" name="amount"
                                                    value="{{ $subscription->expected_amount }}">

                                                <button onclick="return confirm('Mark this payment as paid?')"
                                                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl font-medium transition active:scale-95">
                                                    <span>Mark as Paid</span>
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-sm">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if ($subscriptions->isEmpty())
                    <div class="text-center py-16 text-gray-400">
                        No subscription records found.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Advance Payment Form -->
    <div class="p-8 border-b bg-white">

        <h2 class="text-xl font-semibold mb-4 text-gray-800">
            Make Payment (Advance Support)
        </h2>

        <form method="POST" action="{{ route('admin.payments.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">

            @csrf

            <!-- Member ID -->
            <input type="hidden" name="member_id" value="{{ $member->id }}">

            <!-- Amount -->
            <input type="number" name="amount" placeholder="Amount (e.g. 300)" class="border rounded-xl p-3 w-full">

            <!-- Months Covered -->
            <input type="number" name="months_covered" placeholder="Months (e.g. 3)" class="border rounded-xl p-3 w-full">

            <!-- Method -->
            <input type="text" name="method" placeholder="Method (cash/bkash)" class="border rounded-xl p-3 w-full">

            <!-- Submit -->
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium">
                Pay Now
            </button>

        </form>

    </div>
@endsection
