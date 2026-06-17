@extends('layouts.frontend')

@section('content')
    <style>
        .about-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.65), rgba(0, 0, 0, 0.65)),
                url('{{ asset('assets/images/about-bg.jpg') }}') center/cover no-repeat;
            /* আপনার ইমেজ যোগ করুন */
        }

        .objective-card {
            transition: all 0.3s ease;
        }

        .objective-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
        }
    </style>

    <!-- HERO SECTION -->
    <section class="about-hero py-24 md:py-32 text-white">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <span class="inline-block px-6 py-2.5 bg-white/20 backdrop-blur-md rounded-full text-sm font-semibold mb-6">
                Educare Society Welfare (ESW)
            </span>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                মানব সেবাই আমাদের স্বপ্ন
            </h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto opacity-90">
                “রক্তে অর্জিত বাংলার মাটি মানব সেবায় করবো ঘাঁটি”
            </p>
        </div>
    </section>

    <!-- ABOUT ORGANIZATION -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">আমাদের সম্পর্কে</h2>
                    <p class="text-gray-600 leading-relaxed text-lg mb-6">
                        এডুকেয়ার গ্রুপ অফ সোসাইটি ওয়েলফেয়ার (ESW) একটি অরাজনৈতিক, সেবামূলক সংগঠন।
                        ২০১৮ সালে নোয়াখালী জেলার দক্ষিণ নাজিরপুর, অশ্বদিয়া এলাকায় কিছু শিক্ষিত তরুণদের উদ্যোগে প্রতিষ্ঠিত
                        হয়।
                    </p>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        আমরা শিক্ষা, স্বাস্থ্য, দুর্যোগ ব্যবস্থাপনা এবং সমাজসেবামূলক কাজের মাধ্যমে সমাজের পিছিয়ে পড়া
                        মানুষের পাশে দাঁড়াই।
                    </p>
                </div>
                <div class="bg-red-50 p-8 rounded-3xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center text-3xl">📍</div>
                        <div>
                            <p class="font-semibold">স্থাপিত</p>
                            <p class="text-3xl font-bold text-red-600">২০১৮</p>
                        </div>
                    </div>
                    <p class="text-gray-700">নোয়াখালী সদর, দক্ষিণ নাজিরপুর, অশ্বদিয়া</p>
                </div>
            </div>
        </div>
    </section>

    <!-- VISION & MISSION -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-10">
                <div class="bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl font-bold mb-4 text-red-600">আমাদের স্বপ্ন</h3>
                    <p class="text-gray-700 leading-relaxed">"মানব সেবাই আমাদের স্বপ্ন"</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl font-bold mb-4 text-red-600">আমাদের লক্ষ্য</h3>
                    <p class="text-gray-700 leading-relaxed">একটি সুস্থ, শিক্ষিত ও সচেতন সমাজ গঠন করা।</p>
                </div>
            </div>
        </div>
    </section>

    <!-- OBJECTIVES -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-14">
                <span class="px-5 py-2 bg-red-100 text-red-600 rounded-full font-semibold">আমাদের লক্ষ্য ও উদ্দেশ্য</span>
                <h2 class="text-4xl font-bold mt-4">সংগঠনের প্রধান কার্যক্রম</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach (['মেধাবী ও দরিদ্র শিক্ষার্থীদের মধ্যে বৃত্তি ও শিক্ষা উপকরণ বিতরণ', 'বিনামূল্যে স্বেচ্ছায় রক্তদান কর্মসূচি', 'বাল্যবিবাহ ও যৌতুক প্রথা প্রতিরোধ', 'দুর্যোগকালীন সহায়তা (বন্যা, ঘূর্ণিঝড়, মহামারী)', 'শীতবস্ত্র ও ঈদ সামগ্রী বিতরণ', 'মাদক ও অপরাধ প্রতিরোধে সচেতনতা', 'আধুনিক প্রযুক্তি শিক্ষা প্রদান', 'সমাজে মমত্ববোধ ও সামাজিক সম্প্রীতি সৃষ্টি'] as $objective)
                    <div class="objective-card bg-white border border-gray-100 p-6 rounded-3xl hover:border-red-200">
                        <div class="flex gap-4">
                            <span class="text-red-500 text-2xl mt-1">✓</span>
                            <p class="text-gray-700 leading-relaxed">{{ $objective }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION -->
    <section class="py-16 bg-red-600 text-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">আমাদের সাথে যোগ দিন</h2>
            <p class="text-red-100 mb-8 text-lg">আপনিও এই মানব সেবামূলক যাত্রায় অংশগ্রহণ করুন</p>

            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('member.create') }}"
                    class="px-10 py-4 bg-white text-red-600 font-bold rounded-2xl hover:bg-gray-100 transition">
                    সদস্য হোন
                </a>
                <a href="{{ route('contact') }}"
                    class="px-10 py-4 border border-white font-bold rounded-2xl hover:bg-white/10 transition">
                    যোগাযোগ করুন
                </a>
            </div>
        </div>
    </section>
@endsection
