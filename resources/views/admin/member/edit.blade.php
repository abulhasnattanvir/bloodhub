@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto p-6">

        {{-- Page Header --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                Edit Member
            </h1>
            <p class="text-gray-500 mt-1">
                Update donor information and account status.
            </p>
        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.members.update', $member->id) }}" enctype="multipart/form-data"
            class="bg-white shadow-xl rounded-2xl border border-gray-100 overflow-hidden">

            @csrf
            @method('PUT')

            {{-- Top Section --}}
            <div class="p-6 border-b bg-gradient-to-r from-red-50 to-white">

                <div class="flex flex-col md:flex-row items-center gap-6">

                    {{-- Photo --}}
                    <div class="flex-shrink-0">

                        @if ($member->photo)
                            <img src="{{ asset($member->photo) }}"
                                class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        @else
                            <div
                                class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                                No Photo
                            </div>
                        @endif

                    </div>

                    {{-- Upload --}}
                    <div class="flex-1 w-full">

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Profile Photo
                        </label>

                        <input type="file" name="photo" accept="image/*"
                            class="w-full border border-gray-300 rounded-xl p-3">

                        <p class="text-xs text-gray-500 mt-2">
                            JPG, JPEG, PNG. Max size 2MB.
                        </p>

                    </div>

                </div>

            </div>

            {{-- Form Body --}}
            <div class="p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- Name --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Full Name *
                        </label>

                        <input type="text" name="name" value="{{ old('name', $member->name) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Father Name
                        </label>

                        <input type="text" name="faname" value="{{ old('name', $member->faname) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Age
                        </label>

                        <input type="text" name="age" value="{{ old('age', $member->age) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Phone Number *
                        </label>

                        <input type="text" name="phone" value="{{ old('phone', $member->phone) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', $member->email) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400 focus:border-red-400">
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Gender *
                        </label>

                        <select name="gender"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400">

                            <option value="">Select Gender</option>

                            <option value="male" {{ old('gender', $member->gender) == 'male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="female" {{ old('gender', $member->gender) == 'female' ? 'selected' : '' }}>
                                Female
                            </option>

                            <option value="other" {{ old('gender', $member->gender) == 'other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>
                    </div>

                    {{-- Profession --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Profession
                        </label>

                        <select name="profession"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400">

                            <option value="">Select Profession</option>

                            @foreach (['Student', 'Job Holder', 'Businessman', 'Teacher', 'Doctor', 'Engineer', 'Freelancer', 'Government Service', 'Private Service', 'Housewife', 'Other'] as $profession)
                                <option value="{{ $profession }}"
                                    {{ old('profession', $member->profession) == $profession ? 'selected' : '' }}>
                                    {{ $profession }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- Blood Group --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Blood Group
                        </label>

                        <select name="blood_group"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400">

                            <option value="">Select Blood Group</option>

                            @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                                <option value="{{ $bg }}"
                                    {{ old('blood_group', $member->blood_group) == $bg ? 'selected' : '' }}>
                                    {{ $bg }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    {{-- City --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            City
                        </label>

                        <input type="text" name="city" value="{{ old('city', $member->city) }}"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block mb-2 font-medium text-gray-700">
                            Status
                        </label>

                        <select name="status"
                            class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400">

                            <option value="pending" {{ old('status', $member->status) == 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="approved" {{ old('status', $member->status) == 'approved' ? 'selected' : '' }}>
                                Approved
                            </option>

                            <option value="rejected" {{ old('status', $member->status) == 'rejected' ? 'selected' : '' }}>
                                Rejected
                            </option>

                        </select>
                    </div>

                </div>

                {{-- Address --}}
                <div class="mt-5">

                    <label class="block mb-2 font-medium text-gray-700">
                        Address
                    </label>

                    <textarea name="address" rows="4"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:ring-2 focus:ring-red-400">{{ old('address', $member->address) }}</textarea>

                </div>
                {{-- Fee Applicable --}}
                <div class="flex items-center mt-6 md:mt-0">
                    {{-- hidden fallback (ensures 0 is sent when unchecked) --}}
                    <input type="hidden" required name="fee_applicable" value="0">

                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" name="fee_applicable" value="1"
                            class="w-5 h-5 text-red-600 border-gray-300 rounded focus:ring-red-500"
                            {{ old('fee_applicable', $member->fee_applicable) == 1 ? 'checked' : '' }}>

                        <span class="text-gray-700 font-medium">
                            Fee Applicable
                        </span>
                    </label>
                </div>

            </div>

            {{-- Footer --}}
            <div class="bg-gray-50 border-t p-6">

                <div class="flex flex-col md:flex-row gap-3 justify-end">

                    <a href="{{ route('admin.members.index') }}"
                        class="px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 text-center">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold shadow-lg hover:from-red-700 hover:to-red-600 transition">
                        Update Member
                    </button>

                </div>

            </div>

        </form>
    </div>
@endsection
