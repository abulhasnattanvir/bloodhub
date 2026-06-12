@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-12">

        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-bold tracking-tight mb-4 text-gray-900">
                আমাদের ব্লগ
            </h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                অনুপ্রেরণামূলক গল্প, তথ্যবহুল লেখা এবং বিশেষজ্ঞদের অভিজ্ঞতা—সব কিছু এখানে পাওয়া যাবে, যা আপনাকে জানাবে এবং
                অনুপ্রাণিত করবে।
            </p>
        </div>

        <!-- Filters & Search -->
        <div class="bg-white rounded-3xl shadow-sm border p-6 mb-12">
            <div class="flex flex-col md:flex-row gap-4 items-center">
                <div class="flex-1 w-full">
                    <input type="text" id="search-input" placeholder="আর্টিকেল খুঁজুন"
                        class="w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-2xl px-6 py-4 text-lg">
                </div>

                <div class="w-full md:w-72">
                    <select id="category-filter"
                        class="w-full border border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-2xl px-6 py-4">
                        <option value="">সব ক্যাটাগরি</option>
                        @foreach (App\Models\BlogCategory::all() as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Featured Post -->
        @if ($posts->count() > 0)
            @php $featured = $posts->first(); @endphp
            <div class="mb-16">
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden grid md:grid-cols-12 gap-8 items-center">
                    <div class="md:col-span-7">
                        @if ($featured->featured_image)
                            <img src="{{ Storage::url($featured->featured_image) }}" alt="{{ $featured->title }}"
                                class="w-full h-full object-cover md:h-[520px]">
                        @else
                            <div
                                class="bg-gradient-to-br from-red-600 to-red-800 h-[520px] flex items-center justify-center">
                                <span class="text-white text-7xl opacity-75">📝</span>
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-5 p-8 md:p-12">
                        @if ($featured->category)
                            <span
                                class="inline-block bg-red-100 text-red-700 text-sm font-semibold px-5 py-2 rounded-2xl mb-6">
                                {{ $featured->category->name }}
                            </span>
                        @endif

                        <h2 class="text-3xl md:text-4xl font-bold leading-tight mb-6 text-gray-900">
                            <a href="{{ route('blog.show', $featured->slug) }}"
                                class="hover:text-red-600 transition-colors">
                                {{ $featured->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 text-lg leading-relaxed mb-8 line-clamp-4">
                            {{ $featured->excerpt }}
                        </p>

                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-4 text-gray-500">
                                <span>{{ $featured->published_at?->format('M j, Y') }}</span>
                            </div>
                            <a href="{{ route('blog.show', $featured->slug) }}"
                                class="inline-flex items-center gap-2 font-semibold text-red-600 hover:text-red-700">
                                Read Full Article →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- All Posts -->
        <div class="mb-10">
            <h2 class="text-3xl font-semibold text-gray-900">সর্বশেষ আর্টিকেল</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="posts-grid">
            @foreach ($posts->skip(1) as $post)
                <div
                    class="group bg-white rounded-3xl shadow-md overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">

                    <div class="relative overflow-hidden">
                        @if ($post->featured_image)
                            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="h-64 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <span class="text-5xl text-gray-400">📄</span>
                            </div>
                        @endif

                        @if ($post->category)
                            <span
                                class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-red-700 text-xs font-semibold px-4 py-2 rounded-2xl shadow">
                                {{ $post->category->name }}
                            </span>
                        @endif
                    </div>

                    <div class="p-7">
                        <h3 class="font-semibold text-xl leading-tight mb-4 line-clamp-2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-red-600 transition-colors">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-gray-600 line-clamp-3 mb-6 text-[15.2px] leading-relaxed">
                            {{ $post->excerpt }}
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $post->published_at?->format('M j, Y') }}</span>
                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="text-red-600 hover:text-red-700 font-medium flex items-center gap-1">
                                Read more →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load More -->
        <div class="mt-16 flex flex-col items-center">
            @if ($posts->hasMorePages())
                <button onclick="loadMorePosts()" id="load-more-btn"
                    class="px-12 py-5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-3xl text-lg transition-all duration-300 flex items-center gap-3 shadow-lg shadow-red-200">
                    <span>Load More Articles</span>
                    <i class="fas fa-chevron-down"></i>
                </button>
            @endif

            <!-- Traditional Pagination -->
            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let page = {{ $posts->currentPage() }};
        const maxPage = {{ $posts->lastPage() }};

        async function loadMorePosts() {
            const btn = document.getElementById('load-more-btn');
            if (!btn) return;

            btn.innerHTML = `<span class="animate-pulse">Loading...</span>`;
            btn.disabled = true;

            page++;

            try {
                const response = await fetch(`/blog?page=${page}&ajax=1`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const newPosts = doc.querySelector('#posts-grid');

                if (newPosts && newPosts.children.length > 0) {
                    document.getElementById('posts-grid').append(...newPosts.children);
                }

                if (page >= maxPage) {
                    btn.style.display = 'none';
                } else {
                    btn.innerHTML = `<span>Load More Articles</span><i class="fas fa-chevron-down"></i>`;
                    btn.disabled = false;
                }
            } catch (error) {
                console.error(error);
                btn.innerHTML = 'Failed to load';
            }
        }

        // Simple Search Filter (Client-side for instant feel)
        document.getElementById('search-input').addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            const cards = document.querySelectorAll('#posts-grid > div');

            cards.forEach(card => {
                const title = card.querySelector('h3').textContent.toLowerCase();
                const excerpt = card.querySelector('p').textContent.toLowerCase();
                card.style.display = (title.includes(term) || excerpt.includes(term)) ? '' : 'none';
            });
        });
    </script>
@endpush
