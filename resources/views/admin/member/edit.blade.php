@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto p-6">

        <h2 class="text-2xl font-bold mb-4">Edit Member</h2>

        <form method="POST" action="{{ route('admin.members.update', $member->id) }}" enctype="multipart/form-data"
            class="bg-white shadow rounded-xl p-6 space-y-4">

            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $member->name }}" class="w-full border p-2 rounded"
                placeholder="Name">

            <input type="text" name="phone" value="{{ $member->phone }}" class="w-full border p-2 rounded"
                placeholder="Phone">

            <input type="email" name="email" value="{{ $member->email }}" class="w-full border p-2 rounded"
                placeholder="Email">

            <select name="blood_group" class="w-full border p-2 rounded">
                <option value="">Select Blood Group</option>
                @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                    <option value="{{ $bg }}" {{ $member->blood_group == $bg ? 'selected' : '' }}>
                        {{ $bg }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="city" value="{{ $member->city }}" class="w-full border p-2 rounded"
                placeholder="City">

            <textarea name="address" class="w-full border p-2 rounded" placeholder="Address">{{ $member->address }}</textarea>

            <!-- STATUS -->
            <select name="status" class="w-full border p-2 rounded">
                <option value="pending" {{ $member->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $member->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $member->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>

            <!-- PHOTO -->
            <div>
                <label class="font-semibold">Photo</label><br>

                @if ($member->photo)
                    <img src="{{ asset($member->photo) }}" class="w-16 h-16 rounded-full mb-2 object-cover">
                @endif

                <input type="file" name="photo" class="w-full border p-2 rounded">
            </div>

            <button class="bg-blue-600 text-white w-full py-2 rounded">
                Update Member
            </button>

        </form>
    </div>
@endsection
