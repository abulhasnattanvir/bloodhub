@extends('layouts.frontend')

@section('content')
    <div class="max-w-6xl mx-auto py-10 px-4">

        <h1 class="text-3xl font-extrabold text-center mb-2">
            দানকারীদের তালিকা 🏆
        </h1>

        <p class="text-center text-gray-500 mb-8">
            যারা আমাদের মিশনকে সাহায্য করেছেন ❤️
        </p>

        <div class="grid md:grid-cols-3 gap-5">

            @foreach ($donors as $donor)
                <div class="bg-white border shadow rounded-2xl p-5 text-center hover:shadow-lg transition">

                    {{-- AVATAR --}}
                    <div
                        class="w-16 h-16 mx-auto bg-red-100 text-red-600 flex items-center justify-center rounded-full font-bold text-xl">
                        {{ strtoupper(substr($donor->name, 0, 1)) }}
                    </div>

                    {{-- NAME --}}
                    <h2 class="text-lg font-bold mt-3">
                        {{ $donor->name }}
                    </h2>

                    {{-- TOTAL --}}
                    <p class="text-green-600 font-semibold mt-1">
                        💰 {{ number_format($donor->total_amount) }} টাকা
                    </p>

                    {{-- COUNT --}}
                    <p class="text-sm text-gray-500">
                        🧾 {{ $donor->total_donations }}টি দান
                    </p>

                    {{-- BADGE --}}
                    <div class="mt-3">
                        @if ($donor->total_amount >= 10000)
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                🥇 গোল্ডেন ডোনার
                            </span>
                        @elseif($donor->total_amount >= 5000)
                            <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                🥈 সিলভার ডোনার
                            </span>
                        @else
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                🥉 সমর্থক
                            </span>
                        @endif
                    </div>

                    {{-- LAST DONATION --}}
                    <p class="text-xs text-gray-400 mt-3">
                        সর্বশেষ দান: {{ \Carbon\Carbon::parse($donor->last_donation)->diffForHumans() }}
                    </p>

                </div>
            @endforeach

        </div>

        {{-- PAGINATION --}}
        <div class="mt-8">
            {{ $donors->links() }}
        </div>

    </div>
@endsection
