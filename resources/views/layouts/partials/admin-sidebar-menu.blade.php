@can('dashboard.view')
    <a href="{{ route('admin.dashboard') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fas fa-home w-5"></i> Dashboard
    </a>
@endcan

<a href="{{ route('admin.donors.index') }}"
    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.donors.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
    <i class="fas fa-users w-5"></i> Donors
</a>
@can('member.view')
    <a href="{{ route('admin.members.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.members.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fas fa-user-friends w-5"></i> Members
    </a>
@endcan
@can('council.view')
    <a href="{{ route('admin.council.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.council.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fas fa-user-tie w-5"></i> Council
    </a>
@endcan
@can('donation.view')
    <a href="{{ route('admin.donations.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.donations.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fas fa-hand-holding-dollar w-5"></i> Donations
    </a>
@endcan
<a href="{{ route('admin.blood-groups.index') }}"
    class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.blood-groups.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
    <i class="fas fa-tint w-5"></i> Blood Groups
</a>
@can('goal.view')
    <a href="{{ route('admin.goals.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.goals.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-crosshairs"></i> Goals
    </a>
@endcan
@can('activity.view')
    <a href="{{ route('admin.activities.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.activities.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-fire"></i> Activities
    </a>
@endcan
@can('finance.view')
    <a href="{{ route('admin.finance.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.finance.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-dollar-sign"></i> Finance
    </a>
@endcan
@can('fee.view')
    <a href="{{ route('admin.fees.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.fees.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-money-bill"></i> Fee Structures
    </a>
@endcan
@can('message.view')
    <a href="{{ route('admin.messages.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.messages.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-regular fa-message"></i> Messages
    </a>
@endcan
@can('gallery.view')
    <a href="{{ route('admin.gallery.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.gallery.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-photo-film"></i> Gallery
    </a>
@endcan
@can('video.view')
    <a href="{{ route('admin.videos.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.videos.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-photo-film"></i> Videos
    </a>
@endcan
@can('green.view')
    <a href="{{ route('admin.green.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.green.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-leaf"></i> Green
    </a>
@endcan

{{-- ================= BLOG WITH SUBMENU ================= --}}
@can('blog.view')
    <div x-data="{
        open: {{ request()->routeIs('admin.blog.*', 'admin.blog.categories.*', 'admin.blog.tags.*') ? 'true' : 'false' }}
    }" class="space-y-1">
        <button @click="open = !open"
            class="w-full flex items-center justify-between gap-3 px-5 py-3 rounded-2xl text-sm hover:bg-gray-100 transition-all"
            :class="{ 'bg-green-200 text-black': open }">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-blog w-5"></i>
                Blog
            </div>
            <i class="fas fa-chevron-right transition-transform duration-200" :class="{ 'rotate-90': open }"></i>
        </button>

        <!-- Submenu -->
        <div x-show="open" x-collapse class="pl-10 space-y-1">

            <a href="{{ route('admin.blog.index') }}"
                class="flex items-center gap-3 px-5 py-2.5 rounded-2xl text-sm {{ request()->routeIs('admin.blog.index', 'admin.blog.edit') ? 'bg-red-100 text-red-700 font-medium' : 'hover:bg-gray-100' }}">
                <i class="fa-solid fa-list-ul w-4"></i> All Posts
            </a>

            <a href="{{ route('admin.blog.create') }}"
                class="flex items-center gap-3 px-5 py-2.5 rounded-2xl text-sm {{ request()->routeIs('admin.blog.create') ? 'bg-red-100 text-red-700 font-medium' : 'hover:bg-gray-100' }}">
                <i class="fa-solid fa-plus w-4"></i> Add New Post
            </a>

            <a href="{{ route('admin.blog.categories.index') }}"
                class="flex items-center gap-3 px-5 py-2.5 rounded-2xl text-sm {{ request()->routeIs('admin.blog.categories.*') ? 'bg-red-100 text-red-700 font-medium' : 'hover:bg-gray-100' }}">
                <i class="fa-solid fa-tags w-4"></i> Categories
            </a>

            <a href="{{ route('admin.blog.tags.index') }}"
                class="flex items-center gap-3 px-5 py-2.5 rounded-2xl text-sm {{ request()->routeIs('admin.blog.tags.*') ? 'bg-red-100 text-red-700 font-medium' : 'hover:bg-gray-100' }}">
                <i class="fa-solid fa-tag w-4"></i> Tags
            </a>

        </div>
    </div>
@endcan
@can('faq.view')
    <a href="{{ route('admin.faqs.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.faqs.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-solid fa-circle-question"></i> Faqs
    </a>
@endcan
<div class="pt-6 mt-6 border-t">
    <!-- User Management -->
    @can('users.view')
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.users.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-users mr-3"></i>
            User Management
        </a>
    @endcan

    <!-- Role Assignment -->
    @can('userrole.index')
        <a href="{{ route('admin.userrole.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.userrole.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-user-tag mr-3"></i>
            Role Assignment
        </a>
    @endcan

    <!-- User Modual Set -->
    @can('usermodule.view')
        <a href="{{ route('admin.usermodule.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.usermodule.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-shield-halved mr-3"></i>
            User Modual
        </a>
    @endcan

    @can('page.view')
        <a href="{{ route('admin.pages.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.pages.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-pager mr-3"></i>Page
        </a>
    @endcan
    @can('contact.edit')
        <a href="{{ route('admin.contact.edit') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.contact.edit') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fa-solid fa-address-book"></i>Contact Settings
        </a>
    @endcan
    @can('settings.view')
        <a href="{{ route('admin.settings.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.settings.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fas fa-cogs w-5"></i> Site Settings
        </a>
    @endcan
    @can('footer.edit')
        <a href="{{ route('admin.footer.edit') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.footer.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fas fa-cog w-5"></i> Footer Settings
        </a>
    @endcan
    @can('menu.view')
        <a href="{{ route('admin.menus.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.menus.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fas fa-bars mr-3"></i>
            Menu Manager
        </a>
    @endcan
    @can('slider.view')
        <a href="{{ route('admin.sliders.index') }}"
            class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.sliders.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
            <i class="fas fa-sliders-h mr-3"></i> Sliders
        </a>
    @endcan

    <a href="{{ route('admin.socialchat.edit') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.socialchat.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-brands fa-rocketchat"></i> Social Chat
    </a>

    <a href="{{ route('admin.notices.index') }}"
        class="flex items-center gap-3 px-5 py-3 rounded-2xl text-sm {{ request()->routeIs('admin.notices.*') ? 'bg-red-600 text-white' : 'hover:bg-gray-100' }}">
        <i class="fa-brands fa-rocketchat"></i> Notices
    </a>
</div>
