@extends('layouts.admin')

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
                    <p class="mt-1 text-gray-600">Welcome back! Here's what's happening with your blood donation center.</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.donors.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-2xl transition shadow-sm">
                        <i class="fas fa-plus mr-2"></i> Add Donor
                    </a>
                    <a href="{{ route('admin.blood-groups.create') }}"
                        class="inline-flex items-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-2xl transition shadow-sm">
                        <i class="fas fa-tint mr-2"></i> Add Blood Group
                    </a>
                </div>
            </div>

            <!-- Stats Cards - 3 Cards Per Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">

                <!-- Total Donors -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Donors</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalDonors ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span class="text-green-600 text-sm font-medium">{{ $availableDonors ?? 0 }} Available</span>
                    </div>
                </div>

                <!-- Available Donors -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Available Donors</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $availableDonors ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Blood Groups -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Blood Groups</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">{{ count($bloodGroupStats ?? []) }}</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-tint text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Today's Donations -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Today's Donations</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $todayDonations ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-calendar-day text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Members -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Members</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalMembers ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-user-friends text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Council Members -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Council Team</p>
                            <p class="text-4xl font-bold text-gray-900 mt-2">{{ $totalCouncilMembers ?? 0 }}</p>
                        </div>
                        <div class="w-12 h-12 bg-rose-100 text-rose-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-users-cog text-2xl"></i>
                        </div>
                    </div>
                </div>

                <!-- Total Money Donation -->
                <div class="bg-white rounded-3xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Donation</p>
                            <p class="text-4xl font-bold text-emerald-600 mt-2">
                                ৳{{ number_format($totalDonationsAmount ?? 0) }}
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-hand-holding-dollar text-2xl"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 rounded-xl shadow">
                    <h3>Total Due</h3>
                    <p class="text-3xl font-bold">
                        ৳{{ number_format($totalDue) }}
                    </p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow">
                    <h3>This Month Collection</h3>
                    <p class="text-3xl font-bold">
                        ৳{{ number_format($paidThisMonth) }}
                    </p>
                </div>

                <div class="bg-white p-5 rounded-xl shadow">
                    <h3>Unpaid Members</h3>
                    <p class="text-3xl font-bold">
                        {{ $unpaidMembers }}
                    </p>
                </div>



            </div>

            <!-- Recent Donors + Blood Group Distribution -->
            <div class="grid lg:grid-cols-7 gap-6">
                <!-- Recent Donors -->
                <div class="lg:col-span-4 bg-white rounded-3xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-lg font-semibold">Recent Donors</h3>
                        <a href="{{ route('admin.donors.index') }}"
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                            View All <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @if ($recentDonors->isEmpty())
                        <p class="text-center text-gray-500 py-10">No recent donors yet.</p>
                    @else
                        <div class="space-y-4">
                            @foreach ($recentDonors as $donor)
                                <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-2xl transition">
                                    <div class="relative flex-shrink-0">
                                        @if ($donor->profile_photo)
                                            <img src="{{ Storage::url($donor->profile_photo) }}"
                                                class="w-12 h-12 rounded-2xl object-cover" alt="">
                                        @else
                                            <div class="w-12 h-12 bg-gray-200 rounded-2xl flex items-center justify-center">
                                                <i class="fas fa-user text-gray-500"></i>
                                            </div>
                                        @endif
                                        <div
                                            class="absolute -bottom-0.5 -right-0.5 w-4 h-4 border-2 border-white {{ $donor->availability_status === 'available' ? 'bg-green-500' : 'bg-red-500' }} rounded-full">
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium truncate">{{ $donor->full_name }}</p>
                                        <p class="text-sm text-gray-500">{{ $donor->bloodGroup->name ?? 'N/A' }} •
                                            {{ ucfirst($donor->availability_status ?? '') }}</p>
                                    </div>
                                    <a href="{{ route('admin.donors.show', $donor->id) }}"
                                        class="text-blue-600 hover:text-blue-700">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Blood Group Distribution -->
                <div class="lg:col-span-3 bg-white rounded-3xl shadow-sm p-6">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-lg font-semibold">Blood Group Distribution</h3>
                        <a href="{{ route('admin.blood-groups.index') }}"
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium">Manage</a>
                    </div>
                    @if (!empty($bloodGroupStats))
                        <div class="space-y-5">
                            @php
                                $max = max($bloodGroupStats);
                                $total = array_sum($bloodGroupStats);
                            @endphp
                            @foreach ($bloodGroupStats as $group => $count)
                                <div>
                                    <div class="flex justify-between text-sm mb-1.5">
                                        <span class="font-medium">{{ $group }}</span>
                                        <span>{{ $count }}
                                            ({{ $total ? round(($count / $total) * 100, 1) : 0 }}%)
                                        </span>
                                    </div>
                                    <div class="h-2.5 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full bg-red-500 rounded-full"
                                            style="width: {{ $max ? round(($count / $max) * 100) : 0 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 py-8">No data available</p>
                    @endif
                </div>
            </div>

            <!-- Quick Access -->
            <div class="mt-10">
                <h3 class="text-lg font-semibold mb-5">Quick Access</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                    <a href="{{ route('admin.council.index') }}"
                        class="bg-white p-5 rounded-3xl shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                        <i class="fas fa-users text-3xl text-purple-600 mb-3"></i>
                        <span class="font-medium">Council</span>
                    </a>
                    <a href="{{ route('admin.members.index') }}"
                        class="bg-white p-5 rounded-3xl shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                        <i class="fas fa-user-friends text-3xl text-indigo-600 mb-3"></i>
                        <span class="font-medium">Members</span>
                    </a>
                    <a href="{{ route('admin.donations.index') }}"
                        class="bg-white p-5 rounded-3xl shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                        <i class="fas fa-hand-holding-heart text-3xl text-red-600 mb-3"></i>
                        <span class="font-medium">Donations</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
