<footer class="relative bg-gradient-to-br from-gray-900 via-red-950 to-black text-white pt-16 pb-8 overflow-hidden">

    <!-- Background Blur -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-red-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-red-500/10 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-4">

        <!-- Main Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">

            <!-- About -->
            <div>
                <a href="{{ route('home') }}" class="text-white text-2xl font-bold tracking-wide pb-12 d-flex">
                    @if (setting('logo'))
                        <img src="{{ asset('storage/' . setting('logo')) }}" class="h-10" alt="Logo">
                    @else
                        <h2 class="text-3xl font-extrabold mb-4 text-white">
                            {{ setting('site_name', 'BloodHub') }}
                        </h2>
                    @endif
                </a>

                <p class="text-gray-300 leading-relaxed mb-6">
                    {{ __('app.footer.about_description') }}
                </p>

                <!-- Social Icons -->
                <div class="flex items-center gap-4">

                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                        <i class="fab fa-facebook-f"></i>
                    </a>

                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                        <i class="fab fa-twitter"></i>
                    </a>

                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="#"
                        class="w-10 h-10 rounded-full bg-white/10 hover:bg-red-600 transition flex items-center justify-center">

                        <i class="fab fa-linkedin-in"></i>
                    </a>

                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-xl font-bold mb-5">
                    {{ __('app.footer.quick_links') }}
                </h3>

                <ul class="space-y-3">

                    <li>
                        <a href="{{ route('home') }}"
                            class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                            <i class="fas fa-angle-right text-sm"></i>
                            {{ __('app.home') }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('search') }}"
                            class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                            <i class="fas fa-angle-right text-sm"></i>
                            {{ __('app.search_donors') }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('donors.list') }}"
                            class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                            <i class="fas fa-angle-right text-sm"></i>
                            {{ __('app.donor_list') }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('about') }}"
                            class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                            <i class="fas fa-angle-right text-sm"></i>
                            {{ __('app.about') }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-gray-300 hover:text-red-400 transition flex items-center gap-2">

                            <i class="fas fa-angle-right text-sm"></i>
                            {{ __('app.contact') }}
                        </a>
                    </li>

                </ul>
            </div>

            <!-- Emergency -->
            <div>
                <h3 class="text-xl font-bold mb-5">
                    {{ __('app.footer.emergency') }}
                </h3>

                <div class="space-y-4">

                    <div class="flex items-start gap-3">
                        <div class="text-red-500 mt-1">
                            <i class="fas fa-phone-alt"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400">24/7 Hotline</p>
                            <h4 class="font-semibold">{{ setting('phone') }}</h4>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="text-red-500 mt-1">
                            <i class="fas fa-envelope"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400">Email Address</p>
                            <h4 class="font-semibold">{{ setting('email') }}</h4>
                        </div>
                    </div>

                    <div class="flex items-start gap-3">
                        <div class="text-red-500 mt-1">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>

                        <div>
                            <p class="text-sm text-gray-400">Location</p>
                            <h4 class="font-semibold">
                                {{ setting('address') }}
                            </h4>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-xl font-bold mb-5">
                    {{ __('app.footer.stay_updated') }}
                </h3>

                <p class="text-gray-300 mb-5">
                    {{ __('app.footer.get_updates_description') }}
                </p>

                <form class="space-y-4">

                    <input type="email" placeholder="Enter your email"
                        class="w-full px-4 py-3 rounded-xl bg-white/10 border border-white/10 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500">

                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 transition px-4 py-3 rounded-xl font-semibold shadow-lg">

                        Subscribe Now
                    </button>

                </form>
            </div>

        </div>

        <!-- Bottom -->
        <div class="pt-8 flex flex-col md:flex-row items-center justify-between gap-4">

            <p class="text-gray-400 text-sm text-center md:text-left">
                © {{ now()->year }} {{ setting('site_name', 'TawakkulSoft') }}.
                {{ setting('footer_text') }}
            </p>

            <div class="flex items-center gap-6 text-sm">

                <a href="{{ route('page.show', 'privacy-policy') }}"
                    class="text-gray-400 hover:text-red-400 transition">
                    Privacy Policy
                </a>

                <a href="{{ route('page.show', 'terms-conditions') }}"
                    class="text-gray-400 hover:text-red-400 transition">
                    Terms & Conditions
                </a>

                <a href="{{ route('page.show', 'support') }}" class="text-gray-400 hover:text-red-400 transition">
                    Support
                </a>

            </div>
        </div>

    </div>
</footer>
