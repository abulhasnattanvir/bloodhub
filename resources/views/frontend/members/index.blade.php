@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-800">আমাদের ESW সদস্যবৃন্দ</h1>
            <p class="text-gray-500 mt-2">আমাদের সদস্যদের খুঁজুন এবং যোগাযোগ করুন ❤️</p>
        </div>

        {{-- Grid --}}
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

            @foreach ($members as $member)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition overflow-hidden border">

                    {{-- Photo --}}
                    <div class="bg-gradient-to-r from-red-50 to-white p-5 flex justify-center">
                        @if ($member->photo)
                            <img src="{{ asset($member->photo) }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white shadow">
                        @else
                            <div
                                class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                                ছবি নেই
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-5 text-center space-y-1">

                        <h2 class="text-lg font-bold text-gray-800">
                            {{ $member->name }}
                        </h2>

                        <p class="text-sm text-gray-500">
                            {{ $member->profession ?? 'পেশা নেই' }}
                        </p>

                        <div class="mt-2">
                            {{-- Blood Group Badge --}}
                            <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $member->blood_group }}
                            </span>
                        </div>

                        <div class="text-sm text-gray-600 mt-3 space-y-1">
                            <p>📍 {{ $member->city ?? 'অজানা' }}</p>
                            <p>📞 {{ $member->phone }}</p>
                        </div>

                        {{-- Gender Badge --}}
                        <div class="mt-3">
                            <span class="text-xs px-3 py-1 rounded-full bg-gray-100 text-gray-600">
                                {{ ucfirst($member->gender) }}
                            </span>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $members->links() }}
        </div>

    </div>
@endsection
