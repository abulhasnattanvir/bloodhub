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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: linear-gradient(180deg, #f8f9fa, #e9ecef);
            border-radius: 12px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #dc2626, #991b1b);
            border-radius: 12px;
            border: 2px solid #f8f9fa;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #ef4444, #b91c1c);
        }
    </style>
    <!-- Alpine.js -->
</head>

<body class="font-sans antialiased bg-gray-50" x-data="{ mobileSidebar: false }">

    <script>
        window.addEventListener('load', () => document.body.style.opacity = 1);
    </script>

    <div class="flex h-screen overflow-hidden">

        <!-- ================= SIDEBAR (Desktop Always Visible) ================= -->
        <aside class="w-72 bg-white border-r shadow-xl hidden md:flex flex-col h-full">

            <!-- Logo -->
            <div class="p-6 border-b flex items-center justify-center gap-3 bg-red-600 text-white text-center">
                <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                    @if (setting('logo'))
                        <img src="{{ asset('storage/' . setting('logo')) }}" width="150px" alt="Logo">
                    @else
                        <span class="text-white text-xl font-bold">
                            {{ setting('site_name', 'TawakkulSoft') }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Menu -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto custom-scrollbar">
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
                <a href="{{ route('admin.goals.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.goals.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-crosshairs"></i> Goles
                </a>
                <a href="{{ route('admin.activities.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.activities.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-fire"></i> Activities
                </a>
                <a href="{{ route('admin.faqs.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.faqs.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-circle-question"></i> Faqs
                </a>
                <a href="{{ route('admin.finance.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.finance.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-circle-question"></i> Finance
                </a>
                <a href="{{ route('admin.fees.index') }}"
                    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.fees.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
                    <i class="fa-solid fa-circle-question"></i> Fee Structures
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
            <!-- Top Header -->
            <header class="bg-white border-b shadow-sm px-6 py-4 flex items-center justify-between sticky top-0 z-50">
                <div class="flex items-center gap-4">
                    <!-- Mobile Menu Button -->
                    <button @click="mobileSidebar = !mobileSidebar"
                        class="md:hidden text-2xl text-gray-600 hover:text-gray-800 transition">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-2xl font-semibold text-gray-800">
                        @isset($header)
                            {{ $header }}
                        @else
                            Dashboard
                        @endisset
                    </h1>
                </div>

                <div class="flex items-center gap-3">

                    <!-- View Website Button -->
                    <a href="{{ url('/') }}" target="_blank"
                        class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition text-sm font-medium">
                        <i class="fas fa-globe"></i>
                        <span class="hidden sm:inline">View Website</span>
                    </a>

                    <!-- Notification -->
                    <button
                        class="relative p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition">
                        <i class="fas fa-bell text-xl"></i>
                        <!-- Notification Badge (Optional) -->
                        <!-- <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[10px] flex items-center justify-center rounded-full">3</span> -->
                    </button>

                    <!-- Logout -->
                    <a href="#"
                        onclick="if(confirm('Are you sure you want to logout?')) document.getElementById('logout-form').submit()"
                        class="flex items-center gap-2 px-4 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-xl transition text-sm font-medium">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </a>

                </div>
            </header>

            <!-- Logout Form (Place this anywhere in your layout) -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>

    @stack('scripts')
</body>

</html>
