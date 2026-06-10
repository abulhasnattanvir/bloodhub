<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ setting('site_name', 'ESW Admin') }}</title>

    @if (setting('favicon'))
        <link rel="icon" href="{{ asset('storage/' . setting('favicon')) }}">
    @endif

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #dc2626, #991b1b);
            border-radius: 12px;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50" x-data="{
    mobileSidebar: false,
    blogOpen: @js(request()->routeIs('admin.blog.*', 'admin.blog.categories.*', 'admin.blog.tags.*'))
}">
    <div class="flex h-screen overflow-hidden">
        <!-- ================= MOBILE SIDEBAR (Overlay) ================= -->
        <div x-show="mobileSidebar" class="fixed inset-0 bg-black/60 z-50 md:hidden" @click="mobileSidebar = false">
        </div>

        <!-- Mobile Sidebar -->
        <aside x-show="mobileSidebar"
            class="fixed inset-y-0 left-0 w-72 bg-white shadow-2xl z-[60] md:hidden flex flex-col transform transition-transform duration-300"
            :class="{ '-translate-x-full': !mobileSidebar }">

            <!-- Logo -->
            <div class="p-6 border-b bg-red-600 text-white">
                <a href="{{ route('home') }}" class="flex items-center justify-center">
                    @if (setting('logo'))
                        <img src="{{ asset('storage/' . setting('logo')) }}" width="150" alt="Logo">
                    @else
                        <span class="text-xl font-bold">{{ setting('site_name', 'TawakkulSoft') }}</span>
                    @endif
                </a>
            </div>

            <!-- Menu (Same as desktop) -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto custom-scrollbar">
                @include('layouts.partials.admin-sidebar-menu') <!-- Optional: move menu to partial -->
                <!-- Or keep your menu here (same as below) -->
                <!-- ... your all menu items ... -->
            </nav>

            <!-- User Profile -->
            <div class="border-t p-5 bg-gray-50">
                @include('layouts.partials.admin-sidebar-userprofile')
            </div>
        </aside>

        <!-- ================= DESKTOP SIDEBAR ================= -->
        {{-- <aside class="w-72 bg-white border-r shadow-xl hidden md:flex flex-col h-full"> --}}
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
                @include('layouts.partials.admin-sidebar-menu')
            </nav>

            {{-- USER PROFILE SECTION  --}}
            <div class="border-t p-5 bg-gray-50">
                @include('layouts.partials.admin-sidebar-userprofile')
            </div>
        </aside>

        {{--  ================= MAIN AREA =================  --}}
        <div class="flex-1 flex flex-col overflow-hidden">
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
                © {{ date('Y') }} ESW Admin
            </footer>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    @stack('scripts')
</body>

</html>
