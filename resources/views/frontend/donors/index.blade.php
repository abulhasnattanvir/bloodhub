@extends('layouts.frontend')

@section('content')
    <!-- Filter Section -->
    <section class="py-12 bg-gradient-to-br from-red-50 via-white to-red-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-4xl font-bold text-gray-900 text-center mb-8">রক্তদাতার তালিকা</h2>

            <div class="bg-white rounded-3xl shadow-lg p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">নাম / ফোন / ইমেইল</label>
                        <input type="text" id="search-input"
                            class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all"
                            placeholder="অনুসন্ধান করুন..." value="{{ request('search') }}">
                    </div>

                    <!-- Blood Group -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">রক্তের গ্রুপ</label>
                        <select id="blood-group-select"
                            class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all">
                            <option value="">সব রক্তের গ্রুপ</option>
                            @foreach ($bloodGroups as $bloodGroup)
                                <option value="{{ $bloodGroup->id }}"
                                    {{ request('blood_group') == $bloodGroup->id ? 'selected' : '' }}>
                                    {{ $bloodGroup->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Availability -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">অবস্থা</label>
                        <select id="availability-select"
                            class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none transition-all">
                            <option value="">সব অবস্থা</option>
                            <option value="available" {{ request('availability_status') == 'available' ? 'selected' : '' }}>
                                উপলব্ধ</option>
                            <option value="not_available"
                                {{ request('availability_status') == 'not_available' ? 'selected' : '' }}>অনুপলব্ধ</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Desktop Table -->
    <section class="py-10 hidden md:block">
        <div class="max-w-8xl mx-auto px-4">
            @if ($donors->isEmpty())
                <div class="text-center py-20 bg-white rounded-3xl shadow">
                    <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-500">কোনো রক্তদাতা পাওয়া যায়নি</p>
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-red-600 text-white">
                            <tr>
                                <th class="px-6 py-5 text-left">ছবি</th>
                                <th class="px-6 py-5 text-left">নাম</th>
                                <th class="px-6 py-5 text-left">রক্তের গ্রুপ</th>
                                <th class="px-6 py-5 text-left">ফোন</th>
                                <th class="px-6 py-5 text-left">লিঙ্গ</th>
                                <th class="px-6 py-5 text-left">শেষ দান</th>
                                <th class="px-6 py-5 text-left">অবস্থা</th>
                                <th class="px-6 py-5 text-left">ঠিকানা</th>
                                <th class="px-6 py-5 text-center">অ্যাকশন</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach ($donors as $donor)
                                <tr class="hover:bg-red-50 transition-all group">
                                    <td class="px-3 py-3">
                                        @if ($donor->profile_photo)
                                            <img src="{{ Storage::url($donor->profile_photo) }}"
                                                class="w-12 h-12 rounded-2xl object-cover ring-2 ring-red-100">
                                        @else
                                            <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center">
                                                <i class="fas fa-user text-2xl text-gray-400"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900">{{ $donor->full_name }}</td>
                                    <td class="px-3 py-3">
                                        <span
                                            class="px-4 py-2 text-sm font-bold rounded-full
                                        @php
$bg = $donor->bloodGroup->name;

                                            $class = match(true) {
                                                in_array($bg, ['A+', 'A-']) => 'bg-red-100 text-red-700',
                                                in_array($bg, ['B+', 'B-']) => 'bg-blue-100 text-blue-700',
                                                in_array($bg, ['O+', 'O-']) => 'bg-amber-100 text-amber-700',
                                                str_contains($bg, 'AB') => 'bg-purple-100 text-purple-700',
                                                default => 'bg-gray-100 text-gray-700'
                                            }; @endphp
                                        ">
                                            {{ $donor->bloodGroup->name }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5">{{ $donor->phone_number }}</td>
                                    <td class="px-6 py-5">{{ ucfirst($donor->gender) }}</td>
                                    <td class="px-6 py-5 text-gray-600">
                                        {{ $donor->last_donation_date ? $donor->last_donation_date->format('d M, Y') : 'কখনো দান করেননি' }}
                                    </td>
                                    <td class="px-6 py-5">
                                        @if ($donor->availability_status == 'available')
                                            <span
                                                class="px-4 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">রক্তদানে
                                                প্রস্তুত</span>
                                        @else
                                            <span
                                                class="px-4 py-1 bg-gray-100 text-gray-600 text-sm font-medium rounded-full">প্রস্তুত
                                                না</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-gray-500 text-sm max-w-xs truncate">
                                        {{ $donor->address ?? '-' }}</td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="flex gap-2 justify-center">
                                            <button
                                                class="view-donor-btn px-5 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-2xl text-sm font-medium transition-all"
                                                data-donor-id="{{ $donor->id }}">
                                                বিস্তারিত
                                            </button>
                                            <a href="tel:{{ $donor->phone_number }}"
                                                class="px-5 py-2 bg-green-50 hover:bg-green-100 text-green-600 rounded-2xl text-sm font-medium transition-all">
                                                কল করুন
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 flex justify-center">
                    {{ $donors->links() }}
                </div>
            @endif
        </div>
    </section>

    <!-- Mobile Card View -->
    <section class="md:hidden py-8 px-4 space-y-5">
        @foreach ($donors as $donor)
            <div class="bg-white rounded-3xl shadow-md p-5 hover:shadow-xl transition-all">
                <div class="flex items-start gap-4">
                    @if ($donor->profile_photo)
                        <img src="{{ Storage::url($donor->profile_photo) }}"
                            class="w-16 h-16 rounded-2xl object-cover ring-4 ring-red-50">
                    @else
                        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                        </div>
                    @endif>

                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-lg text-gray-900">{{ $donor->full_name }}</h3>
                        <div class="flex items-center gap-2 mt-1">
                            <span
                                class="px-3 py-1 text-sm font-bold rounded-full {{ str_contains($donor->bloodGroup->name, 'A') ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ $donor->bloodGroup->name }}
                            </span>
                            @if ($donor->availability_status == 'available')
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">উপলব্ধ</span>
                            @else
                                <span
                                    class="px-3 py-1 bg-gray-100 text-gray-500 text-xs font-medium rounded-full">অনুপলব্ধ</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-5 space-y-2 text-md text-gray-600">
                    <p><span class="font-medium">ফোন:</span> {{ $donor->phone_number }}</p>
                    <p><span class="font-medium">লিঙ্গ:</span> {{ ucfirst($donor->gender) }}</p>
                    <p><span class="font-medium">শেষ দান:</span>
                        {{ $donor->last_donation_date ? $donor->last_donation_date->format('d M, Y') : 'কখনো দান করেননি' }}
                    </p>
                </div>

                <div class="mt-6 flex gap-3">
                    <a href="tel:{{ $donor->phone_number }}"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white text-center py-3 rounded-2xl font-medium transition-all">
                        কল করুন
                    </a>
                    <button
                        class="view-donor-btn flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-2xl font-medium transition-all"
                        data-donor-id="{{ $donor->id }}">
                        বিস্তারিত দেখুন
                    </button>
                </div>
            </div>
        @endforeach
    </section>

    <!-- Improved Modal -->
    <div id="donorModal" class="fixed inset-0 bg-black/70 hidden flex items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden">
            <div class="flex justify-between items-center border-b px-6 py-4">
                <h3 class="text-xl font-bold text-gray-900">রক্তদাতার বিস্তারিত তথ্য</h3>
                <button id="closeModal" class="text-3xl text-gray-400 hover:text-red-500 transition-colors">×</button>
            </div>

            <div id="donorModalBody" class="p-4 text-gray-700">
                <!-- Dynamic content loaded by JS -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const search = document.getElementById('search-input');
            const blood = document.getElementById('blood-group-select');
            const status = document.getElementById('availability-select');

            function debounce(func, delay = 600) {
                let timer;
                return function(...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            }

            function updateFilters() {
                const params = new URLSearchParams();
                if (search.value.trim()) params.append('search', search.value.trim());
                if (blood.value) params.append('blood_group', blood.value);
                if (status.value) params.append('availability_status', status.value);
                window.location.href = `?${params.toString()}`;
            }

            search.addEventListener('input', debounce(updateFilters));
            blood.addEventListener('change', updateFilters);
            status.addEventListener('change', updateFilters);

            // Modal
            const modal = document.getElementById('donorModal');
            const body = document.getElementById('donorModalBody');
            const closeBtn = document.getElementById('closeModal');

            function showModal() {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            function hideModal() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }

            closeBtn.addEventListener('click', hideModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) hideModal();
            });

            document.querySelectorAll('.view-donor-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.donorId;
                    showModal();

                    body.innerHTML = `
                <div class="text-center py-12">
                    <div class="animate-spin w-8 h-8 border-4 border-red-200 border-t-red-600 rounded-full mx-auto"></div>
                    <p class="mt-4 text-gray-500">তথ্য লোড হচ্ছে...</p>
                </div>
            `;

                    fetch(`/api/donors/${id}`)
                        .then(res => res.json())
                        .then(donor => {
                            body.innerHTML = `
                        <div class="space-y-5">
                            <div class="flex items-center gap-4">
                                ${donor.profile_photo ? 
                                    `<img src="${donor.profile_photo}" class="w-20 h-20 rounded-2xl object-cover">` : 
                                    `<div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center"><i class="fas fa-user text-5xl text-gray-400"></i></div>`}
                                <div>
                                    <h2 class="text-2xl font-bold">${donor.full_name}</h2>
                                    <p class="text-red-600 font-bold text-xl">${donor.blood_group?.name ?? 'N/A'}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 text-md">
                                <div><span class="font-medium">ফোন:</span><br>${donor.phone_number ?? 'N/A'}</div>
                                <div class="break-all"><span class="font-medium">ইমেইল:</span><br>${donor.email ?? 'N/A'}</div>
                                <div><span class="font-medium">লিঙ্গ:</span><br>${donor.gender ?? 'N/A'}</div>
                                <div><span class="font-medium">শেষ দান:</span><br>${donor.last_donation_date ?? 'কখনো দান করেননি'}</div>
                            </div>
                            
                            <div class="pt-4 border-t">
                                <p class="font-medium">ঠিকানা:</p>
                                <p class="text-gray-600">${donor.address ?? 'তথ্য নেই'}</p>
                            </div>
                            
                            <a href="tel:${donor.phone_number}" 
                               class="block w-full text-center bg-green-600 hover:bg-green-700 text-white py-4 rounded-2xl font-semibold text-lg transition-all mt-6">
                                📞 এখনই কল করুন
                            </a>
                        </div>
                    `;
                        })
                        .catch(() => {
                            body.innerHTML =
                                `<p class="text-red-500 text-center py-10">তথ্য লোড করতে সমস্যা হয়েছে</p>`;
                        });
                });
            });
        });
    </script>
@endpush
