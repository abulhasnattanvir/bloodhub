<a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
    @if (setting('logo'))
        @php
            $logo = asset('assets/images/main-logo.png');
        @endphp

        <img src="{{ $logo }}" width="120" alt="Logo">
    @else
        <span class="text-white text-xl font-bold">
            {{ setting('site_name', 'TawakkulSoft') }}
        </span>
    @endif
</a>
