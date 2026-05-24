@extends('layouts.frontend')

@section('content')
    <style>
        .about-hero {
            background:
                radial-gradient(circle at top left, rgba(239, 68, 68, 0.18), transparent 35%),
                radial-gradient(circle at bottom right, rgba(220, 38, 38, 0.15), transparent 35%),
                linear-gradient(to right, #fff5f5, #ffffff);
        }

        .about-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        }

        .about-icon {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .feature-item {
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateX(6px);
        }

        .gradient-btn {
            background: linear-gradient(to right, #dc2626, #ef4444);
            transition: all 0.3s ease;
        }

        .gradient-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.3);
        }

        body.dark-mode .about-card {
            background: rgba(30, 30, 30, 0.95);
            color: #f3f4f6;
        }
    </style>

    <!-- HERO -->
    <section class="about-hero py-24 overflow-hidden">

        <div class="max-w-7xl mx-auto px-4">

            <div class="grid lg:grid-cols-2 gap-14 items-center">

                <!-- Left Content -->
                <div>

                    <span
                        class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-6">
                        <i class="fas fa-heartbeat"></i>
                        About Our Mission
                    </span>

                    <h1 class="text-5xl lg:text-6xl font-extrabold leading-tight text-gray-900 mb-6">

                        Connecting Donors <br>

                        <span class="text-red-600">
                            Saving Lives
                        </span>

                    </h1>

                    <p class="text-lg text-gray-600 leading-relaxed mb-8">

                        Welcome to our Blood Donor Management System. We are committed
                        to building a reliable blood donation network that helps patients
                        receive emergency blood quickly and safely.

                    </p>

                    <div class="flex flex-wrap gap-4">

                        <a href="{{ route('search') }}"
                            class="gradient-btn px-8 py-4 rounded-2xl text-white font-bold shadow-xl">

                            <i class="fas fa-search mr-2"></i>
                            {{ __('app.search_donors') }}
                        </a>

                        <a href="{{ route('contact') }}"
                            class="px-8 py-4 rounded-2xl border border-red-200 bg-white hover:bg-red-50 transition font-semibold text-gray-700">

                            <i class="fas fa-phone-alt mr-2"></i>
                            Contact Us
                        </a>

                    </div>

                </div>

                <!-- Right Side -->
                <div class="relative">

                    <div class="about-card rounded-[30px] p-10 shadow-2xl">

                        <div class="grid grid-cols-2 gap-6">

                            <div class="p-6 rounded-2xl bg-red-50 text-center">

                                <div class="about-icon mx-auto bg-red-100 text-red-600 mb-4">
                                    <i class="fas fa-users"></i>
                                </div>

                                <h3 class="text-3xl font-extrabold text-gray-900">
                                    10K+
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Registered Donors
                                </p>

                            </div>

                            <div class="p-6 rounded-2xl bg-green-50 text-center">

                                <div class="about-icon mx-auto bg-green-100 text-green-600 mb-4">
                                    <i class="fas fa-heart-pulse"></i>
                                </div>

                                <h3 class="text-3xl font-extrabold text-gray-900">
                                    24/7
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Emergency Support
                                </p>

                            </div>

                            <div class="p-6 rounded-2xl bg-blue-50 text-center">

                                <div class="about-icon mx-auto bg-blue-100 text-blue-600 mb-4">
                                    <i class="fas fa-hand-holding-medical"></i>
                                </div>

                                <h3 class="text-3xl font-extrabold text-gray-900">
                                    5K+
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Lives Saved
                                </p>

                            </div>

                            <div class="p-6 rounded-2xl bg-yellow-50 text-center">

                                <div class="about-icon mx-auto bg-yellow-100 text-yellow-600 mb-4">
                                    <i class="fas fa-shield-heart"></i>
                                </div>

                                <h3 class="text-3xl font-extrabold text-gray-900">
                                    100%
                                </h3>

                                <p class="text-gray-600 mt-2">
                                    Verified Platform
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- OUR MISSION -->
    <section class="py-20 bg-white">

        <div class="max-w-7xl mx-auto px-4">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <!-- Image Side -->
                <div>

                    <div class="about-card rounded-[30px] p-10 shadow-xl">

                        <div class="space-y-6">

                            <div class="feature-item flex items-start gap-5">

                                <div class="about-icon bg-red-100 text-red-600">
                                    <i class="fas fa-user-plus"></i>
                                </div>

                                <div>
                                    <h3 class="text-2xl font-bold mb-2 text-gray-900">
                                        Easy Registration
                                    </h3>

                                    <p class="text-gray-600 leading-relaxed">
                                        Donors can register quickly with blood group,
                                        location, and availability information.
                                    </p>
                                </div>

                            </div>

                            <div class="feature-item flex items-start gap-5">

                                <div class="about-icon bg-green-100 text-green-600">
                                    <i class="fas fa-search-location"></i>
                                </div>

                                <div>
                                    <h3 class="text-2xl font-bold mb-2 text-gray-900">
                                        Smart Search
                                    </h3>

                                    <p class="text-gray-600 leading-relaxed">
                                        Patients can find nearby blood donors instantly
                                        during emergencies.
                                    </p>
                                </div>

                            </div>

                            <div class="feature-item flex items-start gap-5">

                                <div class="about-icon bg-blue-100 text-blue-600">
                                    <i class="fas fa-comments"></i>
                                </div>

                                <div>
                                    <h3 class="text-2xl font-bold mb-2 text-gray-900">
                                        Direct Communication
                                    </h3>

                                    <p class="text-gray-600 leading-relaxed">
                                        Connect donors and recipients securely and efficiently.
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Text Side -->
                <div>

                    <span class="inline-block px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-4">
                        Our Vision
                    </span>

                    <h2 class="text-4xl font-extrabold text-gray-900 mb-6">

                        Building A Strong <br>

                        Blood Donation Community

                    </h2>

                    <p class="text-lg text-gray-600 leading-relaxed mb-6">

                        Our mission is to ensure that every patient who needs blood
                        can quickly find a suitable donor without delay.

                    </p>

                    <p class="text-lg text-gray-600 leading-relaxed mb-8">

                        By leveraging modern technology and community support,
                        we aim to create one of the most trusted blood donation
                        platforms for hospitals, donors, and recipients.

                    </p>

                    <div class="space-y-4">

                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700 font-medium">
                                Verified Blood Donors
                            </span>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700 font-medium">
                                Fast Emergency Support
                            </span>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700 font-medium">
                                Secure Communication
                            </span>
                        </div>

                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                            <span class="text-gray-700 font-medium">
                                Community Driven Platform
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- HOW WE WORK -->
    <section class="py-20 bg-gray-50">

        <div class="max-w-7xl mx-auto px-4">

            <div class="text-center mb-16">

                <span class="inline-block px-4 py-2 rounded-full bg-red-100 text-red-600 font-semibold mb-4">
                    Simple Process
                </span>

                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">
                    How We Work
                </h2>

                <p class="text-gray-600 max-w-2xl mx-auto">
                    Our process is designed to make blood donation and emergency support simple and fast.
                </p>

            </div>

            <div class="grid md:grid-cols-4 gap-8">

                <!-- Step -->
                <div class="about-card rounded-3xl p-8 text-center">

                    <div
                        class="w-20 h-20 rounded-full bg-red-100 text-red-600 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-user-plus text-3xl"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Register
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Donors create profiles with blood group and availability.
                    </p>

                </div>

                <!-- Step -->
                <div class="about-card rounded-3xl p-8 text-center">

                    <div
                        class="w-20 h-20 rounded-full bg-green-100 text-green-600 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-3xl"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Search
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Recipients search for donors by location and blood group.
                    </p>

                </div>

                <!-- Step -->
                <div class="about-card rounded-3xl p-8 text-center">

                    <div
                        class="w-20 h-20 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone-volume text-3xl"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Connect
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Donors and recipients communicate securely.
                    </p>

                </div>

                <!-- Step -->
                <div class="about-card rounded-3xl p-8 text-center">

                    <div
                        class="w-20 h-20 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-heart text-3xl"></i>
                    </div>

                    <h3 class="text-2xl font-bold mb-4">
                        Save Lives
                    </h3>

                    <p class="text-gray-600 leading-relaxed">
                        Every successful donation helps save precious human lives.
                    </p>

                </div>

            </div>

        </div>

    </section>
@endsection
