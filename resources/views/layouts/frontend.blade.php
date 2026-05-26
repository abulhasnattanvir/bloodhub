<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ setting('site_name', 'BloodHub') }}</title>
    @if (setting('favicon'))
        <link rel="icon" href="{{ asset('storage/' . setting('favicon')) }}">
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- =========================
     ADD THIS IN <HEAD>
========================= -->

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .hero-slider-section {
            position: relative;
            overflow: hidden;
            padding: 90px 0;
            background:
                radial-gradient(circle at top left, rgba(255, 0, 76, 0.12), transparent 30%),
                radial-gradient(circle at bottom right, rgba(255, 0, 0, 0.12), transparent 30%),
                linear-gradient(135deg, #fff5f5 0%, #ffffff 50%, #fff0f0 100%);
        }

        body.dark-mode .hero-slider-section {
            background:
                radial-gradient(circle at top left, rgba(255, 0, 76, 0.10), transparent 30%),
                radial-gradient(circle at bottom right, rgba(255, 0, 0, 0.08), transparent 30%),
                linear-gradient(135deg, #111827 0%, #0f172a 50%, #111827 100%);
        }

        .hero-glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        }

        body.dark-mode .hero-glass {
            background: rgba(17, 24, 39, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .hero-title {
            font-size: 3.5rem;
            line-height: 1.1;
            font-weight: 900;
            color: #111827;
        }

        body.dark-mode .hero-title {
            color: #ffffff;
        }

        .hero-text {
            color: #6b7280;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        body.dark-mode .hero-text {
            color: #d1d5db;
        }

        .hero-btn-primary {
            background: linear-gradient(135deg, #dc2626, #ef4444);
            transition: all 0.35s ease;
            box-shadow: 0 12px 25px rgba(220, 38, 38, 0.25);
        }

        .hero-btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 35px rgba(220, 38, 38, 0.35);
        }

        .hero-btn-secondary {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid #fecaca;
            transition: all 0.35s ease;
        }

        .hero-btn-secondary:hover {
            background: #fee2e2;
            transform: translateY(-3px);
        }

        body.dark-mode .hero-btn-secondary {
            background: rgba(31, 41, 55, 0.8);
            border-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        body.dark-mode .hero-btn-secondary:hover {
            background: rgba(55, 65, 81, 0.9);
        }

        .hero-image {
            animation: floatImage 5s ease-in-out infinite;
            filter: drop-shadow(0 30px 40px rgba(0, 0, 0, 0.15));
        }

        @keyframes floatImage {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .hero-badge {
            background: rgba(220, 38, 38, 0.08);
            color: #dc2626;
        }

        body.dark-mode .hero-badge {
            background: rgba(220, 38, 38, 0.15);
            color: #fca5a5;
        }

        .swiper-pagination-bullet {
            width: 12px;
            height: 12px;
            background: #ef4444;
            opacity: .4;
            transition: .3s;
        }

        .swiper-pagination-bullet-active {
            width: 32px;
            border-radius: 999px;
            opacity: 1;
        }

        .hero-shape {
            position: absolute;
            border-radius: 999px;
            filter: blur(70px);
            opacity: 0.3;
        }

        .hero-shape-1 {
            width: 280px;
            height: 280px;
            background: #f87171;
            top: -80px;
            left: -60px;
        }

        .hero-shape-2 {
            width: 350px;
            height: 350px;
            background: #fb7185;
            bottom: -120px;
            right: -80px;
        }

        @media(max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
        }
    </style>
    <style>
        :root {
            --primary: #dc3545;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;

            /* Light mode colors */
            --bg-color: #ffffff;
            --text-color: #212529;
            --card-bg: #ffffff;
            --border-color: #dee2e6;
            --hover-bg: #f8f9fa;

            /* Dark mode colors */
            --dark-bg-color: #121212;
            --dark-text-color: #e0e0e0;
            --dark-card-bg: #1e1e1e;
            --dark-border-color: #333333;
            --dark-hover-bg: #2a2a2a;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background-color: #bd2130;
            border-color: #b21f2d;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url('{{ asset('images/hero-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }

        .stats-card {
            background: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .donor-card {
            border: 1px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .donor-card:hover {
            transform: translateY(-5px);
        }

        .blood-badge {
            font-weight: bold;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .blood-A-plus {
            background: #ffebee;
            color: #c62828;
        }

        .blood-A-minus {
            background: #ffebee;
            color: #c62828;
        }

        .blood-B-plus {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .blood-B-minus {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .blood-AB-plus {
            background: #e3f2fd;
            color: #1565c0;
        }

        .blood-AB-minus {
            background: #e3f2fd;
            color: #1565c0;
        }

        .blood-O-plus {
            background: #fff3e0;
            color: #ef6c00;
        }

        .blood-O-minus {
            background: #fff3e0;
            color: #ef6c00;
        }

        .footer-bg {
            background-color: var(--bg-color);
        }

        /* Dark mode styles */
        body.dark-mode {
            --bg-color: var(--dark-bg-color);
            --text-color: var(--dark-text-color);
            --card-bg: var(--dark-card-bg);
            --border-color: var(--dark-border-color);
            --hover-bg: var(--dark-hover-bg);
        }

        body.dark-mode .footer-bg {
            background-color: var(--dark-bg-color);
        }

        body.dark-mode .navbar {
            background-color: var(--dark-card-bg) !important;
        }

        body.dark-mode .navbar-dark {
            --bs-navbar-color: rgba(255, 255, 255, .55);
            --bs-navbar-hover-color: rgba(255, 255, 255, .75);
            --bs-navbar-active-color: #fff;
            --bs-navbar-disabled-color: rgba(255, 255, 255, .25);
            --bs-navbar-toggler-icon-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .language-switcher {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .language-switcher:hover {
            background-color: var(--hover-bg);
        }

        .theme-switcher {
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .theme-switcher:hover {
            background-color: var(--hover-bg);
        }

        .mobile-menu-btn {
            display: none;
        }

        @media (max-width: 991.98px) {
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>

<body>
    <nav x-data="{ open: false, langOpen: false }" class="bg-red-600 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <div>
                    <a href="{{ route('home') }}" class="text-white text-2xl font-bold tracking-wide">
                        @if (setting('logo'))
                            <img src="{{ asset('storage/' . setting('logo')) }}" class="h-10" alt="Logo">
                        @else
                            <span class="text-lg font-bold">
                                {{ setting('site_name', 'BloodHub') }}
                            </span>
                        @endif
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-4">

                    <a href="{{ route('home') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700 transition">
                        {{ __('app.home') }}
                    </a>

                    <a href="{{ route('search') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700 transition">
                        {{ __('app.search_donors') }}
                    </a>

                    <a href="{{ route('donors.list') }}"
                        class="text-white px-3 py-2 rounded-lg hover:bg-red-700 transition">
                        {{ __('app.donor_list') }}
                    </a>

                    <a href="{{ route('about') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700 transition">
                        {{ __('app.about') }}
                    </a>

                    <a href="{{ route('contact') }}"
                        class="text-white px-3 py-2 rounded-lg hover:bg-red-700 transition">
                        {{ __('app.contact') }}
                    </a>

                    <!-- Language Dropdown -->
                    <div class="relative">
                        <button @click="langOpen = !langOpen"
                            class="text-white px-3 py-2 rounded-lg hover:bg-red-700 flex items-center gap-2">

                            {{ strtoupper(app()->getLocale()) }}

                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>

                        <div x-show="langOpen" @click.away="langOpen = false"
                            class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg overflow-hidden">

                            <a href="{{ route('lang.switch', 'en') }}" class="block px-4 py-2 hover:bg-gray-100">
                                English
                            </a>

                            <a href="{{ route('lang.switch', 'bn') }}" class="block px-4 py-2 hover:bg-gray-100">
                                বাংলা
                            </a>
                        </div>
                    </div>

                    <!-- Theme Toggle -->
                    <button id="themeToggle" class="text-white text-xl hover:text-yellow-300 transition">
                        <i class="fas fa-moon"></i>
                    </button>
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden">
                    <button @click="open = !open" class="text-white text-2xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="open" x-transition class="md:hidden pb-4">

                <div class="flex flex-col space-y-2">

                    <a href="{{ route('home') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700">
                        {{ __('app.home') }}
                    </a>

                    <a href="{{ route('search') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700">
                        {{ __('app.search_donors') }}
                    </a>

                    <a href="{{ route('donors.list') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700">
                        {{ __('app.donor_list') }}
                    </a>

                    <a href="{{ route('about') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700">
                        {{ __('app.about') }}
                    </a>

                    <a href="{{ route('contact') }}" class="text-white px-3 py-2 rounded-lg hover:bg-red-700">
                        {{ __('app.contact') }}
                    </a>

                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="relative bg-gradient-to-br from-gray-900 via-red-950 to-black text-white pt-16 pb-8 overflow-hidden">

        <!-- Background Blur -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-red-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-72 h-72 bg-red-500/10 rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-4">

            <!-- Main Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">

                <!-- About -->
                <div>
                    <h2 class="text-3xl font-extrabold mb-4 text-white">
                        {{ __('app.name') }}
                    </h2>

                    <p class="text-gray-300 leading-relaxed mb-6">
                        {{ __('app.footer.about_description') }}
                    </p>

                    <!-- Social Icons -->
                    <div class="flex items-center gap-4">

                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                            <i class="fab fa-facebook-f"></i>
                        </a>

                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                            <i class="fab fa-twitter"></i>
                        </a>

                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                            <i class="fab fa-instagram"></i>
                        </a>

                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                            <i class="fab fa-linkedin-in"></i>
                        </a>

                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-5">
                        {{ __('app.footer.quick_links') }}
                    </h3>

                    <ul class="space-y-3">

                        <li>
                            <a href="{{ route('home') }}"
                                class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                                <i class="fas fa-angle-right text-sm"></i>
                                {{ __('app.home') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('search') }}"
                                class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                                <i class="fas fa-angle-right text-sm"></i>
                                {{ __('app.search_donors') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('donors.list') }}"
                                class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                                <i class="fas fa-angle-right text-sm"></i>
                                {{ __('app.donor_list') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('about') }}"
                                class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                                <i class="fas fa-angle-right text-sm"></i>
                                {{ __('app.about') }}
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact') }}"
                                class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                                <i class="fas fa-angle-right text-sm"></i>
                                {{ __('app.contact') }}
                            </a>
                        </li>

                    </ul>
                </div>

                <!-- Emergency -->
                <div>
                    <h3 class="text-xl font-bold mb-5">
                        {{ __('app.footer.emergency') }}
                    </h3>

                    <div class="space-y-4">

                        <div class="flex items-start gap-3">
                            <div class="text-red-500 mt-1">
                                <i class="fas fa-phone-alt"></i>
                            </div>

                            <div>
                                <p class="text-sm text-gray-400">24/7 Hotline</p>
                                <h4 class="font-semibold">+123 456 7890</h4>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="text-red-500 mt-1">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div>
                                <p class="text-sm text-gray-400">Email Address</p>
                                <h4 class="font-semibold">info@bloodhub.org</h4>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="text-red-500 mt-1">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>

                            <div>
                                <p class="text-sm text-gray-400">Location</p>
                                <h4 class="font-semibold">
                                    123 Blood Donation Street, City
                                </h4>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Newsletter -->
                <div>
                    <h3 class="text-xl font-bold mb-5">
                        {{ __('app.footer.stay_updated') }}
                    </h3>

                    <p class="text-gray-300 mb-5">
                        {{ __('app.footer.get_updates_description') }}
                    </p>

                    <form class="space-y-4">

                        <input type="email" placeholder="Enter your email"
                            class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500">

                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 transition px-4 py-3 rounded-xl font-semibold shadow-lg">

                            Subscribe Now
                        </button>

                    </form>
                </div>

            </div>

            <!-- Bottom -->
            <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4">

                <p class="text-gray-400 text-sm text-center md:text-left">
                    © {{ now()->year }} {{ setting('site_name', 'BloodHub') }}.
                    {{ setting('footer_text') }}
                </p>

                <div class="flex items-center gap-6 text-sm">

                    <a href="#" class="text-gray-400 hover:text-red-400 transition">
                        Privacy Policy
                    </a>

                    <a href="#" class="text-gray-400 hover:text-red-400 transition">
                        Terms & Conditions
                    </a>

                    <a href="#" class="text-gray-400 hover:text-red-400 transition">
                        Support
                    </a>

                </div>
            </div>

        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.12.0/cdn.js" defer></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            new Swiper(".heroSlider", {

                loop: true,

                speed: 1200,

                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },

                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },

                effect: "slide",

            });

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Language Switcher
            const languageItems = document.querySelectorAll('.dropdown-item[data-lang]');
            languageItems.forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const lang = this.getAttribute('data-lang');
                    // Set language preference in cookie or localStorage
                    document.cookie = "locale=" + lang + ";path=/;max-age=31536000"; // 1 year
                    // Reload page
                    window.location.reload();
                });
            });

            // Mobile Menu Toggle
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            const navbarNav = document.getElementById('navbarNav');

            if (mobileMenuBtn && navbarNav) {
                mobileMenuBtn.addEventListener('click', function() {
                    navbarNav.classList.toggle('show');
                });
            }

            // Theme Switcher
            const themeToggle = document.getElementById('themeToggle');
            if (themeToggle) {
                // Check for saved theme preference or use system preference
                const savedTheme = localStorage.getItem('theme');
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                    document.body.classList.add('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
                } else {
                    document.body.classList.remove('dark-mode');
                    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
                }

                themeToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    document.body.classList.toggle('dark-mode');

                    // Save preference
                    if (document.body.classList.contains('dark-mode')) {
                        localStorage.setItem('theme', 'dark');
                        this.innerHTML = '<i class="fas fa-sun"></i>';
                    } else {
                        localStorage.setItem('theme', 'light');
                        this.innerHTML = '<i class="fas fa-moon"></i>';
                    }
                });
            }
        });
    </script>
    @stack('scripts')

</body>

</html>
