<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site_name', 'Tawkkul Soft') }}</title>
    @if (setting('favicon'))
        <link rel="icon" href="{{ asset('storage/' . setting('favicon')) }}">
    @endif

    <!-- FONT -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- FONT AWESOME -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- VITE -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- PREVENT BLACK FLASH (IMPORTANT) -->
    <style>
        html {
            background: #f9fafb;
        }

        body {
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
        }
    </style>

    <script>
        // Dark mode BEFORE render (fix flicker)
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>

</head>

<body class="font-sans antialiased bg-gray-50" x-data="{ open: false, userMenu: false }">

    <script>
        // remove flash
        window.addEventListener('load', function() {
            document.body.style.opacity = 1;
        });
    </script>

    <div class="min-h-screen flex">

        <!-- ================= MOBILE OVERLAY ================= -->
        <div x-show="open" @click="open = false" class="fixed inset-0 bg-black/40 z-40" x-transition></div>

        <!-- ================= MOBILE SIDEBAR ================= -->
        <aside x-show="open" x-transition class="fixed left-0 top-0 w-72 h-full bg-white shadow-xl z-50">

            <div class="flex justify-between items-center p-4 border-b">
                <h2 class="font-bold">Menu</h2>
                <button @click="open = false"><i class="fas fa-times"></i></button>
            </div>

            <nav class="p-4 space-y-2">

                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Dashboard</a>
                <a href="{{ route('admin.donors.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Donors</a>
                <a href="{{ route('admin.sliders.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100">Sliders</a>
                <a href="{{ route('admin.blood-groups.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100">Blood Groups</a>
                <a href="{{ route('admin.settings.index') }}"
                    class="block px-3 py-2 rounded hover:bg-gray-100">Settings</a>
                <a href="{{ route('admin.pages.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Pages</a>

            </nav>

            <!-- PROFILE -->
            <div class="border-t p-4">

                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ Storage::url(Auth::user()->profile_photo ?? 'default.png') }}"
                        class="w-10 h-10 rounded-full">
                    <div>
                        <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm hover:bg-gray-100 rounded">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>

            </div>

        </aside>

        <!-- ================= SIDEBAR (DESKTOP) ================= -->
        <aside class="hidden md:flex w-64 bg-white border-r flex-col">

            <div class="p-4 border-b">
                <a href="{{ route('admin.dashboard') }}" class="font-bold text-lg">
                    BloodHub Admin
                </a>
            </div>

            <nav class="flex-1 p-3 space-y-1">

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-home mr-3"></i> Dashboard
                </a>

                <a href="{{ route('admin.donors.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.donors.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-users mr-3"></i> Donors
                </a>

                <a href="{{ route('admin.sliders.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.sliders.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-sliders-h mr-3"></i> Sliders
                </a>

                <a href="{{ route('admin.blood-groups.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.blood-groups.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-tint mr-3"></i> Blood Groups
                </a>

                <a href="{{ route('admin.settings.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.settings.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-gears mr-2"></i> Site Setting
                </a>

                <a href="{{ route('admin.pages.index') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.pages.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-pager mr-3"></i> Page
                </a>

                <a href="{{ route('admin.footer.edit') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.footer.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-pager mr-3"></i> Footer Setting
                </a>

                <a href="{{ route('admin.members.create') }}"
                    class="flex items-center px-3 py-2 rounded-lg text-sm
               {{ request()->routeIs('admin.footer.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-pager mr-3"></i> Member
                </a>

            </nav>

            <!-- DESKTOP PROFILE -->
            <div class="border-t p-4">

                <div class="flex items-center gap-3 mb-3">
                    <img src="{{ Storage::url(Auth::user()->profile_photo ?? 'default.png') }}"
                        class="w-10 h-10 rounded-full">
                    <div>
                        <div class="text-sm font-semibold">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm hover:bg-gray-100 rounded">
                    <i class="fas fa-user mr-2"></i> Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>

            </div>

        </aside>

        <!-- ================= MAIN ================= -->
        <div class="flex-1 flex flex-col">

            <!-- HEADER -->
            <header class="bg-white border-b px-4 py-3 flex justify-between items-center">

                <div class="flex items-center gap-3">
                    <button @click="open = true" class="md:hidden text-xl">
                        <i class="fas fa-bars"></i>
                    </button>

                    <h1 class="font-semibold text-lg">
                        @isset($header)
                            {{ $header }}
                        @else
                            Dashboard
                        @endisset
                    </h1>
                </div>

                <div class="flex items-center gap-4">

                    <!-- SEARCH -->
                    <input type="text" placeholder="Search..."
                        class="hidden md:block border rounded-lg px-3 py-2 text-sm">

                    <!-- NOTIFICATION -->
                    <button class="relative">
                        <i class="fas fa-bell"></i>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- PROFILE DROPDOWN -->
                    <div x-data="{ drop: false }" class="relative">

                        <button @click="drop = !drop">
                            <img src="{{ Storage::url(Auth::user()->profile_photo ?? 'default.png') }}"
                                class="w-8 h-8 rounded-full">
                        </button>

                        <div x-show="drop" @click.away="drop = false"
                            class="absolute right-0 mt-2 w-40 bg-white border rounded shadow">

                            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-sm hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            </header>

            <!-- CONTENT -->
            <main class="p-4 md:p-6 flex-1">
                @yield('content')
            </main>

            <!-- FOOTER -->
            <footer class="bg-white border-t text-center text-sm py-3 text-gray-500">
                © {{ date('Y') }} BloodHub
            </footer>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @stack('scripts')
</body>

</html>
