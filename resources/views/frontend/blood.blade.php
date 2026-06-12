@extends('layouts.frontend')

@section('content')
    <!-- HERO -->
    <section class="relative overflow-hidden hero-gradient py-24 bg-gray-50 dark:bg-gray-800">

        <div class="max-w-7xl mx-auto px-4">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <!-- Left -->
                <div>

                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-6">
                        <i class="fas fa-heartbeat"></i>
                        জরুরি রক্ত সহায়তা
                    </span>

                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900 mb-6">

                        বাঁচুক একটি জীবন <br>
                        <span class="text-red-600">
                            প্রতিটি রক্তবিন্দুতে
                        </span>

                    </h1>

                    <p class="text-lg text-gray-600 leading-relaxed mb-8 max-w-xl">
                        জরুরি মুহূর্তে দ্রুত যাচাইকৃত রক্তদাতা খুঁজুন এবং সহজেই যোগাযোগ করুন। আপনার এক ব্যাগ রক্ত একাধিক
                        জীবন বাঁচাতে পারে।
                    </p>

                    <div class="flex flex-wrap gap-4">

                        <a href="{{ route('search') }}"
                            class="hero-btn px-8 py-4 rounded-2xl text-white bg-red-600 shadow-xl">
                            <i class="fas fa-search mr-2"></i>
                            রক্তদান খুঁজুন
                        </a>

                        <a href="{{ route('donors.list') }}"
                            class="px-8 py-4 rounded-2xl border border-red-200 bg-white hover:bg-red-50 transition font-semibold text-gray-700">

                            <i class="fas fa-users mr-2"></i>
                            রক্তদাতাদের দেখুন
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
                                    মোট রক্তদান
                                </p>
                            </div>

                            <div class="text-center p-6 rounded-2xl bg-green-50">
                                <i class="fas fa-heart-pulse text-4xl text-green-500 mb-4"></i>

                                <h2 class="text-4xl font-extrabold text-gray-900">
                                    {{ $availableDonors }}
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    উপলব্ধ রক্তদান
                                </p>
                            </div>

                            <div class="text-center p-6 rounded-2xl bg-blue-50">
                                <i class="fas fa-shield-heart text-4xl text-blue-500 mb-4"></i>

                                <h2 class="text-4xl font-extrabold text-gray-900">
                                    85%
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    সফল রক্তের মিল
                                </p>
                            </div>

                            <div class="text-center p-6 rounded-2xl bg-yellow-50">
                                <i class="fas fa-clock text-4xl text-yellow-500 mb-4"></i>

                                <h2 class="text-4xl font-extrabold text-gray-900">
                                    24/7
                                </h2>

                                <p class="text-gray-600 mt-2">
                                    জরুরি সহায়তা
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
                    সাম্প্রতিক রক্তদাতা
                </span>

                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                    আমাদের নায়কদের সাথে পরিচিত হন
                </h2>

                <p class="text-gray-600 max-w-2xl mx-auto">
                    এই মহান মানুষগুলো রক্তদান করে অসংখ্য জীবন বাঁচাতে এগিয়ে আসছেন।
                </p>

            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach ($recentDonors as $donor)
                    <div class="glass-card rounded-3xl p-6 text-center shadow-lg">

                        <div class="flex justify-center mb-5">

                            @if ($donor->profile_photo)
                                <img src="{{ Storage::url($donor->profile_photo) }}" style="height: 180px"
                                    class="donor-image" alt="Donor">
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
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 text-center">

            <h2 class="text-3xl font-bold text-red-600 mb-3">
                রক্তদান কেন গুরুত্বপূর্ণ
            </h2>

            <p class="text-gray-600 dark:text-gray-300 mb-10">
                প্রতিটি রক্তদান সর্বোচ্চ ৩টি জীবন বাঁচাতে পারে
            </p>

            <div class="grid md:grid-cols-4 gap-6">

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-heart text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">শক্তিশালী কমিউনিটি</h3>
                    <p class="text-sm text-gray-500">জীবন বাঁচানোর একটি শক্তিশালী নেটওয়ার্ক গড়ে তুলুন</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-heartbeat text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">স্বাস্থ্যগত উপকারিতা</h3>
                    <p class="text-sm text-gray-500">রক্ত সঞ্চালন উন্নত করে</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-bullseye text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">জীবন রক্ষাকারী</h3>
                    <p class="text-sm text-gray-500">একটি রক্তদান ৩টি জীবন বাঁচাতে পারে</p>
                </div>

                <div class="p-6 bg-white dark:bg-gray-900 rounded-xl shadow">
                    <i class="fas fa-globe text-red-500 text-3xl mb-3"></i>
                    <h3 class="font-bold">বিশ্বব্যাপী প্রভাব</h3>
                    <p class="text-sm text-gray-500">বিশ্বজুড়ে মানুষের সাহায্য করুন</p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 bg-red-600 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">

            <h2 class="text-3xl font-bold mb-10">রক্তদানের নির্দেশিকা</h2>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold">১৮+</h3>
                    <p>ন্যূনতম বয়স</p>
                </div>

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold">৫০ কেজি</h3>
                    <p>ন্যূনতম ওজন</p>
                </div>

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold">৩ মাস</h3>
                    <p>প্রতিটি রক্তদানের মধ্যে বিরতি</p>
                </div>

                <div class="bg-white/10 p-6 rounded-xl">
                    <h3 class="text-2xl font-bold"> ৪৫০ মিলিলিটার </h3>
                    <p>প্রতি রক্তদান</p>
                </div>

            </div>
        </div>
    </section>


    @if (isset($faqs))
        <!-- FAQ SECTION -->
        <section class="py-20 bg-white dark:bg-[#121212] transition">
            <div class="max-w-5xl mx-auto px-4">

                <div class="text-center mb-14">
                    <span class="inline-block px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-4">
                        এফ এ কিউ
                    </span>

                    <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white mb-4">
                        প্রায়শই জিজ্ঞাসিত প্রশ্ন
                    </h2>

                    <p class="text-gray-600 dark:text-gray-300">
                        রক্তদান সম্পর্কিত সাধারণ প্রশ্নগুলোর সহজ উত্তর
                    </p>
                </div>

                <!-- Dynamic FAQ ITEMS -->
                <div class="space-y-4" id="faq">
                    @forelse($faqs as $faq)
                        <div class="border rounded-xl bg-white dark:bg-[#1e1e1e] dark:border-gray-700 overflow-hidden">
                            <button
                                class="faq-btn w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 dark:text-white hover:bg-red-50 dark:hover:bg-gray-800 transition-colors">
                                <span>{{ $faq->question }}</span>
                                <span class="icon text-2xl transition-transform duration-300">+</span>
                            </button>

                            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out px-5">
                                <div class="pt-0 pb-5 text-gray-600 dark:text-gray-300">
                                    {!! nl2br(e($faq->answer)) !!}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 text-gray-500">
                            এই মুহূর্তে কোনো প্রশ্নোত্তর (এফ এ কিউ) পাওয়া যায়নি।
                        </div>
                    @endforelse
                </div>

            </div>
        </section>
    @endif

@endsection
