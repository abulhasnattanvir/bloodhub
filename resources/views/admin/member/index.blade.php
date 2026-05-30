@extends('layouts.admin')

@section('content')
    <div class="p-6">

        <h2 class="text-2xl font-bold mb-4">Members</h2>

        <div class="bg-white p-4 rounded-xl shadow mb-4">

            <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-3">

                <!-- SEARCH -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search name, phone, email..."
                    class="border p-2 rounded">

                <!-- BLOOD GROUP -->
                <select name="blood_group" class="border p-2 rounded">
                    <option value="">All Blood</option>
                    @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                        <option value="{{ $bg }}" {{ request('blood_group') == $bg ? 'selected' : '' }}>
                            {{ $bg }}
                        </option>
                    @endforeach
                </select>

                <!-- CITY -->
                <input type="text" name="city" value="{{ request('city') }}" placeholder="City"
                    class="border p-2 rounded">

                <!-- STATUS -->
                <select name="status" class="border p-2 rounded">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>

                <!-- BUTTONS -->
                <div class="flex gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">
                        Filter
                    </button>

                    <a href="{{ route('admin.members.create') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded w-full text-center">
                        Reset
                    </a>
                </div>

            </form>
        </div>
        <div class="bg-white shadow rounded-xl overflow-hidden">

            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3">Photo</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Blood</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($members as $member)
                        <tr class="border-b">

                            <td class="p-3">
                                @if ($member->photo)
                                    <img src="{{ asset($member->photo) }}" class="w-10 h-10 rounded-full object-cover">
                                @else
                                    <span class="text-gray-400">No photo</span>
                                @endif
                            </td>

                            <td>{{ $member->name }}</td>
                            <td>{{ $member->phone }}</td>
                            <td>{{ $member->blood_group }}</td>
                            <td>{{ $member->city }}</td>

                            <td>
                                <span
                                    class="px-2 py-1 rounded text-white
                            @if ($member->status == 'approved') bg-green-500
                            @elseif($member->status == 'rejected') bg-red-500
                            @else bg-yellow-500 @endif">
                                    {{ $member->status }}
                                </span>
                            </td>

                            <td class="flex center gap-2 p-2">

                                <!-- APPROVE -->
                                <form method="POST" action="{{ route('admin.members.approve', $member->id) }}">
                                    @csrf
                                    <button class="bg-green-600 text-white px-2 py-1 rounded">
                                        Approve
                                    </button>
                                </form>

                                <!-- REJECT -->
                                <form method="POST" action="{{ route('admin.members.reject', $member->id) }}">
                                    @csrf
                                    <button class="bg-yellow-500 text-white px-2 py-1 rounded">
                                        Reject
                                    </button>
                                </form>

                                <!-- EDIT -->
                                <a href="{{ route('admin.members.edit', $member->id) }}"
                                    class="bg-blue-600 text-white px-2 py-1 rounded">
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form method="POST" action="{{ route('admin.member.destory', $member->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Are you sure?')"
                                        class="bg-red-600 text-white px-2 py-1 rounded">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <div class="mt-4">
            {{ $members->withQueryString()->links() }}
        </div>
    </div>
@endsection
