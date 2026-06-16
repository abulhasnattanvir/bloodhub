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

    <section class="hero-slider-section py-4 px-4 sm:py-10 lg:pt-15 lg:py-20 relative overflow-hidden">
        <!-- Background Shapes -->
        <div class="hero-shape hero-shape-1"></div>
        <div class="hero-shape hero-shape-2"></div>

        @if ($sliders->count())
            <div class="swiper heroSlider max-w-7xl mx-auto px-4 lg:px-6 rounded-3xl overflow-hidden shadow-2xl">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">
                            <div class="grid lg:grid-cols-2 items-center gap-5 lg:gap-16 bg-white">

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
                                        <p class="text-lg text-gray-600 mb-4 lg:mb-8 leading-relaxed">
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
                                <div class="relative order-1 lg:order-2" style="height:100%;">
                                    @if ($slider->image)
                                        <img src="{{ asset('storage/' . $slider->image) }}"
                                            class="w-full h-full object-cover lg:rounded-r-3xl" alt="photo">
                                    @endif
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
                <h2 class="text-2xl font-bold text-gray-400">🎞️ কোনো স্লাইডার পাওয়া যায়নি</h2>
            </div>
        @endif
    </section>

    @if ($announcements->count())
        <section class="bg-red-600 text-white overflow-hidden">
            <div class="flex items-center h-12">

                <!-- Label -->
                <div class="shrink-0 bg-red-800 px-4 h-full flex items-center font-semibold">
                    📢 ঘোষণা
                </div>

                <!-- Scrolling Area -->
                <div class="relative flex-1 overflow-hidden">

                    <div id="ticker-track" class="flex flex-nowrap items-center whitespace-nowrap gap-16 py-3 shrink-0">

                        @for ($i = 0; $i < 4; $i++)
                            @foreach ($announcements as $announcement)
                                @if ($announcement->url)
                                    <a href="{{ $announcement->url }}"
                                        class="shrink-0 font-medium hover:text-yellow-300 transition">
                                        {{ $announcement->title }}
                                    </a>
                                @else
                                    <span class="shrink-0">
                                        {{ $announcement->title }}
                                    </span>
                                @endif
                            @endforeach
                        @endfor

                    </div>

                </div>

            </div>
        </section>
    @endif
    <!-- Donation Section - Tailwind CSS -->
    {{-- <section class="bg-gradient-to-r from-red-500 to-rose-500 py-8 shadow-lg">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                <!-- Text Content -->
                <div class="text-white">
                    <h3 class="text-2xl md:text-3xl font-bold mb-2">
                        সাহায্যের হাত বাড়িয়ে দিন
                    </h3>
                    <p class="text-lg opacity-95">
                        আপনার ছোট অনুদানও অনেক বড় পরিবর্তন আনতে পারে
                    </p>
                </div>

                <!-- Donate Button -->
                <div>
                    <a href="{{ route('member.create') }}"
                        class="group flex items-center gap-3 bg-white text-red-600 hover:text-red-700 px-8 py-4 rounded-full font-semibold text-xl shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                        <span>ডোনেশন করুন</span>
                        <span class="text-2xl group-hover:scale-125 transition-transform">❤️</span>
                    </a>
                </div>

            </div>
        </div>
    </section> --}}

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

    {{-- Dynamic Green Initiative Section --}}
    <section class="py-16 md:py-24 bg-emerald-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14">
                <span
                    class="inline-flex items-center gap-2 px-6 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold mb-4">
                    <i class="fas fa-leaf"></i> পরিবেশ সুরক্ষা
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">সবুজ উদ্যোগ</h2>
                <p class="mt-4 text-gray-600 text-lg max-w-2xl mx-auto">
                    আমরা পরিবেশ রক্ষা ও সবুজায়নের জন্য নিয়মিত কাজ করে যাচ্ছি
                </p>
                <div class="w-20 h-1 bg-emerald-600 mx-auto mt-6 rounded-full"></div>
            </div>

            @if ($greenInitiatives->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($greenInitiatives as $item)
                        <div
                            class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                            <div class="h-56 bg-emerald-100 relative overflow-hidden">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        alt="{{ $item->title }}">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center">
                                        <i class="fas fa-tree text-7xl text-white/80"></i>
                                    </div>
                                @endif>
                            </div>
                            <div class="p-7">
                                <h3 class="text-xl font-semibold text-gray-800 mb-3">{{ $item->title }}</h3>
                                <p class="text-gray-600 leading-relaxed line-clamp-4">{{ $item->description }}</p>

                                @if ($item->date || $item->location)
                                    <div class="mt-4 pt-4 border-t text-xs text-gray-500 flex gap-4">
                                        @if ($item->date)
                                            <span><i class="fas fa-calendar"></i>
                                                {{ $item->date->format('d M, Y') }}</span>
                                        @endif
                                        @if ($item->location)
                                            <span><i class="fas fa-map-marker-alt"></i> {{ $item->location }}</span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-emerald-200">
                    <i class="fas fa-leaf text-6xl text-emerald-200 mb-4"></i>
                    <p class="text-gray-500">কোনো সবুজ উদ্যোগ এখনো যোগ করা হয়নি।</p>
                </div>
            @endif
        </div>
    </section>

    {{-- Dynamic Video Section --}}
    <section class="py-16 md:py-24 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <span
                    class="inline-flex items-center gap-2 px-5 py-2 bg-red-600/20 text-red-400 rounded-full text-sm font-medium mb-4">
                    <i class="fas fa-video"></i> ভিডিও গ্যালারি
                </span>
                <h2 class="text-3xl md:text-4xl font-bold">আমাদের কার্যক্রমের ভিডিও</h2>
            </div>

            @if ($videos->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($videos as $video)
                        <div class="bg-gray-800 rounded-3xl overflow-hidden hover:shadow-2xl transition-all">
                            <div class="relative aspect-video">
                                @if (str_contains($video->url, 'youtube.com') || str_contains($video->url, 'youtu.be'))
                                    <iframe src="{{ $video->embed_url }}" class="w-full h-full rounded-t-3xl"
                                        frameborder="0" allowfullscreen
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        title="{{ $video->title }}">
                                    </iframe>
                                @else
                                    <video controls class="w-full h-full rounded-t-3xl">
                                        <source src="{{ asset('storage/' . $video->url) }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="font-semibold text-lg mb-1">{{ $video->title }}</h3>
                                @if ($video->description)
                                    <p class="text-gray-400 text-sm line-clamp-3">{{ $video->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Watch More Button -->
                <div class="text-center mt-12">
                    <a href="https://www.youtube.com/@YOUR_CHANNEL" target="_blank"
                        class="inline-flex items-center gap-3 bg-red-600 hover:bg-red-700 transition-all duration-300 text-white font-semibold text-lg px-10 py-5 rounded-3xl shadow-lg shadow-red-900/50">
                        <i class="fab fa-youtube text-2xl"></i>
                        <span>ইউটিউবে আরও ভিডিও দেখুন</span>
                    </a>
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-video text-6xl text-gray-700 mb-4"></i>
                    <p class="text-gray-400">কোনো ভিডিও এখনো যোগ করা হয়নি।</p>
                </div>
            @endif
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-12">

        <!-- Hero -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-4">সংবাদ ও কার্যক্রম</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                আমাদের সংগঠনের সর্বশেষ সংবাদ, সচেতনতামূলক লেখা, কার্যক্রমের আপডেট এবং অনুপ্রেরণামূলক গল্প পড়ুন।
            </p>
        </div>

        <!-- Featured Post -->
        @if ($posts->count() > 0)
            @php $featured = $posts->first(); @endphp
            <div class="mb-16">
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden grid md:grid-cols-2 gap-8 items-center">
                    @if ($featured->featured_image)
                        <img src="{{ Storage::url($featured->featured_image) }}" alt="{{ $featured->title }}"
                            class="w-full h-full object-cover md:h-[420px]">
                    @else
                        <div
                            class="bg-gradient-to-br from-blue-500 to-indigo-600 h-[420px] flex items-center justify-center text-7xl">
                            📝</div>
                    @endif

                    <div class="p-10">
                        @if ($featured->category)
                            <span
                                class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-medium mb-4">
                                {{ $featured->category->name }}
                            </span>
                        @endif

                        <h2 class="text-3xl font-semibold leading-tight mb-6">
                            <a href="{{ route('blog.show', $featured->slug) }}"
                                class="hover:text-blue-600 transition-colors">
                                {{ $featured->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 text-lg mb-8 line-clamp-4">{{ $featured->excerpt }}</p>

                        <a href="{{ route('blog.show', $featured->slug) }}"
                            class="inline-flex items-center gap-2 text-blue-600 font-medium hover:text-blue-700">
                            Read Full Article →
                        </a>
                    </div>
                </div>
            </div>
        @endif

        <!-- Latest Articles Header -->
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-semibold">সাম্প্রতিক লেখা</h2>
            <!-- Simple Archive Button -->
            <a href="{{ route('blog.index') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-2xl hover:bg-gray-800 transition font-medium">
                <span>সমস্ত আর্কাইভ দেখুন</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </a>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="posts-grid">
            @foreach ($posts->skip(1) as $post)
                <div
                    class="group bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    @if ($post->featured_image)
                        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                            class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif

                    <div class="p-6">
                        @if ($post->category)
                            <span class="text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                                {{ $post->category->name }}
                            </span>
                        @endif

                        <h3 class="font-semibold text-xl mt-4 mb-3 line-clamp-2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600 transition">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-gray-600 line-clamp-3 mb-6">{{ $post->excerpt }}</p>

                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">{{ $post->published_at?->format('M j, Y') }}</span>
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-blue-600 hover:underline">Read
                                more →</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!-- Light Full Width Donation Section - Improved Button -->
    <section class="w-full calltoactionDonation">
        <div class="">
            <div
                class="backdrop-blur-xl bg-white/70 border border-white/50
            bg-gradient-to-r from-emerald-500/10 via-blue-500/10 to-cyan-500/10 
            p-8 md:p-12 lg:p-16 w-full">
                <div class="flex max-w-7xl mx-auto flex-col md:flex-row items-center justify-between gap-8 w-full">
                    <!-- Left Text -->
                    <div class="text-gray-800 max-w-2xl">
                        <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 tracking-tight">
                            সাহায্যের হাত বাড়িয়ে দিন
                        </h3>
                        <p class="text-lg md:text-xl text-gray-700">
                            আপনার ছোট অনুদানও দুর্যোগে ক্ষতিগ্রস্ত মানুষের পাশে বড় পরিবর্তন আনতে পারে
                        </p>
                    </div>

                    <!-- Donate Button - New Color -->
                    <div class="flex-shrink-0 pt-4 md:pt-0">
                        <a href="{{ route('member.create') }}"
                            class="group flex items-center gap-4 bg-green-600 hover:bg-green-700
    text-white px-12 py-6 rounded-full font-bold text-2xl md:text-3xl 
    transition-all duration-300 hover:-translate-y-1 shadow-md hover:shadow-xl 
    w-full md:w-auto justify-center">
                            <span>অনুদান করুন</span>
                            <span class="text-4xl group-hover:scale-125 transition-transform">🤝</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
