@extends('layouts.admin')

@section('content')
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Contact Message</h1>
                    <p class="text-gray-500">From: <strong>{{ $message->name }}</strong></p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('admin.messages.index') }}"
                        class="px-5 py-3 bg-gray-100 hover:bg-gray-200 rounded-2xl font-medium">
                        ← Back to All Messages
                    </a>

                    @if ($message->status == 'new')
                        <form action="{{ route('admin.messages.mark-read', $message->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="px-5 py-3 bg-green-600 hover:bg-green-700 text-white rounded-2xl font-medium">
                                Mark as Read
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                <!-- Message Info -->
                <div class="p-8 border-b">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <span class="text-xs uppercase tracking-widest text-gray-500">Name</span>
                            <p class="text-xl font-semibold mt-1">{{ $message->name }}</p>
                        </div>
                        <div>
                            <span class="text-xs uppercase tracking-widest text-gray-500">Email</span>
                            <p class="text-xl font-semibold mt-1">
                                <a href="mailto:{{ $message->email }}" class="text-red-600 hover:underline">
                                    {{ $message->email }}
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="text-xs uppercase tracking-widest text-gray-500">Subject</span>
                        <p class="text-2xl font-bold text-gray-800 mt-1">{{ $message->subject }}</p>
                    </div>

                    <div class="mt-6">
                        <span class="text-xs uppercase tracking-widest text-gray-500">Received</span>
                        <p class="text-gray-600">{{ $message->created_at->format('d F, Y | h:i A') }}</p>
                    </div>
                </div>

                <!-- Message Body -->
                <div class="p-8 bg-gray-50">
                    <span class="text-xs uppercase tracking-widest text-gray-500 mb-3 block">Message</span>
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </div>

                <!-- Reply Section (Future) -->
                <div class="p-8 border-t">
                    <h3 class="font-semibold text-lg mb-4">Quick Reply</h3>
                    <textarea rows="4" class="w-full rounded-2xl border-gray-300 focus:border-red-500"
                        placeholder="Write your reply here..."></textarea>

                    <button onclick="alert('Reply feature coming soon!')"
                        class="mt-4 px-8 py-3 bg-red-600 hover:bg-red-700 text-white rounded-2xl font-medium">
                        Send Reply
                    </button>
                </div>

            </div>

        </div>
    </div>
@endsection
