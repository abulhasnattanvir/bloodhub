@extends('layouts.frontend')

@section('content')
    <section class="pt-16 pb-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <a href="{{ route('activities.index') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-red-600 mb-8 transition">
                <i class="fas fa-arrow-left"></i>
                <span>সকল কার্যক্রমে ফিরে যান</span>
            </a>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Hero -->
                <div class="h-72 bg-gradient-to-br from-red-600 to-red-800 flex items-center justify-center">
                    <div class="w-32 h-32 flex items-center justify-center rounded-3xl bg-white/10 backdrop-blur-lg">
                        <i class="fas {{ $activity->icon }} text-8xl text-white"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 md:p-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-10">
                        {{ $activity->text }}
                    </h1>

                    <div class="prose prose-lg text-gray-700 max-w-none">
                        <p>এই কার্যক্রমটি আমাদের সংগঠনের অন্যতম গুরুত্বপূর্ণ উদ্যোগ। আমরা এর মাধ্যমে সমাজের বিভিন্ন স্তরে
                            ইতিবাচক পরিবর্তন আনতে প্রতিশ্রুতিবদ্ধ।</p>

                        <h3 class="text-2xl font-semibold mt-12 mb-5 text-gray-800">কার্যক্রমের উদ্দেশ্য:</h3>
                        <ul class="space-y-4 text-gray-700">
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> সচেতনতা বৃদ্ধি করা
                            </li>
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> প্রয়োজনীয় সহায়তা
                                প্রদান</li>
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> দীর্ঘমেয়াদী প্রভাব
                                তৈরি</li>
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> সম্প্রদায়ের অংশগ্রহণ
                                নিশ্চিত করা</li>
                        </ul>
                    </div>
                </div>

                <!-- CTA -->
                <div class="border-t bg-gray-50 px-8 py-8 flex flex-wrap gap-4 justify-between items-center">
                    <p class="text-gray-600">এই কার্যক্রমে অংশগ্রহণ করতে চান?</p>
                    <a href="#"
                        class="bg-red-600 hover:bg-red-700 text-white px-10 py-4 rounded-2xl transition font-medium">
                        যোগাযোগ করুন
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
