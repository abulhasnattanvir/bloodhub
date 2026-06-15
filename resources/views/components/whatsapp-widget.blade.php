@php
    $socialchat = \App\Models\SocialChat::first();
@endphp

@if ($socialchat?->whatsapp_enabled)
    <div x-data="{ open: false }" class="fixed bottom-6 right-1 z-50">

        <!-- Popup -->
        <div x-show="open" x-transition class="w-80 bg-white rounded-2xl shadow-2xl mb-4 overflow-hidden">

            <div class="bg-green-500 text-white p-4">
                <h3 class="font-bold">
                    {{ $socialchat->whatsapp_title }}
                </h3>
                <p class="text-sm opacity-90">
                    {{ $socialchat->whatsapp_message }}
                </p>
            </div>

            <div class="p-4">
                <a href="https://wa.me/{{ $socialchat->whatsapp_number }}?text=Assalamu Alaikum" target="_blank"
                    class="flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-medium">
                    WhatsApp Chat
                </a>
            </div>

        </div>

        <!-- Floating Button -->
        <button @click="open = !open"
            class="w-16 h-16 rounded-full bg-green-500 text-white shadow-xl hover:scale-80 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M17.47 14.38c-.29-.14-1.7-.84-1.96-.94-.26-.1-.45-.14-.64.14-.19.29-.74.94-.91 1.13-.17.19-.33.21-.62.07-.29-.14-1.2-.44-2.28-1.41-.84-.75-1.41-1.68-1.57-1.96-.17-.29-.02-.44.12-.58.12-.12.29-.33.43-.5.14-.17.19-.29.29-.48.1-.19.05-.36-.02-.5-.07-.14-.64-1.54-.88-2.11-.23-.55-.47-.48-.64-.49h-.55c-.19 0-.5.07-.76.36-.26.29-1 1-.99 2.43.02 1.43 1.03 2.81 1.17 3 .14.19 2.01 3.07 4.87 4.3.68.29 1.22.46 1.64.59.69.22 1.31.19 1.81.12.55-.08 1.7-.69 1.94-1.36.24-.67.24-1.24.17-1.36-.07-.12-.26-.19-.55-.33z" />
            </svg>
        </button>

    </div>
@endif
