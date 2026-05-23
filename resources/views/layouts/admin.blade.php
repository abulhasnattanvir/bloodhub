<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BloodHub Admin') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Alpine.js for mobile menu -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col">
            <!-- Mobile Navbar -->
            <nav class="hidden md:hidden bg-white border-b border-gray-200 px-4 py-3 z-50">
                <div class="flex items-center justify-between w-full">
                    <!-- Logo -->
                    <a href="{{ url('/admin/dashboard') }}" class="flex items-center space-x-2">
                        <span class="text-xl font-semibold text-gray-900">BloodHub Admin</span>
                    </a>
                    
                    <!-- Mobile Menu Button -->
                    <button @click="open = !open" class="p-2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </nav>

            <!-- Desktop Layout -->
            <div class="hidden md:flex flex-1">
                <!-- Sidebar -->
                <nav class="w-64 bg-white border-r border-gray-200 flex-shrink-0">
                    <div class="flex-shrink-0 flex items-center px-4 py-4 border-b border-gray-200">
                        <a href="{{ url('/admin/dashboard') }}" class="text-xl font-semibold text-gray-900">
                            BloodHub Admin
                        </a>
                    </div>
                    
                    <div class="mt-6 space-y-2 px-4">
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
        
                        <a href="{{ route('admin.donors.index') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.donors.*') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                            <i class="fas fa-users mr-3"></i>
                            <span>All Donors</span>
                        </a>
        
                        <a href="{{ route('admin.donors.create') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.donors.create') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                            <i class="fas fa-user-plus mr-3"></i>
                            <span>Add Donor</span>
                        </a>
        
                        <a href="{{ route('admin.blood-groups.index') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.blood-groups.*') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                            <i class="fas fa-tint mr-3"></i>
                            <span>Blood Groups</span>
                        </a>
        
                        <a href="{{ route('admin.settings.index') }}"
                           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                            <i class="fas fa-cog mr-3"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                    
                    <div class="mt-auto pt-6 px-4 border-t border-gray-200">
                        <div class="flex items-center px-3 py-2 text-sm font-medium text-gray-500">
                            <img src="{{ Storage::url(Auth::user()->profile_photo ?? 'default-profile.png') }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="h-8 w-8 rounded-full mr-3">
                            <div>
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
        
                        <form method="POST" action="{{ route('logout') }}" class="mt-3 w-full">
                            @csrf
                            <button type="submit"
                                    class="flex w-full items-center px-3 py-2 text-sm font-medium text-left text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </nav>
                
                <!-- Main Content -->
                <div class="flex-1 flex flex-col overflow-hidden">
                    <!-- Header -->
                    <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Mobile Menu Toggle (hidden on desktop) -->
                            <button @click="open = !open" class="md:hidden p-2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-bars"></i>
                            </button>
                            
                            <h1 class="text-xl font-semibold text-gray-900">
                                @isset($header)
                                    {{ $header }}
                                @else
                                    Dashboard
                                @endisset
                            </h1>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <!-- Search -->
                            <div class="relative w-64">
                                <input type="text" 
                                       placeholder="Search..." 
                                       class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none transition-all duration-200 text-sm">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                            
                            <!-- Notifications -->
                            <div class="relative">
                                <button class="p-2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-bell"></i>
                                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"></span>
                                </button>
                            </div>
                            
                            <!-- User Profile -->
                            <div class="relative">
                                <button @click="userMenuOpen = !userMenuOpen" class="p-2 text-gray-500 hover:text-gray-700">
                                    <img src="{{ Storage::url(Auth::user()->profile_photo ?? 'default-profile.png') }}" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="h-8 w-8 rounded-full">
                                </button>
                                
                                <!-- User Menu Dropdown -->
                                <div x-show="userMenuOpen" @click.away="userMenuOpen = false" 
                                     class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg py-1 z-20">
                                    <a href="{{ route('profile.edit') }}" 
                                       class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        <i class="fas fa-user mr-3"></i>
                                        <span>Profile</span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}" class="mb-0">
                                        @csrf
                                        <button type="submit" 
                                                class="flex w-full items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>
                    
                    <!-- Page Content -->
                    <main class="flex-1 overflow-y-auto p-6">
                        @yield('content')
                    </main>
                    
                    <!-- Footer -->
                    <footer class="bg-white border-t border-gray-200 px-6 py-4 text-center text-sm text-gray-500">
                        &copy; {{ now()->year }} BloodHub. All rights reserved.
                    </footer>
                </div>
            </div>
            
            <!-- Mobile Sidebar -->
            <div :class="{'block': open, 'hidden': !open}" 
                 class="fixed inset-0 z-40 flex flex-col bg-white border-r border-gray-200">
                <div class="flex-shrink-0 flex items-center px-4 py-4 border-b border-gray-200">
                    <a href="{{ url('/admin/dashboard') }}" class="text-xl font-semibold text-gray-900">
                        BloodHub Admin
                    </a>
                    <button @click="open = false" class="ml-auto p-2 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="mt-6 space-y-2 px-4 flex-1 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        <span>Dashboard</span>
                    </a>
        
                    <a href="{{ route('admin.donors.index') }}"
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.donors.*') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                        <i class="fas fa-users mr-3"></i>
                        <span>All Donors</span>
                    </a>
        
                    <a href="{{ route('admin.donors.create') }}"
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.donors.create') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                        <i class="fas fa-user-plus mr-3"></i>
                        <span>Add Donor</span>
                    </a>
        
                    <a href="{{ route('admin.blood-groups.index') }}"
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.blood-groups.*') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                        <i class="fas fa-tint mr-3"></i>
                        <span>Blood Groups</span>
                    </a>
        
                    <a href="{{ route('admin.settings.index') }}"
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white' : '' }} rounded-lg transition-colors duration-200">
                        <i class="fas fa-cog mr-3"></i>
                        <span>Settings</span>
                    </a>
                </div>
                
                <div class="pt-6 px-4 border-t border-gray-200">
                    <div class="flex items-center px-3 py-2 text-sm font-medium text-gray-500">
                        <img src="{{ Storage::url(Auth::user()->profile_photo ?? 'default-profile.png') }}" 
                             alt="{{ Auth::user()->name }}" 
                             class="h-8 w-8 rounded-full mr-3">
                        <div>
                            <div class="font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
            
                    <form method="POST" action="{{ route('logout') }}" class="mt-3 w-full">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center px-3 py-2 text-sm font-medium text-left text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                            <i class="fas fa-sign-out-alt mr-3"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('app', () => ({
                    open: false,
                    userMenuOpen: false
                }))
            })
        </script>
    </body>
</html>