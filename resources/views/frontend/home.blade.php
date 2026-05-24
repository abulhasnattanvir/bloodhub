@extends('layouts.frontend')

@section('content')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .hero-gradient {
            background:
                radial-gradient(circle at top left, rgba(239, 68, 68, 0.25), transparent 40%),
                radial-gradient(circle at bottom right, rgba(220, 38, 38, 0.2), transparent 40%),
                linear-gradient(to right, #fff5f5, #ffffff);
        }

        .blood-badge {
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 700;
        }

        .donor-image {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 9999px;
            border: 4px solid rgba(220, 38, 38, 0.1);
        }

        .hero-btn {
            background: linear-gradient(to right, #dc2626, #ef4444);
            transition: all 0.3s ease;
        }

        .hero-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(220, 38, 38, 0.3);
        }

        body.dark-mode .glass-card {
            background: rgba(30, 30, 30, 0.95);
            color: #f3f4f6;
        }
    </style>

    <!-- HERO -->
    <section class="relative overflow-hidden hero-gradient py-24">

        <div class="max-w-7xl mx-auto px-4">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <!-- Left -->
                <div>

                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-6">
                        <i class="fas fa-heartbeat"></i>
                        {{ __('app.emergency_blood_support') }}
                    </span>

                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900 mb-6">

                        {{ __('app.save_lives') }} <br>
                        <span class="text-red-600">
                            {{ __('app.every_drop') }}
                        </span>

                    </h1>

                    <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-xl">

                        {{ __('app.hero_description') }}

                    </p>

                    <div class="flex flex-wrap gap-4">

                        <a href="{{ route('search') }}"
                            class="hero-btn px-8 py-4 rounded-2xl text-white font-bold shadow-xl">

                            <i class="fas fa-search mr-2"></i>
                            {{ __('app.search_donors') }}
                        </a>

                        <a href="{{ route('donors.list') }}"
                            class="px-8 py-4 rounded-2xl border border-red-200 bg-white hover:bg-red-50 transition font-semibold text-gray-700">

                            <i class="fas fa-users mr-2"></i>
                            {{ __('app.view_donor_btn') }}
                        </a>

                    </div>

                </div>

                <!-- Right -->
                <div class="relative">

                    <div class="glass-card rounded-[30px] p-10 shadow-2xl">

                        <div class="grid grid-cols-2 gap-6">

                            <div class="text-center p-6 rounded-2xl bg-red-50">
                                <i class="fas fa-users text-4xl text-red-500 mb-4"></i>

                                <h2 class="text-4xl font-extrabold text-gray-900">
                                    {{ $totalDonors }}
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    {{ __('app.total_donors') }}
                                </p>
                            </div>

                            <div class="text-center p-6 rounded-2xl bg-green-50">
                                <i class="fas fa-heart-pulse text-4xl text-green-500 mb-4"></i>

                                <h2 class="text-4xl font-extrabold text-gray-900">
                                    {{ $availableDonors }}
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    {{ __('app.available_donors') }}
                                </p>
                            </div>

                            <div class="text-center p-6 rounded-2xl bg-blue-50">
                                <i class="fas fa-shield-heart text-4xl text-blue-500 mb-4"></i>

                                <h2 class="text-4xl font-extrabold text-gray-900">
                                    85%
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    {{ __('app.match_success') }}
                                </p>
                            </div>

                            <div class="text-center p-6 rounded-2xl bg-yellow-50">
                                <i class="fas fa-clock text-4xl text-yellow-500 mb-4"></i>

                                <h2 class="text-4xl font-extrabold text-gray-900">
                                    24/7
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    {{ __('app.emergency_support') }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- RECENT DONORS -->
    <section class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-14">

                <span class="inline-block px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-4">
                    {{ __('app.recent_donors') }}
                </span>

                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                    {{ __('app.meet_our_heroes') }}
                </h2>

                <p class="text-gray-600 max-w-2xl mx-auto">
                    These amazing people are helping save lives through blood donation.
                </p>

            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach ($recentDonors as $donor)
                    <div class="glass-card rounded-3xl p-6 text-center shadow-lg">

                        <div class="flex justify-center mb-5">

                            @if ($donor->profile_photo)
                                <img src="{{ Storage::url($donor->profile_photo) }}" class="donor-image" alt="Donor">
                            @else
                                <div class="donor-image bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-user text-3xl text-gray-400"></i>
                                </div>
                            @endif

                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-2">
                            {{ $donor->full_name }}
                        </h3>

                        <span
                            class="blood-badge
                        {{ str_contains($donor->bloodGroup->name, 'A') ? 'bg-red-100 text-red-600' : '' }}
                        {{ str_contains($donor->bloodGroup->name, 'B') ? 'bg-green-100 text-green-600' : '' }}
                        {{ str_contains($donor->bloodGroup->name, 'O') ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ str_contains($donor->bloodGroup->name, 'AB') ? 'bg-blue-100 text-blue-600' : '' }}
                    ">
                            {{ $donor->bloodGroup->name }}
                        </span>

                        <p class="text-gray-500 mt-4 text-sm">
                            <i class="fas fa-phone-alt mr-2"></i>
                            {{ $donor->phone_number }}
                        </p>

                        <div class="mt-5">

                            @if ($donor->availability_status === 'available')
                                <span class="px-4 py-2 rounded-full bg-green-100 text-green-700 text-sm font-semibold">
                                    Available
                                </span>
                            @else
                                <span class="px-4 py-2 rounded-full bg-gray-100 text-gray-600 text-sm font-semibold">
                                    Not Available
                                </span>
                            @endif

                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

    <section class="py-16 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">

            <h2 class="text-3xl font-bold text-center text-red-600 mb-10">
                Donors by Blood Group
            </h2>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-4 text-center">

                @foreach ($bloodGroups ?? [] as $group)
                    <div class="p-4 rounded-xl shadow bg-red-50 dark:bg-gray-800">
                        <h3 class="text-xl font-bold text-red-600">
                            {{ $group->name }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300">
                            {{ $group->donors_count ?? 0 }}
                        </p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 text-center">

            <h2 class="text-3xl font-bold text-red-600 mb-3">
                Why Blood Donation Matters
            </h2>

            <p class="text-gray-600 dark:text-gray-300 mb-10">
                Every donation can save up to 3 lives
            </p>

            <div class="grid md:grid-cols-4 gap-6">

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-heart text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">Strong Community</h3>
                    <p class="text-sm text-gray-500">Build a life-saving network</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-heartbeat text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">Health Benefits</h3>
                    <p class="text-sm text-gray-500">Improves blood circulation</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-bullseye text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">Life Saving</h3>
                    <p class="text-sm text-gray-500">One donation saves 3 lives</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-globe text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">Global Impact</h3>
                    <p class="text-sm text-gray-500">Help people worldwide</p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 bg-red-600 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">

            <h2 class="text-3xl font-bold mb-10">Blood Donation Guidelines</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold">18+</h3>
                    <p>Age Requirement</p>
                </div>

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold">50kg</h3>
                    <p>Minimum Weight</p>
                </div>

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold">3</h3>
                    <p>Months Between Donation</p>
                </div>

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold">450ml</h3>
                    <p>Per Donation</p>
                </div>

            </div>
        </div>
    </section>


    <!-- HOW IT WORKS -->
    <section class="py-20 bg-gray-50">

        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-14">

                <span class="inline-block px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-4">
                    Simple Process
                </span>

                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                    How It Works
                </h2>

            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <!-- Step 1 -->
                <div class="glass-card rounded-3xl p-10 text-center">

                    <div
                        class="w-20 h-20 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-3xl"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Search
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Find blood donors by blood group, location, and availability instantly.
                    </p>

                </div>

                <!-- Step 2 -->
                <div class="glass-card rounded-3xl p-10 text-center">

                    <div
                        class="w-20 h-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-hand-holding-heart text-3xl"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Connect
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Contact available donors directly through the platform securely.
                    </p>

                </div>

                <!-- Step 3 -->
                <div class="glass-card rounded-3xl p-10 text-center">

                    <div
                        class="w-20 h-20 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-3xl"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Save Lives
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Every blood donation can help save multiple precious lives.
                    </p>

                </div>

            </div>

        </div>

    </section>

    <!-- FAQ SECTION -->
    <section class="py-20 bg-white dark:bg-[#121212] transition">

        <div class="max-w-5xl mx-auto px-4">

            <div class="text-center mb-14">
                <span class="inline-block px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-4">
                    FAQ
                </span>

                <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                    Frequently Asked Questions
                </h2>

                <p class="text-gray-600 dark:text-gray-300">
                    Quick answers to common questions about blood donation
                </p>
            </div>

            <!-- FAQ ITEMS -->
            <div class="space-y-4" id="faq">

                <!-- ITEM 1 -->
                <div class="border rounded-xl bg-white dark:bg-[#1e1e1e] dark:border-gray-700 overflow-hidden">

                    <button
                        class="faq-btn w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 dark:text-white">

                        <span>How often can I donate blood?</span>

                        <span class="icon text-xl">+</span>

                    </button>

                    <div class="faq-content hidden px-5 pb-5 text-gray-600 dark:text-gray-300">
                        You can donate whole blood every 3 months (90 days) safely.
                    </div>
                </div>

                <!-- ITEM 2 -->
                <div class="border rounded-xl bg-white dark:bg-[#1e1e1e] dark:border-gray-700 overflow-hidden">

                    <button
                        class="faq-btn w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 dark:text-white">

                        <span>Who can donate blood?</span>

                        <span class="icon text-xl">+</span>

                    </button>

                    <div class="faq-content hidden px-5 pb-5 text-gray-600 dark:text-gray-300">
                        Anyone aged 18+ with good health and minimum required weight can donate.
                    </div>
                </div>

                <!-- ITEM 3 -->
                <div class="border rounded-xl bg-white dark:bg-[#1e1e1e] dark:border-gray-700 overflow-hidden">

                    <button
                        class="faq-btn w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 dark:text-white">

                        <span>Is blood donation safe?</span>

                        <span class="icon text-xl">+</span>

                    </button>

                    <div class="faq-content hidden px-5 pb-5 text-gray-600 dark:text-gray-300">
                        Yes, it is completely safe. New sterile equipment is used for every donor.
                    </div>
                </div>

                <!-- ITEM 4 -->
                <div class="border rounded-xl bg-white dark:bg-[#1e1e1e] dark:border-gray-700 overflow-hidden">

                    <button
                        class="faq-btn w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 dark:text-white">

                        <span>What should I do after donating blood?</span>

                        <span class="icon text-xl">+</span>

                    </button>

                    <div class="faq-content hidden px-5 pb-5 text-gray-600 dark:text-gray-300">
                        Rest, drink water, and avoid heavy exercise for 24 hours.
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const buttons = document.querySelectorAll(".faq-btn");

            buttons.forEach((btn) => {
                btn.addEventListener("click", function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector(".icon");

                    content.classList.toggle("hidden");

                    if (content.classList.contains("hidden")) {
                        icon.textContent = "+";
                    } else {
                        icon.textContent = "−";
                    }

                    buttons.forEach((otherBtn) => {
                        if (otherBtn !== btn) {
                            otherBtn.nextElementSibling.classList.add("hidden");
                            otherBtn.querySelector(".icon").textContent = "+";
                        }
                    });
                });
            });
        });
    </script>
@endpush
