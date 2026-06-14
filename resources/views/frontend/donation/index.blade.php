@extends('layouts.frontend')
@php
    $settings = \App\Models\Setting::all()->pluck('value', 'key')->toArray();
@endphp
@section('content')
    <div class="max-w-5xl mx-auto py-10 px-4">

        {{-- TITLE --}}
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-2">
            আমাদের মিশনকে সমর্থন করুন ❤️
        </h1>

        <p class="text-center text-gray-500 mb-8">
            আপনার দান রক্ত সহায়তা ও জরুরি চিকিৎসার মাধ্যমে জীবন বাঁচাতে সাহায্য করে
        </p>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div id="successMsg" class="bg-green-100 border border-green-300 text-green-700 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- ERROR --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-300 text-red-700 p-3 rounded-lg mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- PAYMENT INFO CARDS --}}
        <div class="DonationInfo grid md:grid-cols-3 gap-4 mb-8">

            {{-- BKASH --}}
            <div class="bg-pink-50 border border-pink-200 p-5 rounded-xl shadow-sm">
                <h2 class="text-lg font-bold text-pink-600 mb-2">
                    বিকাশ পার্সোনাল
                </h2>

                <p class="text-gray-700">
                    📱 সেন্ড মানি: <span class="font-bold">{{ $settings['bkashNumber'] ?? '01XXXXXXXXX' }}</span>
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    রেফারেন্স: ESW ডোনেশন
                </p>
            </div>

            {{-- NAGAD --}}
            <div class="bg-orange-50 border border-orange-200 p-5 rounded-xl shadow-sm">
                <h2 class="text-lg font-bold text-orange-600 mb-2">
                    নগদ পার্সোনাল
                </h2>

                <p class="text-gray-700">
                    📱 সেন্ড মানি: <span class="font-bold">{{ $settings['nagadNumber'] ?? '01XXXXXXXXX' }}</span>
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    রেফারেন্স: ESW ডোনেশন
                </p>
            </div>

            {{-- BANK --}}
            <div class="bg-gray-50 border border-gray-200 p-5 rounded-xl shadow-sm">
                <h2 class="text-lg font-bold text-gray-700 mb-2">
                    ব্যাংক ট্রান্সফার
                </h2>

                <p class="text-gray-700">
                    🏦 অ্যাকাউন্ট নাম: <span class="font-bold">{{ $settings['accName'] ?? 'ESW ORG' }}</span>
                </p>

                <p class="text-gray-700">
                    💳 অ্যাকাউন্ট নম্বর: <span class="font-bold">{{ $settings['accNumber'] ?? '0505 XXXX XXX' }}</span>
                </p>

                <p class="text-gray-700">
                    🏛 ব্যাংক: {{ $settings['bankName'] ?? '0505 XXXX XXX' }}
                </p>
                <p class="text-gray-700">
                    🔢 রাউট নাম্বার: {{ $settings['routeNumber'] ?? '0505 458' }}
                </p>
            </div>

        </div>

        {{-- DONATION INFO MESSAGE --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-800 p-5 rounded-xl mb-6">

            <h3 class="text-lg font-bold mb-2">
                📢 গুরুত্বপূর্ণ নোটিশ
            </h3>

            <p class="text-sm leading-relaxed">
                আপনার ডোনেশন সফলভাবে ভেরিফাই ও অ্যাডমিন টিম দ্বারা গ্রহণ করা হলে,
                আপনার তথ্য আমাদের <b>ডোনেশন কন্ট্রিবিউটর পেজে</b> প্রকাশ করা হবে।
                এটি আপনার ডোনেশনের প্রমাণ হিসেবে সেখানে দেখতে পারবেন।
            </p>

            <div class="mt-3">
                <a href="{{ route('donation.contributors') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                    ডোনেশন কন্ট্রিবিউটর দেখুন →
                </a>
            </div>

        </div>

        {{-- FORM --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-10">
            <h3 class="text-lg font-bold mb-2">
                🔔 ডোনেশন পরবর্তী নির্দেশনা
            </h3>

            <p class="text-sm leading-relaxed">
                অনুগ্রহ করে নিচের ফর্মটি সঠিক তথ্য দিয়ে পূরণ করুন এবং আপনার ট্রানজেকশন আইডি অবশ্যই প্রদান করুন।
                আমাদের টিম তথ্য যাচাই করার পর আপনার ডোনেশন নিশ্চিত করা হবে এবং প্রয়োজনে আপনার নাম কন্ট্রিবিউটর তালিকায় যুক্ত
                করা হবে।
            </p>
            <form method="POST" action="{{ route('donation.store') }}" class="space-y-5">

                @csrf

                <div class="grid md:grid-cols-2 gap-4">

                    {{-- NAME --}}
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="আপনার নাম"
                            class="w-full border p-3 rounded-lg
                           @error('name') border-red-500 @enderror">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="ফোন নম্বর"
                            class="w-full border p-3 rounded-lg
                           @error('phone') border-red-500 @enderror">

                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- AMOUNT --}}
                <div>
                    <input type="number" name="amount" value="{{ old('amount') }}" placeholder="ডোনেশনের পরিমাণ (BDT)"
                        class="w-full border p-3 rounded-lg
                       @error('amount') border-red-500 @enderror">

                    @error('amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- METHOD --}}
                <div>
                    <select name="method"
                        class="w-full border p-3 rounded-lg
                        @error('method') border-red-500 @enderror">

                        <option value="">পেমেন্ট মাধ্যম নির্বাচন করুন</option>
                        <option value="bkash" {{ old('method') == 'bkash' ? 'selected' : '' }}>বিকাশ</option>
                        <option value="nagad" {{ old('method') == 'nagad' ? 'selected' : '' }}>নগদ</option>
                        <option value="bank" {{ old('method') == 'bank' ? 'selected' : '' }}>ব্যাংক ট্রান্সফার</option>

                    </select>

                    @error('method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TRANSACTION ID --}}
                <div>
                    <input type="text" name="transaction_id" value="{{ old('transaction_id') }}"
                        placeholder="লেনদেন আইডি / রেফারেন্স নম্বর"
                        class="w-full border p-3 rounded-lg
                       @error('transaction_id') border-red-500 @enderror">

                    @error('transaction_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ANTI SPAM --}}
                <input type="text" name="website" class="hidden">
                <input type="hidden" name="form_time" value="{{ time() }}">

                {{-- BUTTON --}}
                <button id="submitBtn"
                    class="w-full bg-gradient-to-r from-red-600 to-red-500 text-white py-3 rounded-lg font-semibold hover:from-red-700 hover:to-red-600 transition">
                    ডোনেশন নিশ্চিত করুন
                </button>

            </form>

        </div>

    </div>

    {{-- SUCCESS AUTO HIDE --}}
    <script>
        setTimeout(() => {
            const msg = document.getElementById('successMsg');
            if (msg) {
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-10px)';
                msg.style.transition = '0.5s';
                setTimeout(() => msg.remove(), 500);
            }
        }, 4000);
    </script>
@endsection
