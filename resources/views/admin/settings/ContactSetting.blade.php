@extends('layouts.admin')

@section('content')
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4">

            <div class="flex justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Contact Page Settings</h1>
                    <p class="text-gray-500">Manage contact information and form</p>
                </div>
            </div>

            <form method="POST" action="{{ route('admin.contact.update') }}" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Page Header -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-xl font-semibold mb-6">Page Header</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Page Title</label>
                            <input type="text" name="page_title" value="{{ $contact->page_title ?? '' }}"
                                class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-2">Subtitle</label>
                            <input type="text" name="page_subtitle" value="{{ $contact->page_subtitle ?? '' }}"
                                class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-xl font-semibold mb-6">Contact Information</h3>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium mb-2">Email Address</label>
                            <input type="email" name="email" value="{{ $contact->email ?? '' }}"
                                class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Phone Number</label>
                            <input type="text" name="phone" value="{{ $contact->phone ?? '' }}"
                                class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Full Address</label>
                            <textarea name="address" rows="3" class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">{{ $contact->address ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Google Map Embed Code (iframe)</label>
                            <textarea name="map_embed" rows="6" placeholder='<iframe src="..." width="100%" height="350" ...></iframe>'
                                class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5 font-mono text-sm">{{ $contact->map_embed ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Form Settings -->
                <div class="bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-xl font-semibold mb-6">Contact Form Settings</h3>
                    <div>
                        <label class="block text-sm font-medium mb-2">Form Title</label>
                        <input type="text" name="form_title" value="{{ $contact->form_title ?? '' }}"
                            class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                    </div>
                    <div class="mt-6">
                        <label class="block text-sm font-medium mb-2">Success Message</label>
                        <input type="text" name="success_message"
                            value="{{ $contact->success_message ?? 'Thank you! Your message has been sent.' }}"
                            class="w-full rounded-2xl border-gray-300 focus:border-red-500 py-4 px-5">
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-10 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl">
                        Save Contact Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
