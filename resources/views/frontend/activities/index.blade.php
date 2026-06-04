@extends('layouts.frontend')

@section('content')
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
@endsection
