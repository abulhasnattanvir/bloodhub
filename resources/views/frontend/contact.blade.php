@extends('layouts.frontend')

@section('content')
    <style>
        .contact-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .contact-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .contact-input {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            background: #fff;
            transition: all 0.3s ease;
            outline: none;
        }

        .contact-input:focus {
            border-color: #dc2626;
            box-shadow: 0 0 0 4px rgba(220, 38, 38, 0.15);
        }

        .contact-btn {
            background: linear-gradient(to right, #dc2626, #ef4444);
            padding: 14px 24px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
        }

        .contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(220, 38, 38, 0.3);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(220, 38, 38, 0.1);
            color: #dc2626;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .map-container {
            border-radius: 20px;
            overflow: hidden;
            height: 350px;
            background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        }

        body.dark-mode .contact-card {
            background: rgba(30, 30, 30, 0.95);
            color: #f3f4f6;
        }

        body.dark-mode .contact-input {
            background: #1f2937;
            border-color: #374151;
            color: white;
        }

        body.dark-mode .contact-input::placeholder {
            color: #9ca3af;
        }
    </style>

    <section class="relative py-16 overflow-hidden">

        <!-- Background -->
        <div class="absolute inset-0 bg-gradient-to-br from-red-50 via-white to-red-100"></div>

        <div class="relative max-w-7xl mx-auto px-4">

            <!-- Heading -->
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm font-semibold mb-4">
                    {{ __('app.contact') }}
                </span>

                <h1 class="text-5xl font-extrabold text-gray-800 mb-4">
                    {{ __('app.contact') }}
                </h1>

                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ __('app.have_questions_text') }}
                </p>
            </div>

            <!-- Main Grid -->
            <div class="grid lg:grid-cols-2 gap-10 mb-10">

                <!-- Contact Info -->
                <div class="contact-card p-8">

                    <h2 class="text-3xl font-bold mb-4 text-gray-800">
                        {{ __('app.get_in_touch') }}
                    </h2>

                    <p class="text-gray-600 mb-8 leading-relaxed">
                        {{ __('app.whether_you_are_text') }}
                    </p>

                    <div class="space-y-5">

                        <!-- Email -->
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-red-50">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-800">
                                    {{ __('app.email') }}
                                </h4>

                                <p class="text-gray-600">
                                    info@blooddonor.example.com
                                </p>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-red-50">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-800">
                                    {{ __('app.phone') }}
                                </h4>

                                <p class="text-gray-600">
                                    +1 (555) 123-4567
                                </p>
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-red-50">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>

                            <div>
                                <h4 class="font-bold text-gray-800">
                                    {{ __('app.address') }}
                                </h4>

                                <p class="text-gray-600">
                                    123 Blood Donor Street, City, State 12345
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-card p-8">

                    <h2 class="text-3xl font-bold mb-6 text-gray-800">
                        {{ __('app.send_us_a_message') }}
                    </h2>

                    <form id="contactForm" class="space-y-5">

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">
                                {{ __('app.name') }}
                            </label>

                            <input type="text" class="contact-input" placeholder="{{ __('app.enter_your_name') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">
                                {{ __('app.email_address') }}
                            </label>

                            <input type="email" class="contact-input" placeholder="{{ __('app.enter_your_email') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">
                                {{ __('app.subject') }}
                            </label>

                            <input type="text" class="contact-input" placeholder="{{ __('app.enter_subject') }}">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-700">
                                {{ __('app.message') }}
                            </label>

                            <textarea rows="6" class="contact-input resize-none" placeholder="{{ __('app.enter_your_message') }}"></textarea>
                        </div>

                        <button type="submit" class="contact-btn">
                            <i class="fas fa-paper-plane mr-2"></i>
                            {{ __('app.send_message') }}
                        </button>

                    </form>
                </div>

            </div>

            <!-- Map -->
            <div class="contact-card p-6">

                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-3xl font-bold text-gray-800">
                        {{ __('app.our_location') }}
                    </h2>

                    <span class="px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm">
                        {{ __('app.live_location') }}
                    </span>
                </div>

                <div class="map-container flex items-center justify-center">

                    <div class="text-center">
                        <i class="fas fa-map-marked-alt text-6xl text-red-500 mb-4"></i>

                        <p class="text-lg text-gray-600">
                            {{ __('app.map_would_appear_here') }}
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection
