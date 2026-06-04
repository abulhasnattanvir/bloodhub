{{-- @extends('layouts.frontend')

@section('content')
    <section class="pt-16 pb-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('goals.index') }}"
                    class="inline-flex items-center gap-2 text-gray-600 hover:text-red-600 transition">
                    <i class="fas fa-arrow-left"></i>
                    <span>সকল লক্ষ্য দেখুন</span>
                </a>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Icon Header -->
                <div class="h-64 bg-gradient-to-br from-red-600 to-red-700 flex items-center justify-center">
                    <div class="w-28 h-28 flex items-center justify-center rounded-3xl bg-white/20 backdrop-blur-md">
                        <i class="fas {{ $goal->icon }} text-7xl text-white"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8 md:p-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-8">
                        {{ $goal->text }}
                    </h1>

                    <!-- Description Area -->
                    <div class="prose prose-lg text-gray-700 leading-relaxed max-w-none">
                        <p>
                            {{ $goal->text }} এর মাধ্যমে আমরা সমাজের একটি গুরুত্বপূর্ণ অংশকে সহায়তা করতে চাই।
                            এই লক্ষ্য বাস্তবায়নের জন্য আমাদের টিম নিরলসভাবে কাজ করে যাচ্ছে।
                        </p>

                        <h3 class="text-xl font-semibold text-gray-800 mt-10 mb-4">আমাদের অঙ্গীকার</h3>
                        <ul class="list-disc list-inside space-y-3 text-gray-700">
                            <li>সচেতনতা বৃদ্ধি করা</li>
                            <li>প্রয়োজনীয় সহায়তা প্রদান</li>
                            <li>দীর্ঘমেয়াদী প্রভাব তৈরি করা</li>
                            <li>সম্প্রদায়ের সাথে সহযোগিতা বৃদ্ধি</li>
                        </ul>

                        <div class="mt-12 p-6 bg-red-50 rounded-2xl border border-red-100">
                            <p class="text-red-700 font-medium">
                                আপনিও এই লক্ষ্য বাস্তবায়নে অংশগ্রহণ করতে চাইলে আমাদের সাথে যোগাযোগ করুন।
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Action -->
                <div class="border-t border-gray-100 bg-gray-50 px-8 py-6 flex justify-between items-center">
                    <a href="{{ route('goals.index') }}"
                        class="text-gray-600 hover:text-gray-900 font-medium flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i>
                        অন্যান্য লক্ষ্য দেখুন
                    </a>

                    <a href="#"
                        class="bg-red-600 text-white px-8 py-3 rounded-2xl hover:bg-red-700 transition font-medium">
                        অংশগ্রহণ করুন
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection --}}
@extends('layouts.frontend')

@section('content')
    <section class="pt-16 pb-24 bg-gray-50 mt-10 mb-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <a href="{{ route('goals.index') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-red-600 mb-8 transition">
                <i class="fas fa-arrow-left"></i>
                <span>সকল লক্ষ্যে ফিরে যান</span>
            </a>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

                <!-- Hero Icon -->
                <div
                    class="h-72 bg-gradient-to-br from-red-600 via-red-700 to-red-800 flex items-center justify-center relative">
                    <div
                        class="w-32 h-32 flex items-center justify-center rounded-3xl bg-white/10 backdrop-blur-lg border border-white/20">
                        <i class="fas {{ $goal->icon }} text-8xl text-white"></i>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="p-8 md:p-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight mb-10">
                        {{ $goal->text }}
                    </h1>

                    <div class="prose prose-lg max-w-none text-gray-700">
                        <p>আমাদের এই লক্ষ্যটি সমাজের একটি গুরুত্বপূর্ণ সমস্যা সমাধানের জন্য নির্ধারিত। আমরা এই লক্ষ্য
                            অর্জনের মাধ্যমে একটি সুন্দর ও সমৃদ্ধ সমাজ গঠনে অবদান রাখতে চাই।</p>

                        <h3 class="text-2xl font-semibold mt-12 mb-5 text-gray-800">আমাদের পরিকল্পনা:</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> সচেতনতামূলক
                                ক্যাম্পেইন পরিচালনা</li>
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> প্রয়োজনীয় সহায়তা
                                প্রদান</li>
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> দীর্ঘমেয়াদী
                                প্রোগ্রাম বাস্তবায়ন</li>
                            <li class="flex items-start gap-3"><span class="text-red-600 mt-1">✓</span> সম্প্রদায়ের সাথে
                                সহযোগিতা</li>
                        </ul>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="bg-gray-50 border-t px-8 py-8 flex flex-wrap gap-4 justify-between items-center">
                    <p class="text-gray-600 font-medium">এই লক্ষ্যে আপনি কিভাবে অবদান রাখতে চান?</p>
                    <a href="#"
                        class="bg-red-600 text-white px-10 py-4 rounded-2xl hover:bg-red-700 transition font-medium">
                        অংশগ্রহণ করুন
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
