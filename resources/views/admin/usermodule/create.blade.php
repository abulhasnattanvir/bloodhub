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

                            <div
                                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-[420px] overflow-y-auto pr-2 custom-scroll">
                                @foreach ($permissions as $permission)
                                    <label
                                        class="group flex items-center gap-3 p-4 border border-gray-100 hover:border-indigo-200 rounded-2xl cursor-pointer transition-all hover:bg-gray-50">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                            class="perm-checkbox w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                            {{ old('permissions') && in_array($permission->name, old('permissions')) ? 'checked' : '' }}>
                                        <span class="text-gray-700 font-medium">{{ $permission->name }}</span>
                                    </label>
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
        // Select All functionality
        document.getElementById('select-all').addEventListener('change', function() {
            document.querySelectorAll('.perm-checkbox').forEach(cb => {
                cb.checked = this.checked;
            });
        });
    </script>
@endpush
