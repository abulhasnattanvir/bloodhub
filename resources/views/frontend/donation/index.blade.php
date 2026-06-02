@extends('layouts.frontend')

@section('content')
    <div class="max-w-5xl mx-auto py-10 px-4">

        {{-- TITLE --}}
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-2">
            Support Our Mission ❤️
        </h1>

        <p class="text-center text-gray-500 mb-8">
            Your donation helps save lives through blood support & emergency care
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
        <div class="grid md:grid-cols-3 gap-4 mb-8">

            {{-- BKASH --}}
            <div class="bg-pink-50 border border-pink-200 p-5 rounded-xl shadow-sm">
                <h2 class="text-lg font-bold text-pink-600 mb-2">
                    bKash Personal
                </h2>

                <p class="text-gray-700">
                    📱 Send Money: <span class="font-bold">01XXXXXXXXX</span>
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Reference: BloodHub Donation
                </p>
            </div>

            {{-- NAGAD --}}
            <div class="bg-orange-50 border border-orange-200 p-5 rounded-xl shadow-sm">
                <h2 class="text-lg font-bold text-orange-600 mb-2">
                    Nagad Personal
                </h2>

                <p class="text-gray-700">
                    📱 Send Money: <span class="font-bold">01XXXXXXXXX</span>
                </p>

                <p class="text-sm text-gray-500 mt-1">
                    Reference: BloodHub Donation
                </p>
            </div>

            {{-- BANK --}}
            <div class="bg-gray-50 border border-gray-200 p-5 rounded-xl shadow-sm">
                <h2 class="text-lg font-bold text-gray-700 mb-2">
                    Bank Transfer
                </h2>

                <p class="text-gray-700">
                    🏦 Account Name: <span class="font-bold">BloodHub Org</span>
                </p>

                <p class="text-gray-700">
                    💳 Account No: <span class="font-bold">1234567890</span>
                </p>

                <p class="text-gray-700">
                    🏛 Bank: Sonali Bank Ltd.
                </p>
            </div>

        </div>

        {{-- DONATION INFO MESSAGE --}}
        <div class="bg-blue-50 border border-blue-200 text-blue-800 p-5 rounded-xl mb-6">

            <h3 class="text-lg font-bold mb-2">
                📢 Important Notice
            </h3>

            <p class="text-sm leading-relaxed">
                If your donation is successfully verified and accepted by our admin team,
                your information will be published on our <b>Donation Contributors Page</b>.
                You will be able to see your latest donation there as proof that your donation has been approved.
            </p>

            <div class="mt-3">
                <a href="{{ route('donation.contributors') }}"
                    class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                    View Donation Contributors →
                </a>
            </div>

        </div>

        {{-- FORM --}}
        <div class="bg-white shadow-xl rounded-2xl p-6 md:p-10">

            <form method="POST" action="{{ route('donation.store') }}" class="space-y-5">

                @csrf

                <div class="grid md:grid-cols-2 gap-4">

                    {{-- NAME --}}
                    <div>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name"
                            class="w-full border p-3 rounded-lg
                           @error('name') border-red-500 @enderror">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Phone Number"
                            class="w-full border p-3 rounded-lg
                           @error('phone') border-red-500 @enderror">

                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- AMOUNT --}}
                <div>
                    <input type="number" name="amount" value="{{ old('amount') }}" placeholder="Donation Amount (BDT)"
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

                        <option value="">Select Payment Method</option>
                        <option value="bkash" {{ old('method') == 'bkash' ? 'selected' : '' }}>bKash</option>
                        <option value="nagad" {{ old('method') == 'nagad' ? 'selected' : '' }}>Nagad</option>
                        <option value="bank" {{ old('method') == 'bank' ? 'selected' : '' }}>Bank Transfer</option>

                    </select>

                    @error('method')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- TRANSACTION ID --}}
                <div>
                    <input type="text" name="transaction_id" value="{{ old('transaction_id') }}"
                        placeholder="Transaction ID / Reference Number"
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
                    Confirm Donation
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
