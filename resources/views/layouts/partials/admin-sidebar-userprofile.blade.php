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
