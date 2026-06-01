@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto py-12 px-4">

        <h1 class="text-3xl font-bold text-center mb-10">
            Council Members
        </h1>

        <div class="grid md:grid-cols-3 gap-6">

            @foreach ($councils as $council)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition p-6 text-center">

                    {{-- Photo --}}
                    <img src="{{ asset($council->photo) }}"
                        class="w-24 h-24 mx-auto rounded-full object-cover border-4 border-red-100">

                    {{-- Name --}}
                    <h2 class="text-xl font-bold mt-3">
                        {{ $council->name }}
                    </h2>

                    {{-- Position --}}
                    <p class="text-red-600 font-semibold text-sm">
                        {{ ucfirst(str_replace('_', ' ', $council->position)) }}
                    </p>

                    {{-- Bio --}}
                    <p class="text-gray-500 text-sm mt-2">
                        {{ $council->bio }}
                    </p>

                    {{-- Contact --}}
                    <div class="text-sm text-gray-600 mt-2">
                        <p>{{ $council->phone }}</p>
                        <p>{{ $council->email }}</p>
                    </div>

                    {{-- Social Links --}}
                    {{-- Social Links --}}
                    <div class="flex justify-center gap-4 mt-4">

                        @if ($council->facebook)
                            <a href="{{ $council->facebook }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif

                        @if ($council->twitter)
                            <a href="{{ $council->twitter }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-sky-100 text-sky-500 hover:bg-sky-500 hover:text-white transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                        @endif

                        @if ($council->linkedin)
                            <a href="{{ $council->linkedin }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-blue-100 text-blue-700 hover:bg-blue-700 hover:text-white transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                        @endif

                        @if ($council->instagram)
                            <a href="{{ $council->instagram }}" target="_blank"
                                class="w-9 h-9 flex items-center justify-center rounded-full bg-pink-100 text-pink-500 hover:bg-pink-500 hover:text-white transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif

                    </div>

                </div>
            @endforeach

        </div>

    </div>
@endsection
