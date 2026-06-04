@extends('layouts.frontend')

@section('content')
    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-14">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">আমাদের লক্ষ্য ও উদ্দেশ্য</h2>
                <p class="mt-4 text-gray-600 text-lg">সমাজের উন্নয়নে আমাদের অঙ্গীকার</p>
                <div class="w-20 h-1 bg-red-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach ($goals as $goal)
                    <a href="{{ route('goals.show', $goal) }}"
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
@endsection
