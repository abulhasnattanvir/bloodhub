{{-- resources/views/admin/settings/partials/dynamic-links.blade.php --}}

<div class="bg-white rounded-3xl p-8 shadow-sm">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-xl font-semibold text-gray-800">{{ $title ?? 'Links' }}</h3>
        <p class="text-sm text-gray-500">Empty rows will be ignored on save</p>
    </div>

    <div id="{{ $name }}-container" class="space-y-4">
        @php
            $links = old($name, $data ?? []);
        @endphp

        @foreach ($links as $i => $link)
            <div class="grid grid-cols-12 gap-3 items-end dynamic-link-row">
                <input type="text" name="{{ $name }}[{{ $i }}][title]"
                    value="{{ $link['title'] ?? '' }}" placeholder="Link Title"
                    class="col-span-12 sm:col-span-5 rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-3 px-4">

                <input type="url" name="{{ $name }}[{{ $i }}][url]"
                    value="{{ $link['url'] ?? '' }}" placeholder="https://example.com"
                    class="col-span-12 sm:col-span-6 rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-3 px-4">

                <button type="button" onclick="removeLink(this)"
                    class="col-span-12 sm:col-span-1 text-red-500 hover:text-red-700 text-xl font-medium">
                    ×
                </button>
            </div>
        @endforeach
    </div>

    <button type="button" onclick="addDynamicLink('{{ $name }}')"
        class="mt-6 inline-flex items-center gap-2 text-red-600 hover:text-red-700 font-medium">
        <i class="fas fa-plus"></i>
        Add New {{ Str::singular($title ?? 'Link') }}
    </button>
</div>

<script>
    function addDynamicLink(containerName) {
        const container = document.getElementById(containerName + '-container');
        const index = container.children.length;

        const div = document.createElement('div');
        div.className = 'grid grid-cols-12 gap-3 items-end dynamic-link-row';
        div.innerHTML = `
        <input 
            type="text" 
            name="${containerName}[${index}][title]" 
            placeholder="Link Title"
            class="col-span-12 sm:col-span-5 rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-3 px-4">

        <input 
            type="url" 
            name="${containerName}[${index}][url]" 
            placeholder="https://example.com"
            class="col-span-12 sm:col-span-6 rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-3 px-4">

        <button 
            type="button" 
            onclick="removeLink(this)"
            class="col-span-12 sm:col-span-1 text-red-500 hover:text-red-700 text-xl font-medium">
            ×
        </button>
    `;

        container.appendChild(div);
    }

    function removeLink(btn) {
        btn.parentElement.remove();
    }
</script>
