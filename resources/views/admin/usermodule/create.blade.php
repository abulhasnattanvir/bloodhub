@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <div class="max-w-4xl mx-auto">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Create New Role</h1>
                    <p class="text-gray-600 mt-1">Define a new role and assign permissions</p>
                </div>
                <a href="{{ route('admin.usermodule.index') }}"
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-colors">
                    ← Back to Roles
                </a>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                <form method="POST" action="{{ route('admin.usermodule.store') }}">
                    @csrf

                    <div class="p-8">

                        <!-- Role Name -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="e.g. Editor, Moderator, Viewer"
                                class="w-full px-5 py-4 text-lg border border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all"
                                required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Permissions -->
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <h3 class="text-xl font-semibold text-gray-800">Permissions</h3>

                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" id="select-all"
                                        class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-gray-700">Select All</span>
                                </label>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                                @foreach ($groupedPermissions as $module => $modulePermissions)
                                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm">

                                        <!-- Module Header with Checkbox -->
                                        <div class="flex items-center justify-between mb-4">
                                            <h4 class="font-semibold text-lg text-gray-800 capitalize">
                                                {{ str_replace('_', ' ', $module) }}
                                            </h4>

                                            <input type="checkbox" class="module-checkbox w-5 h-5 text-indigo-600 rounded"
                                                data-module="{{ $module }}">
                                        </div>

                                        <!-- Module Permissions -->
                                        <div class="space-y-3">
                                            @foreach ($modulePermissions as $permission)
                                                @php
                                                    $action = explode('.', $permission->name)[1] ?? $permission->name;
                                                @endphp

                                                <label
                                                    class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 cursor-pointer">
                                                    <input type="checkbox" name="permissions[]"
                                                        class="perm-checkbox module-{{ $module }} w-4 h-4 text-indigo-600 rounded"
                                                        value="{{ $permission->name }}">
                                                    <span class="text-gray-700">
                                                        {{ ucfirst($action) }}
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>

                    <!-- Footer Actions -->
                    <div class="bg-gray-50 px-8 py-6 border-t flex items-center gap-4">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-8 rounded-2xl transition-all flex items-center justify-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Create Role
                        </button>

                        <a href="{{ route('admin.usermodule.index') }}"
                            class="flex-1 text-center border border-gray-300 hover:bg-gray-50 font-semibold py-4 px-8 rounded-2xl transition-all">
                            Cancel
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const selectAll = document.getElementById('select-all');
            const permCheckboxes = document.querySelectorAll('.perm-checkbox');
            const moduleCheckboxes = document.querySelectorAll('.module-checkbox');

            // ====================== GLOBAL SELECT ALL ======================
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    permCheckboxes.forEach(cb => {
                        cb.checked = this.checked;
                    });
                    updateModuleCheckboxes();
                });
            }

            // ====================== MODULE SELECT ALL ======================
            moduleCheckboxes.forEach(moduleCb => {
                moduleCb.addEventListener('change', function() {
                    const moduleName = this.dataset.module;
                    const modulePerms = document.querySelectorAll(`.module-${moduleName}`);

                    modulePerms.forEach(cb => {
                        cb.checked = this.checked;
                    });

                    updateSelectAllState();
                });
            });

            // ====================== INDIVIDUAL CHECKBOXES ======================
            permCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateModuleCheckboxes();
                    updateSelectAllState();
                });
            });

            // Update Module checkboxes based on their permissions
            function updateModuleCheckboxes() {
                moduleCheckboxes.forEach(moduleCb => {
                    const moduleName = moduleCb.dataset.module;
                    const modulePerms = Array.from(document.querySelectorAll(`.module-${moduleName}`));

                    const allChecked = modulePerms.every(cb => cb.checked);
                    const someChecked = modulePerms.some(cb => cb.checked);

                    moduleCb.checked = allChecked;
                    moduleCb.indeterminate = !allChecked && someChecked;
                });
            }

            // Update "Select All" state
            function updateSelectAllState() {
                if (!selectAll) return;

                const allChecked = Array.from(permCheckboxes).every(cb => cb.checked);
                const someChecked = Array.from(permCheckboxes).some(cb => cb.checked);

                selectAll.checked = allChecked;
                selectAll.indeterminate = !allChecked && someChecked;
            }

            // Initial state
            updateModuleCheckboxes();
            updateSelectAllState();
        });
    </script>
@endpush
