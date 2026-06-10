@extends('layouts.admin')

@section('content')
    <div class="container mx-auto px-4 py-8">

        <div class="max-w-2xl mx-auto">

            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Assign Role</h1>
                    <p class="text-gray-600 mt-1">Update role for this user</p>
                </div>
                <a href="{{ route('admin.userrole.index') }}"
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7" />
                    </svg>
                    Back to Users
                </a>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                <!-- User Info Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-8 py-6 text-white">
                    <div class="flex items-center gap-5">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center text-3xl font-semibold border border-white/30">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 class="text-2xl font-semibold">{{ $user->name }}</h2>
                            <p class="text-indigo-100">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">

                    <div class="space-y-8">

                        <!-- Current Role Display -->
                        <div>
                            <label class="text-sm font-medium text-gray-500">Current Role</label>
                            <div class="mt-2">
                                @if ($userRole)
                                    <span
                                        class="inline-flex items-center px-5 py-2 bg-indigo-100 text-indigo-700 rounded-2xl text-lg font-medium">
                                        {{ ucfirst($userRole) }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic">No role assigned yet</span>
                                @endif
                            </div>
                        </div>

                        <!-- New Role Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">New Role</label>
                            <select id="role"
                                class="w-full px-5 py-4 text-lg border border-gray-200 rounded-2xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all bg-white">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $userRole == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4 pt-6">
                            <button onclick="assignRole()" id="saveBtn"
                                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-6 rounded-2xl transition-all duration-200 flex items-center justify-center gap-3 text-lg shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Update Role
                            </button>

                            <a href="{{ route('admin.userrole.index') }}"
                                class="flex-1 text-center border border-gray-300 hover:bg-gray-50 font-semibold py-4 px-6 rounded-2xl transition-all text-lg">
                                Cancel
                            </a>
                        </div>

                    </div>

                    <!-- Message -->
                    <div id="msg" class="mt-8 min-h-[60px]"></div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function assignRole() {
            const btn = document.getElementById('saveBtn');
            const msgDiv = document.getElementById('msg');
            const originalBtnText = btn.innerHTML;

            // Loading state
            btn.disabled = true;
            btn.innerHTML = `
                <svg class="animate-spin h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            `;

            fetch("{{ route('admin.userrole.role.assign', $user->id) }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        role: document.getElementById('role').value
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        msgDiv.innerHTML = `
                        <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl flex items-center gap-3">
                            <span class="text-2xl">✅</span>
                            <span>${data.message}</span>
                        </div>
                    `;
                    } else {
                        msgDiv.innerHTML = `
                        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl">
                            ${data.message || 'Failed to update role'}
                        </div>
                    `;
                    }
                })
                .catch(() => {
                    msgDiv.innerHTML = `
                    <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-2xl">
                        Connection error. Please try again.
                    </div>
                `;
                })
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = originalBtnText;
                });
        }
    </script>
@endpush
