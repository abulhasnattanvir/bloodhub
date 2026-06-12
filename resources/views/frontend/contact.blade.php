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

    @php
        $contact = \App\Models\ContactSetting::first();
    @endphp

    <section class="relative py-16 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-red-50 via-white to-red-100"></div>

        <div class="relative max-w-7xl mx-auto px-4">

            <!-- Heading -->
            <div class="text-center mb-14">
                <span class="inline-block px-4 py-2 bg-red-100 text-red-600 rounded-full text-sm font-semibold mb-4">
                    যোগাযোগ
                </span>
                <h1 class="text-5xl font-extrabold text-gray-800 mb-4">
                    {{ $contact->page_title ?? __('যোগাযোগ করুন') }}
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    {{ $contact->page_subtitle ?? __('কোনো প্রশ্ন আছে বা সাহায্যের প্রয়োজন? আমাদের টিম সবসময় ডোনার ও রিসিপিয়েন্টদের সাহায্য করার জন্য প্রস্তুত—যেকোনো সময় আমাদের সাথে যোগাযোগ করতে পারেন।') }}
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-10 mb-10">

                <!-- Contact Info -->
                <div class="contact-card p-8">
                    <h2 class="text-3xl font-bold mb-4 text-gray-800">যোগাযোগ করুন</h2>
                    <p class="text-gray-600 mb-8">
                        {{ $contact->get_in_touch_text ?? __('আপনি যদি একজন রক্তদাতা, রক্তগ্রহণকারী, অথবা শুধুমাত্র তথ্য জানতে চান - যেকোনো প্রয়োজনে যেকোনো সময় আমাদের সাপোর্ট টিমের সাথে যোগাযোগ করতে পারেন।') }}
                    </p>

                    <div class="space-y-5">
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-red-50">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <h4 class="font-bold">{{ __('ইমেইল') }}</h4>
                                <p class="text-gray-600">{{ $contact->email ?? 'tawakkulsoftinfo@gmail.com' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-xl bg-red-50">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div>
                                <h4 class="font-bold">{{ __('ফোন') }}</h4>
                                <p class="text-gray-600">{{ $contact->phone ?? '+880 01972918629' }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 p-4 rounded-xl bg-red-50">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <h4 class="font-bold">{{ __('ঠিকানা') }}</h4>
                                <p class="text-gray-600">
                                    {{ $contact->address ?? 'Noakhali Sadar, Z1441, Noakhali, R4G2+7J Noakhali' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-card p-8">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">
                        {{ $contact->form_title ?? __('আমাদেরকে বার্তা পাঠান') }}
                    </h2>

                    @if (session('success'))
                        <div class="max-w-7xl mx-auto px-4 mt-6">
                            <div
                                class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                                <i class="fas fa-check-circle text-xl"></i>
                                <p class="font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold mb-2">আপনার নাম লিখুন</label>
                            <input type="text" name="name" class="contact-input" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">আপনার ইমেইল ঠিকানা লিখুন</label>
                            <input type="email" name="email" class="contact-input" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">মেসেজের বিষয় লিখুন</label>
                            <input type="text" name="subject" class="contact-input" required>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">আপনার বার্তা লিখুন</label>
                            <textarea name="message" rows="6" class="contact-input resize-none" required></textarea>
                        </div>

                        <button type="submit" class="contact-btn">
                            <i class="fas fa-paper-plane mr-2"></i> বার্তা পাঠান
                        </button>
                    </form>
                </div>
            </div>

            <!-- Map -->
            <div class="contact-card p-6">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="text-3xl font-bold text-gray-800">আমাদের অবস্থান</h2>
                </div>
                <div class="map-container">
                    {!! $contact->map_embed ??
                        '<div class="h-full flex items-center justify-center text-gray-500">Map Embed Code Here</div>' !!}
                </div>
            </div>

        </div>
    </section>
@endsection
