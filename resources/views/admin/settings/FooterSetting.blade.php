@extends('layouts.admin')

@section('content')
    <div class="py-6 md:py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 bg-red-100 text-red-600 rounded-3xl flex items-center justify-center">
                        <i class="fas fa-cog text-3xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Footer Settings</h1>
                        <p class="text-gray-500">Manage your website footer content dynamically</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.footer.update') }}" class="space-y-8">
                @csrf

                <!-- About Section -->
                <div class="bg-white rounded-3xl shadow-sm p-6 md:p-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle text-red-500"></i>
                        About Section
                    </h3>
                    <textarea name="about_text" rows="5"
                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5 text-base"
                        placeholder="Write about your organization...">{{ $footer->about_text ?? '' }}</textarea>
                </div>

                <!-- Social Links -->
                <div x-data="repeatable({{ json_encode($footer->social_links ?? []) }})" class="bg-white rounded-3xl shadow-sm p-6 md:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <i class="fas fa-share-alt text-blue-500"></i>
                            Social Links
                        </h3>
                        <button type="button" @click="add()"
                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-2xl text-sm font-medium transition">
                            <i class="fas fa-plus"></i> Add Social
                        </button>
                    </div>

                    <div class="space-y-4">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="grid grid-cols-12 gap-3 items-center">
                                <input type="text" placeholder="Platform Name"
                                    class="col-span-12 sm:col-span-3 rounded-2xl border-gray-300 focus:border-blue-500 py-4 px-5"
                                    x-model="item.name" :name="'social_links[' + index + '][name]'">

                                <input type="text" placeholder="URL[](https://...)"
                                    class="col-span-12 sm:col-span-5 rounded-2xl border-gray-300 focus:border-blue-500 py-4 px-5"
                                    x-model="item.url" :name="'social_links[' + index + '][url]'">

                                <input type="text" placeholder="Icon (fab fa-facebook)"
                                    class="col-span-12 sm:col-span-3 rounded-2xl border-gray-300 focus:border-blue-500 py-4 px-5"
                                    x-model="item.icon" :name="'social_links[' + index + '][icon]'">

                                <button type="button" @click="remove(index)"
                                    class="col-span-12 sm:col-span-1 bg-red-500 hover:bg-red-600 text-white rounded-2xl py-4 transition">
                                    ✕
                                </button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Quick Links & Service Links & Footer Menus -->
                <!-- (Similar pattern applied to all repeatable sections) -->

                <div x-data="repeatable({{ json_encode($footer->quick_links ?? []) }})" class="bg-white rounded-3xl shadow-sm p-6 md:p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Quick Links</h3>
                        <button type="button" @click="add()"
                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-2xl text-sm font-medium">
                            <i class="fas fa-plus"></i> Add Link
                        </button>
                    </div>
                    <div class="space-y-4">
                        <template x-for="(item, index) in items" :key="index">
                            <div class="grid grid-cols-12 gap-3 items-center">
                                <input type="text" placeholder="Link Title"
                                    class="col-span-12 sm:col-span-5 rounded-2xl border-gray-300 py-4 px-5"
                                    x-model="item.title" :name="'quick_links[' + index + '][title]'">
                                <input type="text" placeholder="URL"
                                    class="col-span-12 sm:col-span-6 rounded-2xl border-gray-300 py-4 px-5"
                                    x-model="item.url" :name="'quick_links[' + index + '][url]'">
                                <button type="button" @click="remove(index)"
                                    class="col-span-1 bg-red-500 hover:bg-red-600 text-white rounded-2xl py-4">✕</button>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Subscribe Section -->
                <div class="bg-white rounded-3xl shadow-sm p-6 md:p-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-5 flex items-center gap-2">
                        <i class="fas fa-bell text-green-500"></i>
                        Subscribe Section
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                            <input type="text" name="subscribe_title" value="{{ $footer->subscribe_title ?? '' }}"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <input type="text" name="subscribe_text" value="{{ $footer->subscribe_text ?? '' }}"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl shadow-sm transition">
                        <i class="fas fa-save"></i>
                        Save Footer Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Alpine.js Repeater -->
    <script>
        function repeatable(initial = []) {
            return {
                items: initial.length ? initial : [],

                add() {
                    this.items.push({});
                },

                remove(index) {
                    if (confirm('Remove this item?')) {
                        this.items.splice(index, 1);
                    }
                }
            }
        }
    </script>
@endsection
