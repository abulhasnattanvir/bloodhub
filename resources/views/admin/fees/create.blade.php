@extends('layouts.admin')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="px-8 py-6 border-b bg-gray-50">
                <h2 class="text-3xl font-bold text-gray-800">Add New Fee Structure</h2>
                <p class="text-gray-500 mt-1">Create monthly fee for a profession</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('admin.fees.store') }}" class="p-8 space-y-6">
                @csrf

                <!-- Profession -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profession</label>
                    <input type="text" name="profession" placeholder="e.g. Doctor, Engineer, Teacher"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                        required>
                </div>

                <!-- Monthly Fee -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Monthly Fee (BDT)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3.5 text-gray-500 font-medium">৳</span>
                        <input type="number" name="monthly_fee" placeholder="5000"
                            class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                            required>
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-4 pt-6">
                    <button type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white py-3.5 rounded-xl font-semibold transition active:scale-95">
                        Save Fee Structure
                    </button>

                    <a href="{{ route('admin.fees.index') }}"
                        class="flex-1 text-center border border-gray-300 hover:bg-gray-50 py-3.5 rounded-xl font-medium transition">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
@endsection
