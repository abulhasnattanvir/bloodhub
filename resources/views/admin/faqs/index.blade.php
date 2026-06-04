@extends('layouts.admin')

@section('content')
    <div class="p-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">
                FAQ Management
            </h1>

            <a href="{{ route('admin.faqs.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl transition">
                + Add FAQ
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left">Question</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($faqs as $faq)
                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-5">
                                <div class="font-semibold">
                                    {{ $faq->question }}
                                </div>

                                <div class="text-sm text-gray-500 mt-1">
                                    {{ Str::limit($faq->answer, 80) }}
                                </div>
                            </td>

                            <td class="px-6 py-5 text-center">
                                @if ($faq->status)
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        Active
                                    </span>
                                @else
                                    <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-5">
                                <div class="flex justify-center gap-4">

                                    <a href="{{ route('admin.faqs.edit', $faq) }}"
                                        class="text-blue-600 hover:text-blue-700">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete this FAQ?')"
                                            class="text-red-600 hover:text-red-700">
                                            Delete
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-500">
                                No FAQs Found
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

        </div>

        <div class="mt-6">
            {{ $faqs->links() }}
        </div>

    </div>
@endsection
