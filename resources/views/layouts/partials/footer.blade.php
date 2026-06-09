@php
    $footer = \App\Models\FooterSetting::first();
@endphp
<footer class="relative bg-zinc-950 text-white pt-16 pb-8">

    <div class="relative max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">

            <!-- About -->
            <div>
                <!-- Logo -->
                <a href="{{ route('home') }}" class="inline-block mb-6">
                    @if (setting('flogo'))
                        <img src="{{ asset('storage/' . setting('flogo')) }}" style="width: 150px;" alt="Logo">
                    @else
                        <h2 class="text-3xl font-bold">{{ setting('site_name') }}</h2>
                    @endif
                </a>

                <p class="text-gray-300 leading-relaxed mb-6">
                    {{ $footer->about_text ?? 'Default about text...' }}
                </p>

                <!-- Social Links -->
                <div class="flex gap-4">
                    @foreach ($footer->social_links ?? [] as $social)
                        @if (!empty($social['url']))
                            <a href="{{ $social['url'] }}" target="_blank"
                                class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 flex items-center justify-center">
                                <i class="{{ $social['icon'] ?? 'fas fa-link' }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-5">Quick Links</h3>
                <ul class="space-y-3">
                    @foreach ($footer->quick_links ?? [] as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                                class="text-gray-300 hover:text-red-400 flex items-center gap-2">
                                <i class="fas fa-angle-right"></i> {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Service Links -->
            <div>
                <h3 class="text-xl font-bold mb-5">Services</h3>
                <ul class="space-y-3">
                    @foreach ($footer->service_links ?? [] as $link)
                        <li>
                            <a href="{{ $link['url'] }}"
                                class="text-gray-300 hover:text-red-400 flex items-center gap-2">
                                <i class="fas fa-angle-right"></i> {{ $link['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-xl font-bold mb-5">
                    {{ $footer->subscribe_title ?? 'Stay Updated' }}
                </h3>

                <p class="text-gray-300 mb-5">
                    {{ $footer->subscribe_text ?? 'Get the latest updates and news from us.' }}
                </p>

                <form action="{{ route('admin.newsletter.subscribe') }}" method="POST" class="space-y-4">
                    {{-- আপনার রাউট অনুযায়ী --}}
                    @csrf

                    <input type="email" name="email"
                        placeholder="{{ $footer->subscribe_placeholder ?? 'Enter your email' }}"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                        required>

                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 transition px-4 py-3 rounded-xl font-semibold shadow-lg">
                        {{ $footer->subscribe_button_text ?? 'Subscribe Now' }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="pt-8 flex flex-col md:flex-row justify-between items-center text-sm text-gray-400">
            <p>© {{ now()->year }} {{ setting('site_name') }}. {{ $footer->copyright_text ?? '' }}</p>

            <div class="flex gap-6">
                <a href="{{ route('page.show', 'privacy-policy') }}">Privacy</a>
                <a href="{{ route('page.show', 'terms-conditions') }}">Terms</a>
                <a href="{{ route('page.show', 'support') }}">Support</a>
            </div>
            <p>Developed & Maintained <a style="color:cadetblue;" href="{{ $footer->developer_url }}"
                    target="_blank">{{ $footer->developer_info }}</a></p>
        </div>
    </div>
</footer>
