@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.socialchat.update') }}" method="POST">
        @csrf

        <div class="bg-white p-6 rounded-xl shadow space-y-4">

            <input type="text" name="whatsapp_number"
                value="{{ old('whatsapp_number', $socialchat->whatsapp_number ?? '') }}" placeholder="8801XXXXXXXXX"
                class="w-full border rounded-lg p-3">

            <input type="text" name="whatsapp_title" value="{{ old('whatsapp_title', $socialchat->whatsapp_title ?? '') }}"
                placeholder="Chat with us" class="w-full border rounded-lg p-3">

            <textarea name="whatsapp_message" rows="3" class="w-full border rounded-lg p-3">{{ old('whatsapp_message', $socialchat->whatsapp_message ?? '') }}</textarea>

            <label class="flex items-center gap-2">
                <input type="checkbox" name="whatsapp_enabled" value="1" @checked($socialchat->whatsapp_enabled ?? false)>
                Enable WhatsApp
            </label>

            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                Save Settings
            </button>

        </div>
    </form>
@endsection
