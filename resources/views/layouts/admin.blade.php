<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site_name', 'BloodHub Admin') }}</title>

    @if (setting('favicon'))
        <link rel="icon" href="{{ asset('storage/' . setting('favicon')) }}">
    @endif

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased bg-gray-50" x-data="{ mobileSidebar: false }">

    <script>
        window.addEventListener('load', () => document.body.style.opacity = 1);
    </script>

    <div class="flex h-screen overflow-hidden">

        <!-- ================= SIDEBAR (Desktop Always Visible) ================= -->
        <aside class="w-72 bg-white border-r shadow-xl hidden md:flex flex-col h-full">

            <!-- Logo -->
            <div class="p-6 border-b flex items-center gap-3 bg-red-600 text-white">
                <div class="w-10 h-10 bg-white/20 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-tint text-3xl"></i>
                </div>
                <span class="font-bold text-2xl">BloodHub</span>
            </div>

            <!-- Menu -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-home w-5"></i> Dashboard
                </a>
                <a href="{{ route('admin.donors.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.donors.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-users w-5"></i> Donors
                </a>
                <a href="{{ route('admin.members.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.members.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-user-friends w-5"></i> Members
                </a>
                <a href="{{ route('admin.council.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.council.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-user-tie w-5"></i> Council
                </a>
                <a href="{{ route('admin.donations.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.donations.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-hand-holding-dollar w-5"></i> Donations
                </a>
                <a href="{{ route('admin.blood-groups.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.blood-groups.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-tint w-5"></i> Blood Groups
                </a>

                <div class="pt-6 mt-6 border-t">
                    <a href="{{ route('admin.pages.index') }}"
                        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.pages.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                        <i class="fa-solid fa-pager mr-3"></i> Page
                    </a>

                    <a href="{{ route('admin.settings.index') }}"
                        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.settings.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                        <i class="fas fa-cogs w-5"></i> Site Settings
                    </a>
                    <a href="{{ route('admin.footer.edit') }}"
                        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.footer.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                        <i class="fas fa-cog w-5"></i> Footer Settings
                    </a>
                    <a href="{{ route('admin.menus.index') }}"
                        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.menus.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                        <i class="fas fa-bars mr-3"></i>
                        Menu Manager
                    </a>
                    <a href="{{ route('admin.sliders.index') }}"
                        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.sliders.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                        <i class="fas fa-sliders-h mr-3"></i> Sliders
                    </a>
                </div>
            </nav>

            {{-- USER PROFILE SECTION  --}}
            <div class="border-t p-5 bg-gray-50">
                <div class="flex items-center gap-3 mb-4">
                    @if (Auth::user()->profile_image)
                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                            class="w-11 h-11 rounded-2xl object-cover border-2 border-white shadow-sm">
                    @else
                        <div class="w-11 h-11 bg-gray-200 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-user text-gray-500"></i>
                        </div>
                    @endif>
                    <div class="flex-1">
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.profile.edit') }}"
                        class="flex-1 text-center py-2.5 text-sm font-medium bg-white border border-gray-300 hover:bg-gray-50 rounded-2xl transition">
                        <i class="fas fa-user mr-1"></i> Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="flex-1">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to logout?')"
                            class="w-full py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 border border-red-200 rounded-2xl transition">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
        </aside>

        {{--  ================= MAIN AREA =================  --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Header -->
            <header class="bg-white border-b px-6 py-5 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button @click="mobileSidebar = !mobileSidebar" class="md:hidden text-2xl text-gray-600">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-2xl font-semibold text-gray-800">
                        @isset($header)
                            {{ $header }}
                        @else
                            Dashboard
                        @endisset
                    </h1>
                </div>

                <div class="flex items-center gap-5">
                    <button class="text-xl text-gray-600">
                        <i class="fas fa-bell"></i>
                    </button>
                    <a href="#" onclick="if(confirm('Logout?')) document.getElementById('logout-form').submit()"
                        class="text-red-600 hover:text-red-700">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-auto p-6 bg-gray-50">
                @yield('content')
            </main>

            <footer class="bg-white border-t py-4 text-center text-sm text-gray-500">
                © {{ date('Y') }} BloodHub Admin
            </footer>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> --}}
    @stack('scripts')
</body>

</html>
