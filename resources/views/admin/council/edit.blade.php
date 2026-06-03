@extends('layouts.admin')

@section('content')
    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-10 h-10 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center">
                    <i class="fas fa-user-tie text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Council Member</h1>
                    <p class="text-gray-500">Update member information and details</p>
                </div>
            </div>

            <div class="bg-white shadow-sm rounded-3xl overflow-hidden">
                <div class="p-8">
                    <form method="POST" action="{{ route('admin.council.update', $council->id) }}"
                        enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $council->name) }}"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Position <span
                                        class="text-red-500">*</span></label>
                                <select name="position"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5"
                                    required>
                                    <option value="president"
                                        {{ old('position', $council->position) == 'president' ? 'selected' : '' }}>President
                                    </option>
                                    <option value="vice_president"
                                        {{ old('position', $council->position) == 'vice_president' ? 'selected' : '' }}>Vice
                                        President</option>
                                    <option value="secretary"
                                        {{ old('position', $council->position) == 'secretary' ? 'selected' : '' }}>Secretary
                                    </option>
                                    <option value="joint_secretary"
                                        {{ old('position', $council->position) == 'joint_secretary' ? 'selected' : '' }}>
                                        Joint Secretary</option>
                                    <option value="member"
                                        {{ old('position', $council->position) == 'member' ? 'selected' : '' }}>Member
                                    </option>
                                    <option value="advisor"
                                        {{ old('position', $council->position) == 'advisor' ? 'selected' : '' }}>Advisor
                                    </option>
                                </select>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="text" name="phone" value="{{ old('phone', $council->phone) }}"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $council->email) }}"
                                    class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                            </div>
                        </div>

                        <!-- Bio -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Biography</label>
                            <textarea name="bio" rows="5"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">{{ old('bio', $council->bio) }}</textarea>
                        </div>

                        <!-- Photo Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Profile Photo</label>

                            @if ($council->photo)
                                <div class="mb-4">
                                    <img src="{{ asset($council->photo) }}"
                                        class="w-28 h-28 object-cover rounded-2xl border border-gray-100 shadow-sm">
                                </div>
                            @endif

                            <input type="file" name="photo" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-4 file:px-6 file:rounded-2xl file:border-0 file:text-sm file:font-medium file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition">
                            <p class="text-xs text-gray-400 mt-2">Recommended: Square image (JPG, PNG)</p>
                        </div>

                        <!-- Social Links -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Social Media Links</label>
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Facebook</label>
                                    <input type="text" name="facebook" value="{{ old('facebook', $council->facebook) }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5"
                                        placeholder="https://facebook.com/...">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Twitter / X</label>
                                    <input type="text" name="twitter" value="{{ old('twitter', $council->twitter) }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5"
                                        placeholder="https://twitter.com/...">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">LinkedIn</label>
                                    <input type="text" name="linkedin" value="{{ old('linkedin', $council->linkedin) }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5"
                                        placeholder="https://linkedin.com/...">
                                </div>
                                <div>
                                    <label class="block text-xs text-gray-500 mb-1">Instagram</label>
                                    <input type="text" name="instagram"
                                        value="{{ old('instagram', $council->instagram) }}"
                                        class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5"
                                        placeholder="https://instagram.com/...">
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                            <select name="status"
                                class="block w-full rounded-2xl border-gray-300 focus:border-red-500 focus:ring-red-500 py-4 px-5">
                                <option value="1" {{ old('status', $council->status) == 1 ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $council->status) == 0 ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-between pt-6 border-t">
                            <a href="{{ route('admin.council.index') }}"
                                class="inline-flex items-center px-6 py-3 text-gray-700 hover:bg-gray-100 rounded-2xl transition">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Cancel
                            </a>

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-8 py-4 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-2xl shadow-sm transition">
                                <i class="fas fa-save"></i>
                                Update Member
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
