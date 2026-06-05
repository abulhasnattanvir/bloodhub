@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="px-6 py-5 border-b flex items-center justify-between bg-gray-50">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Member Finance</h2>
                    <p class="text-gray-500 mt-1">Manage and view financial records of all members</p>
                </div>

                <!-- Optional: Search -->
                <div class="relative w-80">
                    <input type="text" id="search" placeholder="Search members..."
                        class="w-full pl-10 pr-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                    <div class="absolute left-4 top-3.5 text-gray-400">
                        🔍
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Member Name</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Profession</th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Total Paid </th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Active Since</th>
                            <th class="px-6 py-4 text-right font-semibold text-gray-700">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($members as $member)
                            <tr class="hover:bg-gray-50 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-medium">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $member->name }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-5 text-gray-600">
                                    {{ $member->profession ?? '—' }}
                                </td>

                                <td class="px-6 py-5 text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-5 text-gray-600">
                                    {{ number_format($member->total_paid ?? 0) }} BDT
                                </td>

                                <td class="px-6 py-5 text-gray-600">
                                    {{ $member->start_date ? \Carbon\Carbon::parse($member->start_date)->format('Y-m') : '—' }}
                                </td>

                                <td class="px-6 py-5 text-right">
                                    <a href="{{ route('admin.finance.show', $member) }}"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all active:scale-95">
                                        <span>View Finance</span>
                                        <span class="text-lg">→</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if ($members->isEmpty())
                <div class="text-center py-20">
                    <p class="text-gray-400 text-xl">No members found</p>
                </div>
            @endif

        </div>
    </div>
@endsection
