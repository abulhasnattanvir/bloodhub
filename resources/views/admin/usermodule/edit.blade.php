@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <div class="max-w-4xl mx-auto">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Role</h1>
                    <p class="text-gray-600 mt-1">Manage permissions for <strong>{{ $role->name }}</strong></p>
                </div>
                <a href="{{ route('admin.usermodule.index') }}"
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-colors">
                    ← Back to Roles
                </a>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                <!-- Role Name -->
                <div class="px-8 pt-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                    <input type="text" id="role-name" value="{{ $role->name }}"
                        class="w-full px-5 py-4 text-lg border border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                </div>

                <!-- Permissions -->
                <div class="px-8 py-8 border-t border-gray-100 mt-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">Permissions</h3>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" id="select-all"
                                class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                            <span class="text-sm font-medium text-gray-700">Select All</span>
                        </label>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-[420px] overflow-y-auto pr-2 custom-scroll">
                        @foreach ($permissions as $permission)
                            <label
                                class="group flex items-center gap-3 p-4 border border-gray-100 hover:border-indigo-200 rounded-2xl cursor-pointer transition-all hover:bg-gray-50">
                                <input type="checkbox"
                                    class="perm-checkbox w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                    value="{{ $permission->name }}"
                                    {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                <span class="text-gray-700 font-medium">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-6 border-t flex items-center gap-4">
                    <button onclick="savePermissions()" id="saveBtn"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-8 rounded-2xl transition-all flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Permissions
                    </button>

                    <a href="{{ route('admin.usermodule.index') }}"
                        class="flex-1 text-center border border-gray-300 hover:bg-gray-50 font-semibold py-4 px-8 rounded-2xl transition-all">
                        Cancel
                    </a>
                </div>
            </div>

            <div id="msg" class="mt-6"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Select All
        document.getElementById('select-all').addEventListener('change', function() {
            document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = this.checked);
        });

        function savePermissions() {
            const btn = document.getElementById('saveBtn');
            const msgDiv = document.getElementById('msg');
            const originalHTML = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = `<span class="animate-spin inline-block w-5 h-5 mr-2">⟳</span>Saving...`;

            let permissions = [];
            document.querySelectorAll('.perm-checkbox:checked').forEach(cb => {
                permissions.push(cb.value);
            });

            // ✅ Most Reliable Method
            const syncUrl = "{{ url('admin/usermodule/' . $role->id . '/permissions') }}";

            fetch(syncUrl, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        permissions: permissions
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success || data.status === 'success') {
                        msgDiv.innerHTML =
                            `<div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl">✅ ${data.message || 'Permissions updated successfully'}</div>`;
                    } else {
                        msgDiv.innerHTML =
                            `<div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl">${data.message || 'Something went wrong'}</div>`;
                    }
                })
                .catch(() => {
                    msgDiv.innerHTML =
                        `<div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl">Connection error. Please try again.</div>`;
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalHTML;
                });
        }
    </script>
@endpush
