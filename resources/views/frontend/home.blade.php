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

    <!-- =========================
                                                                                                                     HERO SLIDER SECTION
                                                                                                                ========================= -->

    {{-- <section class="hero-slider-section relative overflow-hidden">

        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>

        <div class="max-w-7xl mx-auto px-4 relative z-10">

            <div class="swiper heroSlider hero-glass rounded-[35px] overflow-hidden">

                <div class="swiper-wrapper">

                    <!-- ================= SLIDE 1 ================= -->
                    <div class="swiper-slide">
                        <div class="grid lg:grid-cols-2 items-center gap-12 p-10 lg:p-16">

                            <div>
                                <span class="hero-badge px-5 py-2 rounded-full inline-flex gap-2 mb-6">
                                    <i class="fas fa-heartbeat"></i> মানব সেবা-ই আমাদের স্বপ্ন
                                </span>

                                <h1 class="hero-title mb-6">
                                    রক্ত দিন <span class="text-red-600">জীবন বাঁচান</span>
                                </h1>

                                <p class="hero-text mb-8">
                                    জরুরি রক্ত প্রয়োজন হলে দ্রুত ডোনার খুঁজুন এবং জীবন বাঁচাতে পাশে থাকুন।
                                </p>

                                <div class="flex gap-4 flex-wrap">
                                    <a href="{{ route('search') }}"
                                        class="hero-btn-primary px-8 py-4 rounded-2xl text-white font-bold">
                                        ডোনার খুঁজুন
                                    </a>
                                </div>
                            </div>

                            <div>
                                <img src="{{ asset('images/slide1.png') }}" class="hero-image mx-auto w-full max-w-lg">
                            </div>

                        </div>
                    </div>

                    <!-- ================= SLIDE 2 ================= -->
                    <div class="swiper-slide">
                        <div class="grid lg:grid-cols-2 items-center gap-12 p-10 lg:p-16">

                            <div>
                                <span class="hero-badge px-5 py-2 rounded-full inline-flex gap-2 mb-6">
                                    <i class="fas fa-users"></i> স্বেচ্ছায় রক্তদান
                                </span>

                                <h1 class="hero-title mb-6">
                                    হাজারো <span class="text-red-600">ডোনার একসাথে</span>
                                </h1>

                                <p class="hero-text mb-8">
                                    আমাদের কমিউনিটিতে যুক্ত হয়ে প্রতিদিন মানুষকে সাহায্য করুন।
                                </p>

                                <a href="{{ route('donors.list') }}"
                                    class="hero-btn-primary px-8 py-4 rounded-2xl text-white font-bold">
                                    ডোনার তালিকা
                                </a>
                            </div>

                            <div>
                                <img src="{{ asset('images/slide2.png') }}" class="hero-image mx-auto w-full max-w-lg">
                            </div>

                        </div>
                    </div>

                    <!-- ================= SLIDE 3 ================= -->
                    <div class="swiper-slide">
                        <div class="grid lg:grid-cols-2 items-center gap-12 p-10 lg:p-16">

                            <div>
                                <span class="hero-badge px-5 py-2 rounded-full inline-flex gap-2 mb-6">
                                    <i class="fas fa-hand-holding-heart"></i> মানবিক সহায়তা
                                </span>

                                <h1 class="hero-title mb-6">
                                    দরিদ্রদের পাশে <span class="text-red-600">আমরা আছি</span>
                                </h1>

                                <p class="hero-text mb-8">
                                    শীতবস্ত্র, খাদ্য ও জরুরি সহায়তা দিয়ে আমরা মানুষের পাশে দাঁড়াই।
                                </p>

                                <a href="#" class="hero-btn-primary px-8 py-4 rounded-2xl text-white font-bold">
                                    আরো জানুন
                                </a>
                            </div>

                            <div>
                                <img src="{{ asset('images/slide3.png') }}" class="hero-image mx-auto w-full max-w-lg">
                            </div>

                        </div>
                    </div>

                    <!-- ================= SLIDE 4 ================= -->
                    <div class="swiper-slide">
                        <div class="grid lg:grid-cols-2 items-center gap-12 p-10 lg:p-16">

                            <div>
                                <span class="hero-badge px-5 py-2 rounded-full inline-flex gap-2 mb-6">
                                    <i class="fas fa-graduation-cap"></i> শিক্ষা সহায়তা
                                </span>

                                <h1 class="hero-title mb-6">
                                    শিক্ষার আলো <span class="text-red-600">সবার জন্য</span>
                                </h1>

                                <p class="hero-text mb-8">
                                    দরিদ্র ও মেধাবী শিক্ষার্থীদের জন্য আমরা বিনামূল্যে সহায়তা দিই।
                                </p>

                                <a href="#" class="hero-btn-primary px-8 py-4 rounded-2xl text-white font-bold">
                                    আরও দেখুন
                                </a>
                            </div>

                            <div>
                                <img src="{{ asset('images/slide4.png') }}" class="hero-image mx-auto w-full max-w-lg">
                            </div>

                        </div>
                    </div>

                    <!-- ================= SLIDE 5 ================= -->
                    <div class="swiper-slide">
                        <div class="grid lg:grid-cols-2 items-center gap-12 p-10 lg:p-16">

                            <div>
                                <span class="hero-badge px-5 py-2 rounded-full inline-flex gap-2 mb-6">
                                    <i class="fas fa-shield-heart"></i> দুর্যোগ সহায়তা
                                </span>

                                <h1 class="hero-title mb-6">
                                    বিপদে <span class="text-red-600">আমরা পাশে</span>
                                </h1>

                                <p class="hero-text mb-8">
                                    বন্যা, ঘূর্ণিঝড় ও দুর্যোগে ক্ষতিগ্রস্ত মানুষের পাশে আমরা দাঁড়াই।
                                </p>

                                <a href="#" class="hero-btn-primary px-8 py-4 rounded-2xl text-white font-bold">
                                    সহযোগিতা করুন
                                </a>
                            </div>

                            <div>
                                <img src="{{ asset('images/slide5.png') }}" class="hero-image mx-auto w-full max-w-lg">
                            </div>

                        </div>
                    </div>

                </div>

                <!-- pagination -->
                <div class="swiper-pagination !bottom-5"></div>

            </div>

        </div>
    </section> --}}

    <!-- =========================
                                                                                                             HERO SLIDER (DYNAMIC)
                                                                                                        ========================= -->
    <section class="hero-slider-section relative py-16 lg:py-20 overflow-hidden">
        <!-- Background Shapes -->
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>

        @if ($sliders->count())
            <div class="swiper heroSlider max-w-7xl mx-auto px-4 lg:px-6 rounded-3xl overflow-hidden shadow-2xl">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">
                            <div class="grid lg:grid-cols-2 items-center gap-10 lg:gap-16 bg-white">

                                <!-- Left Content -->
                                <div class="p-8 lg:p-16 order-2 lg:order-1">
                                    @if ($slider->icon)
                                        <span
                                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-red-50 text-red-600 text-sm font-medium mb-6">
                                            <i class="{{ $slider->icon }}"></i>
                                            {{ $slider->highlight_text }}
                                        </span>
                                    @endif

                                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight text-gray-900 mb-6">
                                        {!! $slider->title !!}
                                    </h1>

                                    @if ($slider->description)
                                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                                            {{ $slider->description }}
                                        </p>
                                    @endif

                                    @if ($slider->button_text)
                                        <a href="{{ $slider->button_link }}"
                                            class="inline-block bg-gradient-to-r from-red-600 to-rose-600 text-white font-semibold px-9 py-4 rounded-2xl hover:shadow-lg hover:scale-105 transition-all duration-300">
                                            {{ $slider->button_text }}
                                        </a>
                                    @endif
                                </div>

                                <!-- Right Image -->
                                <div class="relative order-1 lg:order-2">
                                    <img src="{{ asset('storage/' . $slider->image) }}"
                                        class="w-full h-full object-cover lg:rounded-r-3xl" alt="{{ $slider->title }}">
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="swiper-pagination !bottom-6"></div>
            </div>
        @else
            <div class="text-center py-20 bg-gray-100 rounded-3xl">
                <h2 class="text-2xl font-bold text-gray-400">No Slider Found</h2>
            </div>
        @endif
    </section>


    {{-- Mission and Goals --}}
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">আমাদের লক্ষ্য ও উদ্দেশ্য</h2>
                <p class="mt-4 text-gray-600 text-lg">সমাজের উন্নয়নে আমাদের অঙ্গীকার</p>
                <div class="w-20 h-1 bg-red-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach ($goals as $goal)
                    <a href="{{ route('goals.show', $goal->id) }}"
                        class="group block p-8 bg-white border border-gray-100 rounded-3xl 
                          hover:border-red-200 hover:shadow-xl transition-all duration-300">

                        <div
                            class="w-20 h-20 flex items-center justify-center rounded-2xl 
                                bg-red-50 text-red-600 text-4xl mb-6 
                                group-hover:bg-red-600 group-hover:text-white 
                                group-hover:scale-110 transition-all duration-300">
                            <i class="fas {{ $goal->icon }}"></i>
                        </div>

                        <p class="text-gray-700 font-medium text-[17px] leading-relaxed">
                            {{ $goal->text }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Our Activities / কার্যক্রম --}}
    <section class="py-16 md:py-24 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">আমাদের কার্যক্রম</h2>
                <p class="mt-4 text-gray-600 text-lg">সমাজের উন্নয়নে আমাদের বাস্তবমুখী পদক্ষেপসমূহ</p>
                <div class="w-20 h-1 bg-red-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach ($activities as $activity)
                    <a href="{{ route('activities.show', $activity->slug) }}"
                        class="group bg-white p-7 rounded-3xl border border-gray-100 hover:border-red-200 
                          hover:shadow-xl transition-all duration-300 flex gap-5">

                        <div
                            class="w-12 h-12 flex-shrink-0 flex items-center justify-center rounded-2xl 
                                bg-red-50 text-red-600 text-3xl 
                                group-hover:bg-red-600 group-hover:text-white 
                                group-hover:scale-110 transition-all duration-300">
                            <i class="fas {{ $activity->icon }}"></i>
                        </div>

                        <p class="text-gray-700 font-medium leading-relaxed pt-1">
                            {{ $activity->text }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- stats section --}}
    <section class="py-20 bg-red-600 text-white">
        <div class="max-w-7xl mx-auto px-4">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">

                <div>
                    <h3 class="text-4xl font-bold">{{ $totalDonors ?? 0 }}</h3>
                    <p class="mt-2">মোট রক্তদাতা</p>
                </div>

                <div>
                    <h3 class="text-4xl font-bold">{{ $availableDonors ?? 0 }}</h3>
                    <p class="mt-2">উপলব্ধ রক্তদাতা</p>
                </div>

                <div>
                    <h3 class="text-4xl font-bold">12+</h3>
                    <p class="mt-2">সামাজিক কার্যক্রম</p>
                </div>

                <div>
                    <h3 class="text-4xl font-bold">100%</h3>
                    <p class="mt-2">মানবিক সেবা</p>
                </div>

            </div>
        </div>
    </section>

    <div class="space-y-4" id="faq">
        @foreach ($faqs as $faq)
            <div class="border rounded-xl bg-white dark:bg-[#1e1e1e] dark:border-gray-700 overflow-hidden">
                <button
                    class="faq-btn w-full flex justify-between items-center p-5 text-left font-semibold text-gray-800 dark:text-white">
                    <span>{{ $faq->question }}</span>
                    <span class="icon text-xl">+</span>
                </button>

                <div class="faq-content hidden px-5 pb-5 text-gray-600 dark:text-gray-300">
                    {!! nl2br(e($faq->answer)) !!}
                </div>
            </div>
        @endforeach
    </div>
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
