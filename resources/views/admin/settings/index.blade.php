@extends('layouts.admin')

@section('content')
    <div class="max-w-5xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-6">Site Settings</h2>

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow space-y-6">

            @csrf

            <!-- BASIC -->
            <div class="grid md:grid-cols-2 gap-4">

                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? '' }}"
                    class="border p-2 rounded w-full" placeholder="Site Name">

                <input type="text" name="tagline" value="{{ $settings['tagline'] ?? '' }}"
                    class="border p-2 rounded w-full" placeholder="Tagline">

                <input type="text" name="email" value="{{ $settings['email'] ?? '' }}"
                    class="border p-2 rounded w-full" placeholder="Email">

                <input type="text" name="phone" value="{{ $settings['phone'] ?? '' }}"
                    class="border p-2 rounded w-full" placeholder="Phone">

            </div>

            <!-- ADDRESS -->
            <input type="text" name="address" value="{{ $settings['address'] ?? '' }}" class="border p-2 rounded w-full"
                placeholder="Address">

            <!-- FOOTER -->
            <textarea name="footer_text" class="border p-2 rounded w-full h-24" placeholder="Footer Text">{{ $settings['footer_text'] ?? '' }}</textarea>

            <!-- LOGO -->
            <div>
                <label class="font-medium">Logo</label>

                @if (!empty($settings['logo']))
                    <img src="{{ asset('storage/' . $settings['logo']) }}" class="h-16 mb-2">
                @endif

                <input type="file" name="logo" class="border p-2 w-full">
            </div>

            <!-- FAVICON -->
            <div>
                <label class="font-medium">Favicon</label>

                @if (!empty($settings['favicon']))
                    <img src="{{ asset('storage/' . $settings['favicon']) }}" class="h-10 mb-2">
                @endif

                <input type="file" name="favicon" class="border p-2 w-full">
            </div>

            <button class="bg-red-600 text-white px-6 py-2 rounded">
                Save Settings
            </button>

        </form>

    </div>
@endsection
