@extends('layouts.frontend')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-800 mb-3">নোটিশ সমূহ</h1>
            <p class="text-gray-600 max-w-md mx-auto">সংস্থার সকল অফিসিয়াল নোটিশ এখানে পাবেন। সর্বশেষ নোটিশ প্রথমে দেখানো হয়।
            </p>
        </div>

        <!-- Notices Container -->
        <div class="bg-white shadow-xl rounded-3xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-green-700">
                        <tr>
                            <th class="px-8 py-5 text-left text-sm font-semibold text-white uppercase tracking-wider w-12">#
                            </th>
                            <th class="px-8 py-5 text-left text-sm font-semibold text-white uppercase tracking-wider">শিরোনাম
                            </th>
                            <th class="px-8 py-5 text-left text-sm font-semibold text-white uppercase tracking-wider">তারিখ
                            </th>
                            <th
                                class="px-8 py-5 text-center text-sm font-semibold text-white uppercase tracking-wider w-48">
                                ডাউনলোড </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($notices as $notice)
                            <tr class="hover:bg-gray-50 transition duration-200">
                                <td class="px-4 py-4 text-gray-500 font-medium">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-lg font-semibold text-gray-800 leading-tight">
                                        {{ $notice->title }}
                                    </div>
                                    @if ($notice->description)
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">
                                            {{ Str::limit($notice->description, 120) }}
                                        </p>
                                    @endif
                                </td>
                                <td class="px-4 py-4 text-gray-600 whitespace-nowrap">
                                    <span class="font-medium">{{ $notice->notice_date->format('d F, Y') }}</span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <a href="{{ route('notices.download', $notice->id) }}"
                                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-2xl font-medium transition-all duration-200 hover:shadow-lg">
                                        <i class="fas fa-download"></i>
                                        ডাউনলোড PDF
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-8 py-20 text-center">
                                    <div class="text-gray-400 text-xl">
                                        <i class="fas fa-folder-open text-5xl mb-4"></i>
                                        <p>কোনো নোটিশ পাওয়া যায়নি</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-8 py-6 border-t bg-gray-50">
                {{ $notices->links() }}
            </div>
        </div>

        <!-- Extra Info -->
        <div class="text-center text-gray-500 text-sm mt-8">
            সর্বশেষ আপডেট: {{ now()->format('d F, Y') }}
        </div>
    </div>
@endsection
