@extends('layouts.frontend')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-red-50 via-white to-red-50 flex items-center justify-center py-10 px-4">

        <div class="w-full max-w-3xl">

            {{-- Header --}}
            <div class="text-center mb-6">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800">
                    আমাদের ই এস ডব্লিউ (ESW) সদস্যরা
                </h1>
                <p class="text-gray-500 mt-2">
                    রক্তদাতা ও স্বেচ্ছাসেবকদের একটি শক্তিশালী নেটওয়ার্ক, যারা যেকোনো জরুরি মুহূর্তে সাহায্যের জন্য প্রস্তুত।
                </p>
            </div>

            {{-- Success --}}
            @if (session('success'))
                <div id="successMsg"
                    class="bg-green-100 border border-green-300 text-green-700 p-3 mb-5 rounded-lg shadow-sm transition">
                    {{ session('success') }}
                </div>
            @endif

            {{-- SPAM ERROR (ONLY SPECIAL ERROR) --}}
            @if ($errors->has('spam'))
                <div class="bg-red-200 border border-red-400 text-red-800 p-4 mb-5 rounded-xl shadow">
                    ⚠️ {{ $errors->first('spam') }}
                    <div class="text-sm mt-1">
                        অনুগ্রহ করে কিছু সেকেন্ড অপেক্ষা করুন, তারপর আবার চেষ্টা করুন।
                    </div>
                </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data"
                class="bg-white shadow-xl rounded-2xl p-6 md:p-10 space-y-5 border border-gray-100">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- NAME --}}
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="পূর্ণ নাম"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('name') border-red-500 @else border-gray-200 @enderror">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NAME --}}
                    <div>
                        <input type="text" name="faname" value="{{ old('faname') }}" placeholder="পিতার নাম"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('faname') border-red-500 @else border-gray-200 @enderror">

                        @error('faname')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NAME --}}
                    <div>
                        <input type="text" name="age" value="{{ old('age') }}" placeholder="বয়স"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('age') border-red-500 @else border-gray-200 @enderror">

                        @error('age')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="ফোন নম্বর"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('phone') border-red-500 @else border-gray-200 @enderror">

                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <select name="gender"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none @error('gender') border-red-500 @else border-gray-200 @enderror">

                            <option value="">জেন্ডার নির্বাচন করুন</option>

                            <option value="male" {{ old('gender', $member->gender ?? '') == 'male' ? 'selected' : '' }}>
                                পুরুষ
                            </option>

                            <option value="female"
                                {{ old('gender', $member->gender ?? '') == 'female' ? 'selected' : '' }}>
                                নারী
                            </option>

                            <option value="other" {{ old('gender', $member->gender ?? '') == 'other' ? 'selected' : '' }}>
                                অন্যান্য
                            </option>

                        </select>
                        <br>
                        @error('gender')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- PROFESSION -->
                    <div>
                        <select name="profession"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('profession') border-red-500 @else border-gray-200 @enderror">

                            <option value="">পেশা নির্বাচন করুন</option>
                            <option value="Student">শিক্ষার্থী</option>
                            <option value="Job Holder">চাকরিজীবী</option>
                            <option value="Businessman">ব্যবসায়ী</option>
                            <option value="Teacher">শিক্ষক</option>
                            <option value="Doctor">ডাক্তার</option>
                            <option value="Engineer">প্রকৌশলী</option>
                            <option value="Freelancer">ফ্রিল্যান্সার</option>
                            <option value="Government Service">সরকারি চাকরিজীবী</option>
                            <option value="Private Service">বেসরকারি চাকরিজীবী</option>
                            <option value="Housewife">গৃহিণী</option>
                            <option value="Other">অন্যান্য</option>

                        </select>

                        @error('profession')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="ইমেইল ঠিকানা"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('email') border-red-500 @else border-gray-200 @enderror">

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- BLOOD GROUP --}}
                    <div>
                        <select name="blood_group"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('blood_group') border-red-500 @else border-gray-200 @enderror">

                            <option value="">রক্তের গ্রুপ নির্বাচন করুন</option>
                            @foreach (['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
                                <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>
                                    {{ $bg }}
                                </option>
                            @endforeach
                        </select>

                        @error('blood_group')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CITY --}}
                    <div>
                        <input type="text" name="city" value="{{ old('city') }}" placeholder="শহর"
                            class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                        @error('city') border-red-500 @else border-gray-200 @enderror">

                        @error('city')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PHOTO --}}
                    <div>
                        <input type="file" name="photo" accept="image/*"
                            class="w-full p-3 rounded-xl bg-white border focus:ring-2 focus:ring-red-400 outline-none
                        @error('photo') border-red-500 @else border-gray-200 @enderror">

                        @error('photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- ADDRESS --}}
                <div>
                    <textarea name="address" rows="4" placeholder="সম্পূর্ণ ঠিকানা"
                        class="w-full p-3 rounded-xl border focus:ring-2 focus:ring-red-400 outline-none
                    @error('address') border-red-500 @else border-gray-200 @enderror">{{ old('address') }}</textarea>

                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- HONEYPOT --}}
                <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                {{-- TIME CHECK --}}
                <input type="hidden" name="form_time" value="{{ time() }}">

                {{-- SUBMIT --}}
                <button id="submitBtn" type="submit"
                    class="w-full bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold py-3 rounded-xl shadow-lg hover:from-red-700 hover:to-red-600 transition">
                    আবেদন জমা দিন
                </button>

            </form>

            <p class="text-center text-sm text-gray-400 mt-6">
                আপনার তথ্য সম্পূর্ণ নিরাপদে রাখা হবে এবং শুধুমাত্র রক্তদান সংক্রান্ত উদ্দেশ্যে ব্যবহার করা হবে।
            </p>

        </div>
    </div>

    {{-- prevent double submit --}}
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.innerText = "Submitting...";
        });
        setTimeout(() => {
            const msg = document.getElementById('successMsg');
            if (msg) {
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-10px)';
                msg.style.transition = 'all 0.5s ease';

                setTimeout(() => msg.remove(), 500);
            }
        }, 5000); // 5 seconds
    </script>
@endsection
