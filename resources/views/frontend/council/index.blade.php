@extends('layouts.frontend')

@section('content')
    <div class="relative overflow-hidden">
        <!-- 🌈 Enhanced Color Background -->
        <div class="absolute inset-0 -z-10 overflow-hidden">

            <!-- Base Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-red-50 via-white to-pink-50"></div>

            <!-- Main Color Blobs -->
            <div class="absolute top-[-80px] left-[-80px] w-[400px] h-[400px] bg-red-300/40 rounded-full blur-3xl"></div>
            <div class="absolute top-[200px] right-[-100px] w-[450px] h-[450px] bg-pink-300/40 rounded-full blur-3xl"></div>
            <div class="absolute bottom-[-120px] left-[30%] w-[500px] h-[500px] bg-yellow-200/30 rounded-full blur-3xl">
            </div>
            <div class="absolute bottom-[100px] right-[25%] w-[350px] h-[350px] bg-orange-200/30 rounded-full blur-3xl">
            </div>

            <!-- Pattern Overlay -->
            <div
                class="absolute inset-0 opacity-[0.06] bg-[radial-gradient(circle,_rgba(0,0,0,0.08)_1px,_transparent_1px)] bg-[size:28px_28px]">
            </div>

        </div>

        <!-- Content -->
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

                <!-- Page Header -->
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-gray-900">আমাদের পরিষদ সদস্যরা</h1>
                    <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                        আমাদের পরিষদ প্রতি বছর গঠন করা হয় তাদের নিষ্ঠা, নেতৃত্ব এবং সংগঠনের প্রতি অসাধারণ অবদানের ভিত্তিতে।
                        সদস্যদের তাদের দায়িত্ব ও সেবার স্তর অনুযায়ী নির্বাচন ও সাজানো হয়।
                    </p>
                </div>

                @if ($councils->isEmpty())
                    <div class="text-center py-20">
                        <p class="text-gray-500 text-xl">এই মুহূর্তে কোনো পরিষদ সদস্য পাওয়া যায়নি।</p>
                    </div>
                @else
                    @php
                        $grouped = $councils
                            ->sortBy('order')
                            ->groupBy('position')
                            ->sortBy(function ($group, $key) {
                                $order = [
                                    'president' => 1,
                                    'vice_president' => 2,
                                    'secretary' => 3,
                                    'joint_secretary' => 4,
                                    'member' => 5,
                                    'advisor' => 6,
                                ];
                                return $order[$key] ?? 99;
                            });
                    @endphp

                    @foreach ($grouped as $position => $members)
                        <div class="mb-20 flex flex-col items-center">

                            <!-- Section Header -->
                            <div class="mb-10 text-center">
                                <div
                                    class="inline-flex items-center gap-3 px-6 py-3 rounded-2xl bg-white/70 backdrop-blur shadow-sm border border-gray-100">
                                    <h2 class="text-xl md:text-2xl font-bold text-gray-800 capitalize">
                                        {{ ucwords(str_replace('_', ' ', $position)) }}
                                    </h2>

                                    <span class="px-3 py-1 text-xs font-semibold bg-red-100 text-red-600 rounded-full">
                                        {{ $members->count() }} জন সদস্য
                                    </span>
                                </div>
                            </div>

                            <!-- Grid Wrapper -->
                            <div class="w-full flex justify-center">
                                <div class="flex flex-wrap justify-center gap-8 max-w-6xl mx-auto">

                                    @foreach ($members as $council)
                                        <div
                                            class="group bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 w-72">

                                            <!-- Top Accent -->
                                            <div class="h-2 bg-gradient-to-r from-red-400 via-pink-400 to-red-600"></div>

                                            <!-- Image -->
                                            <div class="p-6 flex justify-center">
                                                <div class="relative w-28 h-28">
                                                    @if ($council->photo)
                                                        <img src="{{ asset($council->photo) }}"
                                                            class="w-28 h-28 rounded-full object-cover ring-4 ring-red-100 group-hover:scale-105 transition duration-300"
                                                            alt="{{ $council->name }}">
                                                    @else
                                                        <div
                                                            class="w-28 h-28 rounded-full bg-gray-100 flex items-center justify-center ring-4 ring-gray-100">
                                                            <i class="fas fa-user text-4xl text-gray-300"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div class="px-6 pb-6 text-center">

                                                <h3 class="text-lg font-bold text-gray-900">
                                                    {{ $council->name }}
                                                </h3>

                                                <p class="text-sm font-medium text-red-500 mt-1">
                                                    {{ ucfirst(str_replace('_', ' ', $council->position)) }}
                                                </p>

                                                @if ($council->bio)
                                                    <p class="text-gray-500 text-sm mt-3 line-clamp-3">
                                                        {{ $council->bio }}
                                                    </p>
                                                @endif

                                                <!-- Contact -->
                                                @if ($council->phone || $council->email)
                                                    <div class="mt-4 text-sm text-gray-500 space-y-1">
                                                        @if ($council->phone)
                                                            <p>📞 {{ $council->phone }}</p>
                                                        @endif
                                                        @if ($council->email)
                                                            <p>✉️ {{ $council->email }}</p>
                                                        @endif
                                                    </div>
                                                @endif

                                                <!-- Social -->
                                                <div class="flex justify-center gap-3 mt-5">

                                                    @if ($council->facebook)
                                                        <a href="{{ $council->facebook }}" target="_blank"
                                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    @endif

                                                    @if ($council->twitter)
                                                        <a href="{{ $council->twitter }}" target="_blank"
                                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-sky-50 text-sky-500 hover:bg-sky-500 hover:text-white transition">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    @endif

                                                    @if ($council->linkedin)
                                                        <a href="{{ $council->linkedin }}" target="_blank"
                                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-50 text-blue-700 hover:bg-blue-700 hover:text-white transition">
                                                            <i class="fab fa-linkedin-in"></i>
                                                        </a>
                                                    @endif

                                                    @if ($council->instagram)
                                                        <a href="{{ $council->instagram }}" target="_blank"
                                                            class="w-9 h-9 flex items-center justify-center rounded-full bg-pink-50 text-pink-500 hover:bg-pink-500 hover:text-white transition">
                                                            <i class="fab fa-instagram"></i>
                                                        </a>
                                                    @endif

                                                </div>

                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>

                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
