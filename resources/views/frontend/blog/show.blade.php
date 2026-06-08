@extends('layouts.frontend')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-12">
        <article class="prose prose-lg mx-auto">
            @if ($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                    class="w-full h-auto rounded-xl mb-8">
            @endif

            <h1 class="text-4xl font-bold mb-4">{{ $post->title }}</h1>
            <p class="text-gray-500 mb-8">
                By {{ $post->user->name }} • {{ $post->published_at?->format('F j, Y') }}
            </p>

            <div class="prose-content">
                {!! $post->content !!}
            </div>
        </article>
    </div>
@endsection
