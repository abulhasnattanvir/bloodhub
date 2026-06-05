@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="px-8 py-6 border-b flex items-center justify-between bg-gray-50">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Fee Structures</h2>
                    <p class="text-gray-500 mt-1">Manage monthly fees by profession</p>
                </div>

                <a href="{{ route('admin.fees.create') }}"
                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-medium transition active:scale-95">
                    <span>+ Add New Fee</span>
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 border-b">
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Profession</th>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Monthly Fee</th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-right font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($fees as $fee)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-5 font-medium text-gray-800">
                                    {{ $fee->profession }}
                                </td>
                                <td class="px-6 py-5 text-gray-700 font-semibold">
                                    {{ number_format($fee->monthly_fee) }} <span
                                        class="text-sm font-normal text-gray-500">BDT</span>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    @if ($fee->status)
                                        <span
                                            class="inline-flex items-center gap-1 px-4 py-1.5 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-medium">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <div class="flex items-center justify-end gap-3">
                                        <!-- Edit Button -->
                                        <a href="{{ route('admin.fees.edit', $fee) }}"
                                            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium transition">
                                            Edit
                                        </a>

                                        <!-- Delete Button -->
                                        <form method="POST" action="{{ route('admin.fees.destroy', $fee) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this fee structure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 rounded-xl font-medium transition">
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

            <!-- Empty State -->
            @if ($fees->isEmpty())
                <div class="text-center py-20">
                    <p class="text-gray-400 text-xl">No fee structures found.</p>
                    <a href="{{ route('admin.fees.create') }}" class="mt-4 inline-block text-blue-600 hover:underline">
                        Create your first fee structure →
                    </a>
                </div>
            @endif

        </div>
    </div>
@endsection
