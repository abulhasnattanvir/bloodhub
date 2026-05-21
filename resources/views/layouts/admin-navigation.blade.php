<nav class="flex-shrink-0 w-64 bg-white border-r border-gray-200">
    <div class="flex-shrink-0 flex items-center px-4 py-4">
        <a href="{{ url('/admin/dashboard') }}" class="text-xl font-semibold text-gray-900">
            BloodHub Admin
        </a>
    </div>

    <div class="mt-6 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white' : '' }} rounded-lg">
            <i class="fas fa-tachometer-alt mr-3"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.donors.index') }}"
           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.donors.*') ? 'bg-primary text-white' : '' }} rounded-lg">
            <i class="fas fa-users mr-3"></i>
            <span>All Donors</span>
        </a>

        <a href="{{ route('admin.donors.create') }}"
           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.donors.create') ? 'bg-primary text-white' : '' }} rounded-lg">
            <i class="fas fa-user-plus mr-3"></i>
            <span>Add Donor</span>
        </a>

        <a href="{{ route('admin.blood-groups.index') }}"
           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.blood-groups.*') ? 'bg-primary text-white' : '' }} rounded-lg">
            <i class="fas fa-tint mr-3"></i>
            <span>Blood Groups</span>
        </a>

        <a href="{{ route('admin.settings.index') }}"
           class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white' : '' }} rounded-lg">
            <i class="fas fa-cog mr-3"></i>
            <span>Settings</span>
        </a>

        <div class="border-t border-gray-200 pt-4">
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
                        class="flex w-full items-center px-3 py-2 text-sm font-medium text-left text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</nav>