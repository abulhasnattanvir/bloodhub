@extends('layouts.frontend')

@section('content')
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-14">
                <span class="inline-block px-5 py-2 bg-red-100 text-red-600 rounded-full font-semibold mb-4"> ই এস ডব্লিউ
                    কার্যক্রম</span>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900">কার্যক্রমের গ্যালারি</h1>
                <p class="text-gray-600 mt-3">আমাদের বিভিন্ন মানবিক কার্যক্রমের আলোকচিত্র</p>
            </div>

            <!-- Category Filters -->
            <div class="flex flex-wrap justify-center gap-3 mb-12" id="category-filters">
                <button data-category="all"
                    class="category-btn active px-6 py-3 rounded-full font-medium bg-red-600 text-white hover:bg-red-700 transition-all">
                    সব কার্যক্রম
                </button>

                @foreach ($categories as $cat)
                    <button data-category="{{ $cat }}"
                        class="category-btn px-6 py-3 rounded-full font-medium bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 transition-all">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="gallery-grid">
                @forelse($galleryImages as $image)
                    <div class="gallery-item group relative overflow-hidden rounded-3xl shadow-lg transition-all duration-300"
                        data-category="{{ $image->category ?? 'uncategorized' }}">

                        <a href="{{ asset('storage/' . $image->image) }}" class="glightbox block"
                            data-title="{{ $image->title }}" data-description="{{ $image->description ?? '' }}">
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->title }}"
                                class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                        </a>

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                        </div>

                        <div
                            class="absolute bottom-0 left-0 right-0 p-6 text-white translate-y-6 group-hover:translate-y-0 transition-all duration-300">
                            <h3 class="font-semibold text-lg">{{ $image->title }}</h3>
                            @if ($image->event_date)
                                <p class="text-sm opacity-80">{{ $image->event_date->format('d M, Y') }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center py-12 text-gray-500">এখনো কোনো ছবি নেই</p>
                @endforelse
            </div>

            <!-- Pagination Links -->
            <div class="mt-12 flex justify-center">
                {{ $galleryImages->links() }}
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const lightbox = GLightbox({
                selector: '.glightbox',
                touchNavigation: true,
                loop: true,
                zoomable: true,
                draggable: true,
                openEffect: 'zoom',
                closeEffect: 'fade',
                width: '95%',
                height: '95vh'
            });

            function filterCategory(category) {
                const items = document.querySelectorAll('.gallery-item');
                const buttons = document.querySelectorAll('#category-filters .category-btn');

                buttons.forEach(btn => {
                    if (btn.getAttribute('data-category') === category) {
                        btn.classList.add('active', 'bg-red-600', 'text-white');
                        btn.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
                    } else {
                        btn.classList.remove('active', 'bg-red-600', 'text-white');
                        btn.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
                    }
                });

                items.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.transition = 'all 0.4s ease';
                        item.style.opacity = '1';
                        item.style.transform = 'scale(1)';
                        item.style.display = 'block';
                    } else {
                        item.style.transition = 'all 0.4s ease';
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => item.style.display = 'none', 400);
                    }
                });
            }

            document.querySelectorAll('#category-filters .category-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    filterCategory(btn.getAttribute('data-category'));
                });
            });
        });
    </script>
@endpush
