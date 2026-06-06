@extends('layouts.admin')

@section('content')
    <div class="py-6 md:py-10">
        <div class="max-w-8xl mx-auto px-4">

            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold">Footer Settings</h1>
                    <p class="text-gray-500">Manage all footer sections dynamically</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.footer.update') }}" class="space-y-10">
                @csrf
                @method('PUT')

                <!-- About -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-xl font-semibold mb-4">About Section</h3>
                    <textarea name="about_text" rows="4" class="w-full rounded-2xl border-gray-300 focus:border-red-500">{{ $footer->about_text ?? '' }}</textarea>
                </div>

                <!-- Social Links -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-xl font-semibold mb-4">Social Links</h3>
                    <div id="social-links" class="space-y-4">
                        @php $socialLinks = old('social_links', $footer->social_links ?? []); @endphp
                        @foreach ($socialLinks as $i => $link)
                            <div class="grid grid-cols-12 gap-3 items-end">
                                <input type="text" name="social_links[{{ $i }}][name]"
                                    value="{{ $link['name'] ?? '' }}" placeholder="Name" class="col-span-3 rounded-2xl">
                                <input type="url" name="social_links[{{ $i }}][url]"
                                    value="{{ $link['url'] ?? '' }}" placeholder="URL" class="col-span-4 rounded-2xl">
                                <input type="text" name="social_links[{{ $i }}][icon]"
                                    value="{{ $link['icon'] ?? '' }}" placeholder="Icon (fab fa-facebook)"
                                    class="col-span-4 rounded-2xl">
                                <button type="button" onclick="this.parentElement.remove()"
                                    class="col-span-1 text-red-500">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" onclick="addSocialLink()" class="mt-4 text-red-600 hover:underline">+ Add Social
                        Link</button>
                </div>

                <!-- Quick Links + Service Links + Footer Menus -->
                <div class="grid md:grid-cols-3 gap-6">
                    @include('admin.settings.partials.dynamic-links', [
                        'title' => 'Quick Links',
                        'name' => 'quick_links',
                        'data' => old('quick_links', $footer->quick_links ?? []),
                    ])
                    @include('admin.settings.partials.dynamic-links', [
                        'title' => 'Service Links',
                        'name' => 'service_links',
                        'data' => old('service_links', $footer->service_links ?? []),
                    ])
                    @include('admin.settings.partials.dynamic-links', [
                        'title' => 'Footer Menus',
                        'name' => 'footer_menus',
                        'data' => old('footer_menus', $footer->footer_menus ?? []),
                    ])
                </div>

                <!-- Subscribe Section -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-xl font-semibold mb-6 flex items-center gap-2">
                        <i class="fas fa-bell text-green-500"></i>
                        Newsletter / Subscribe Section
                    </h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Section Title</label>
                            <input type="text" name="subscribe_title" value="{{ $footer->subscribe_title ?? '' }}"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <input type="text" name="subscribe_text" value="{{ $footer->subscribe_text ?? '' }}"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Placeholder</label>
                            <input type="text" name="subscribe_placeholder"
                                value="{{ $footer->subscribe_placeholder ?? 'Enter your email address' }}"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                            <input type="text" name="subscribe_button_text"
                                value="{{ $footer->subscribe_button_text ?? 'Subscribe Now' }}"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="bg-white grid md:grid-cols-2 gap-6 mt-6 rounded-3xl p-8 shadow-sm">
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Copyright Text</h3>
                        <input type="text" name="copyright_text" value="{{ $footer->copyright_text ?? '' }}"
                            class="w-full rounded-2xl"
                            placeholder="© {{ now()->year }} Your Company. All rights reserved.">
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-4">Developer Info</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <input type="text" name="developer_info" value="{{ $footer->developer_info ?? '' }}"
                                class="w-full rounded-2xl" placeholder="Developed & Maintained Company">
                            <input type="text" name="developer_url" value="{{ $footer->developer_url ?? '' }}"
                                class="w-full rounded-2xl" placeholder="Company url link">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-10 py-4 bg-red-600 text-white rounded-2xl font-semibold hover:bg-red-700">
                        Save All Footer Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addSocialLink() {
            const container = document.getElementById('social-links');
            const index = container.children.length;
            const div = document.createElement('div');
            div.className = 'grid grid-cols-12 gap-3 items-end';
            div.innerHTML = `
        <input type="text" name="social_links[${index}][name]" placeholder="Name" class="col-span-3 rounded-2xl">
        <input type="url" name="social_links[${index}][url]" placeholder="URL" class="col-span-4 rounded-2xl">
        <input type="text" name="social_links[${index}][icon]" placeholder="Icon class" class="col-span-4 rounded-2xl">
        <button type="button" onclick="this.parentElement.remove()" class="col-span-1 text-red-500">Remove</button>
    `;
            container.appendChild(div);
        }
    </script>
@endsection
