@extends('layouts.admin')

@section('content')
    <div class="max-w-8xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

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
                                <th class="px-6 py-4 text-center font-semibold text-gray-700">
                                    Progress
                                </th>
                                {{-- <th class="px-6 py-4 text-right font-semibold text-gray-700">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($subscriptions as $subscription)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-5 font-medium text-gray-800">
                                        {{-- {{ $subscription->month }} --}}
                                        {{ \Carbon\Carbon::parse($subscription->month)->format('F Y') }}
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
                                    <td class="px-6 py-5 text-center text-sm text-gray-700">
                                        @php
                                            $paid = $member->subscriptions->where('status', 'paid')->count();
                                            $total = $member->subscriptions->count();
                                        @endphp

                                        <span class="font-semibold">
                                            {{ $paid }} / {{ $total }} months
                                        </span>
                                    </td>
                                    {{-- <td class="px-6 py-5 text-right">

                                        @if ($member->fee_applicable)
                                            @if ($subscription->status !== 'paid')
                                                <form method="POST" action="{{ route('admin.payments.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="subscription_id"
                                                        value="{{ $subscription->id }}">
                                                    <input type="hidden" name="amount"
                                                        value="{{ $subscription->expected_amount }}">

                                                    <button onclick="return confirm('Mark this payment as paid?')"
                                                        class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl">
                                                        Mark as Paid
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400 text-sm">—</span>
                                            @endif
                                        @else
                                            <span class="text-gray-300 text-sm">Not Applicable</span>
                                        @endif

                                    </td> --}}
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



    @if ($member->fee_applicable)

        @php
            $feeStructure = \App\Models\FeeStructure::where('profession', $member->profession)
                ->where('status', 1)
                ->first();

            $monthlyFee = $feeStructure?->monthly_fee ?? 0;
        @endphp

        <div class="max-w-8xl mx-auto mt-10 p-8 rounded-2xl bg-white shadow-sm">

            {{-- Success --}}
            @if (session('success'))
                <div class="mb-4 p-4 rounded-xl bg-green-100 border border-green-200 text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error --}}
            @if (session('error'))
                <div class="mb-4 p-4 rounded-xl bg-red-100 border border-red-200 text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Validation --}}
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-5">
                <h2 class="text-xl font-semibold text-gray-800">
                    Advance Payment
                </h2>

                <p class="text-gray-500 mt-1">
                    Monthly Fee:
                    <span class="font-semibold text-blue-600">
                        {{ number_format($monthlyFee) }} BDT
                    </span>
                </p>
            </div>

            <form method="POST" action="{{ route('admin.payments.store') }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @csrf

                <input type="hidden" name="member_id" value="{{ $member->id }}">

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Payment Amount
                    </label>

                    <input type="number" required min="{{ $monthlyFee }}" step="{{ $monthlyFee }}" name="amount"
                        id="amount" placeholder="Enter amount" class="border rounded-xl p-3 w-full">
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">
                        Payment Method
                    </label>

                    <input type="text" required name="method" placeholder="Cash / Bkash / Bank"
                        class="border rounded-xl p-3 w-full">
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium">
                        Pay Now
                    </button>
                </div>

            </form>

            {{-- Live Months Preview --}}
            <div class="mt-5 p-4 bg-blue-50 rounded-xl">
                <p class="text-gray-700">
                    This payment will cover:
                    <span id="monthsPreview" class="font-bold text-blue-700">
                        0
                    </span>
                    month(s)
                </p>
            </div>

        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const amountInput = document.getElementById('amount');
                const preview = document.getElementById('monthsPreview');
                const monthlyFee = {{ $monthlyFee }};

                amountInput.addEventListener('input', function() {

                    const amount = parseFloat(this.value) || 0;

                    const months = Math.floor(amount / monthlyFee);

                    preview.textContent = months;
                });
            });
        </script>

    @endif
@endsection
