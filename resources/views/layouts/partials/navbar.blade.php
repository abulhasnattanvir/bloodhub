<nav class="bg-red-600 shadow-lg sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                @if (setting('logo'))
                    <img src="{{ asset('storage/' . setting('logo')) }}" width="180px" alt="Logo">
                @else
                    <span class="text-white text-xl font-bold">
                        {{ setting('site_name', 'BloodHub') }}
                    </span>
                @endif
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-2 flex-1 justify-end">
                @foreach ($menus as $menu)
                    @if ($menu->children->count())
                        <!-- Dropdown Parent -->
                        <div class="relative group">

                            <!-- PARENT LINK -->
                            <a href="{{ url($menu->url) }}"
                                class="px-4 py-2 rounded-lg flex items-center gap-2 whitespace-nowrap transition
          {{ $menu->isActive() ? 'bg-red-700 text-white' : 'text-white hover:bg-red-700' }}">

                                {{ $menu->title }}
                                <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                            </a>

                            <!-- DROPDOWN -->
                            <div
                                class="absolute left-0 top-full mt-2 min-w-[220px] rounded-xl shadow-xl opacity-0 invisible bg-red group-hover:opacity-100 group-hover:visible
                        transition-all duration-200 z-50">

                                @foreach ($menu->children as $child)
                                    <a href="{{ url($child->url) }}"
                                        class="block px-4 py-3 transition hover:bg-red-50
                              {{ $child->isActive() ? 'bg-red-700 text-white' : 'text-gray-700' }}">
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <!-- Simple Link -->
                        <a href="{{ url($menu->url) }}"
                            class="px-4 py-2 rounded-lg whitespace-nowrap transition
                  {{ $menu->isActive() ? 'bg-red-700 text-white' : 'text-white hover:bg-red-700' }}">
                            {{ $menu->title }}
                        </a>
                    @endif
                @endforeach

            </div>

            <!-- Mobile Button -->
            <button @click="open = true" class="md:hidden text-white text-2xl flex-shrink-0">
                <i class="fas fa-bars"></i>
            </button>

        </div>
    </div>


    <!-- Overlay -->
    <div x-show="open" x-cloak x-transition.opacity class="fixed inset-0 bg-black/50 z-40 md:hidden"
        @click="open = false">
    </div>

    <!-- Mobile Sidebar -->
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0
        w-[320px] max-w-[85vw]
        h-full bg-white
        shadow-2xl
        z-50
        overflow-y-auto
        md:hidden">

        <!-- Header -->
        <div class="flex items-center justify-between p-4 border-b">

            <h3 class="font-bold text-lg">
                Menu
            </h3>

            <button @click="open = false" class="text-gray-700 text-xl">

                <i class="fas fa-times"></i>

            </button>

        </div>

        <!-- Menu Items -->
        <div class="p-3">

            @foreach ($menus as $menu)
                <div x-data="{ submenu: false }" class="border-b border-gray-100">

                    @if ($menu->children->count())
                        <button @click="submenu = !submenu"
                            class="w-full flex items-center justify-between py-3 px-2 rounded-lg hover:bg-gray-100">

                            <span>
                                {{ $menu->title }}
                            </span>

                            <i class="fas fa-chevron-down transition-transform duration-200"
                                :class="{ 'rotate-180': submenu }">
                            </i>

                        </button>

                        <div x-show="submenu" x-collapse class="pb-2">

                            @foreach ($menu->children as $child)
                                <a href="{{ url($child->url) }}"
                                    class="block pl-6 py-2 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-600">

                                    {{ $child->title }}

                                </a>
                            @endforeach

                        </div>
                    @else
                        <a href="{{ url($menu->url) }}"
                            class="block py-3 px-2 rounded-lg hover:bg-red-50 hover:text-red-600">

                            {{ $menu->title }}

                        </a>
                    @endif

                </div>
            @endforeach

        </div>

    </div>

</nav>
