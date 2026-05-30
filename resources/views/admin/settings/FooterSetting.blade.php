@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6 space-y-6">

        <!-- HEADER -->
        <div class="bg-white rounded-xl shadow p-5">
            <h2 class="text-2xl font-bold text-gray-800">Footer Settings</h2>
            <p class="text-sm text-gray-500">Manage your website footer dynamically</p>
        </div>

        <form method="POST" action="{{ route('admin.footer.update') }}" class="space-y-6">
            @csrf

            <!-- ABOUT SECTION -->
            <div class="bg-white rounded-xl shadow p-5">
                <h3 class="text-lg font-semibold mb-3">About Section</h3>

                <textarea name="about_text" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500" rows="4">{{ $footer->about_text }}</textarea>
            </div>

            <!-- SOCIAL LINKS -->
            <div x-data="repeatable({{ json_encode($footer->social_links ?? []) }})" class="bg-white rounded-xl shadow p-5">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Social Links</h3>

                    <button type="button" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded"
                        @click="add()">
                        + Add
                    </button>
                </div>

                <div class="space-y-3">

                    <template x-for="(item, index) in items" :key="index">
                        <div class="grid grid-cols-12 gap-2 items-center">

                            <input type="text" placeholder="Name" class="col-span-3 border rounded-lg p-2"
                                x-model="item.name" :name="'social_links[' + index + '][name]'">

                            <input type="text" placeholder="URL" class="col-span-5 border rounded-lg p-2"
                                x-model="item.url" :name="'social_links[' + index + '][url]'">

                            <input type="text" placeholder="Icon" class="col-span-3 border rounded-lg p-2"
                                x-model="item.icon" :name="'social_links[' + index + '][icon]'">

                            <button type="button" class="col-span-1 bg-red-500 hover:bg-red-600 text-white rounded-lg p-2"
                                @click="remove(index)">
                                ✕
                            </button>

                        </div>
                    </template>

                </div>
            </div>

            <!-- QUICK LINKS -->
            <div x-data="repeatable({{ json_encode($footer->quick_links ?? []) }})" class="bg-white rounded-xl shadow p-5">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Quick Links</h3>

                    <button type="button" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded"
                        @click="add()">
                        + Add
                    </button>
                </div>

                <div class="space-y-3">

                    <template x-for="(item, index) in items" :key="index">
                        <div class="grid grid-cols-12 gap-2">

                            <input type="text" placeholder="Title" class="col-span-5 border rounded-lg p-2"
                                x-model="item.title" :name="'quick_links[' + index + '][title]'">

                            <input type="text" placeholder="URL" class="col-span-6 border rounded-lg p-2"
                                x-model="item.url" :name="'quick_links[' + index + '][url]'">

                            <button type="button" class="col-span-1 bg-red-500 text-white rounded-lg"
                                @click="remove(index)">
                                ✕
                            </button>

                        </div>
                    </template>

                </div>
            </div>

            <!-- SERVICE LINKS -->
            <div x-data="repeatable({{ json_encode($footer->service_links ?? []) }})" class="bg-white rounded-xl shadow p-5">

                <h3 class="text-lg font-semibold mb-4">Service Links</h3>

                <template x-for="(item, index) in items" :key="index">
                    <div class="grid grid-cols-12 gap-2 mb-3">

                        <input type="text" class="col-span-5 border rounded-lg p-2" placeholder="Title"
                            x-model="item.title" :name="'service_links[' + index + '][title]'">

                        <input type="text" class="col-span-6 border rounded-lg p-2" placeholder="URL" x-model="item.url"
                            :name="'service_links[' + index + '][url]'">

                        <button type="button" class="col-span-1 bg-red-500 text-white rounded-lg" @click="remove(index)">
                            ✕
                        </button>

                    </div>
                </template>

                <button type="button" class="mt-2 bg-green-600 text-white px-3 py-1 rounded" @click="add()">
                    + Add Service
                </button>
            </div>

            <!-- FOOTER MENUS -->
            <div x-data="repeatable({{ json_encode($footer->footer_menus ?? []) }})" class="bg-white rounded-xl shadow p-5">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Footer Menus</h3>

                    <button type="button" class="bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-1 rounded"
                        @click="add()">
                        + Add
                    </button>
                </div>

                <div class="space-y-3">

                    <template x-for="(item, index) in items" :key="index">
                        <div class="grid grid-cols-12 gap-2 items-center">

                            <input type="text" placeholder="Menu Title" class="col-span-5 border rounded-lg p-2"
                                x-model="item.title" :name="'footer_menus[' + index + '][title]'">

                            <input type="text" placeholder="URL" class="col-span-6 border rounded-lg p-2"
                                x-model="item.url" :name="'footer_menus[' + index + '][url]'">

                            <button type="button" class="col-span-1 bg-red-500 hover:bg-red-600 text-white rounded-lg p-2"
                                @click="remove(index)">
                                ✕
                            </button>

                        </div>
                    </template>

                </div>
            </div>

            <!-- SUBSCRIBE -->
            <div class="bg-white rounded-xl shadow p-5 space-y-3">

                <h3 class="text-lg font-semibold">Subscribe Section</h3>

                <input type="text" name="subscribe_title" value="{{ $footer->subscribe_title }}"
                    class="w-full border rounded-lg p-2" placeholder="Title">

                <input type="text" name="subscribe_text" value="{{ $footer->subscribe_text }}"
                    class="w-full border rounded-lg p-2" placeholder="Description">

            </div>

            <!-- SAVE BUTTON -->
            <div class="text-right">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                    Save Footer Settings
                </button>
            </div>

        </form>
    </div>

    <!-- ALPINE REPEATER -->
    <script>
        function repeatable(initial) {
            return {
                items: initial && initial.length ? initial : [],

                add() {
                    this.items.push({});
                },

                remove(index) {
                    this.items.splice(index, 1);
                }
            }
        }
    </script>
@endsection
