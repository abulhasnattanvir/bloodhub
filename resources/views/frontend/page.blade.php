@extends('layouts.frontend')

@section('content')
    <section class="py-16 bg-gray-50 min-h-screen">

        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white shadow-xl rounded-2xl p-8">

                <h1 class="text-4xl font-bold mb-8 text-gray-800">
                    {{ $page->title }}
                </h1>

                <div class="prose max-w-none">
                    {!! $page->content !!}
                </div>

            </div>

        </div>

    </section>
@endsection
