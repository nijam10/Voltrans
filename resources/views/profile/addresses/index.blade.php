@extends('layouts/app')
@section('title', 'Profil - Alamat')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50 lg:py-10 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-8">
        <x-breadcrumb :breadcrumbs="[
            ['label' => 'Profil', 'url' => route('profile.show')],
            ['label' => 'Alamat']
        ]" class="mt-5 sm:mt-0 -mb-10 sm:mb-0 px-2 sm:px-0"/>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">
            {{-- Sidebar --}}
            <div class="mb-8 lg:mb-0 lg:col-span-3">
                <x-user-sidebar />
            </div>

            {{-- Main Content --}}
            <div class="lg:col-span-9">
                <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg sm:shadow-2xl overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-2">
                            <h2 class="text-lg font-medium text-gray-900">Informasi Alamat</h2>
                            <livewire:address-modal key="address-modal" />
                        </div>
                        
                        {{-- Address Limit Information --}}
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 mb-2">
                                Anda dapat menambah hingga 3 alamat (termasuk 1 alamat terverifikasi dengan KTP)
                            </p>
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-600">Alamat saat ini: {{ $addresses->count() }}/3</span>
                                @if($addresses->count() < 3)
                                    <span class="text-sm text-green-600">({{ 3 - $addresses->count() }} slot tersisa)</span>
                                @else
                                    <span class="text-sm text-red-600">(Batas maksimal tercapai)</span>
                                @endif
                            </div>
                            
                            {{-- Verification Status --}}
                            @php
                                $verifiedAddress = $addresses->where('is_verified', true)->first();
                                $rejectedAddress = $addresses->where('is_verified', false)->whereNotNull('rejection_reason')->first();
                                $pendingAddress = $addresses->where('is_verified', false)->whereNotNull('ktp_path')->whereNull('rejection_reason')->first();
                            @endphp
                            
                            @if($verifiedAddress)
                                <div class="mt-2 p-2 bg-green-50 border border-green-200 rounded">
                                    <p class="text-sm text-green-800">
                                        ✓ Anda memiliki 1 alamat terverifikasi: <strong>{{ $verifiedAddress->name }}</strong>
                                    </p>
                                </div>
                            @elseif($rejectedAddress)
                                <div class="mt-2 p-2 bg-red-50 border border-red-200 rounded">
                                    <p class="text-sm text-red-800">
                                        ❌ Alamat "{{ $rejectedAddress->name }}" ditolak: <strong>{{ $rejectedAddress->rejection_reason }}</strong>
                                    </p>
                                </div>
                            @elseif($pendingAddress)
                                <div class="mt-2 p-2 bg-yellow-50 border border-yellow-200 rounded">
                                    <p class="text-sm text-yellow-800">
                                        ⏳ Alamat "{{ $pendingAddress->name }}" sedang diverifikasi oleh admin
                                    </p>
                                </div>
                            @else
                                <div class="mt-2 p-2 bg-blue-50 border border-blue-200 rounded">
                                    <p class="text-sm text-blue-800">
                                        ℹ️ Anda belum memiliki alamat terverifikasi. Alamat pertama akan memerlukan upload KTP.
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @forelse($addresses as $address)
                                <div class="border rounded-xl p-4 sm:p-6 bg-white relative">
                                    
                                    {{-- Badge: Default --}}
                                    @if($address->is_default)
                                        <span class="absolute top-2 right-2 bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                            Default
                                        </span>
                                    @endif

                                    {{-- Badge: Verification Status --}}
                                    @php
                                        $statusBadge = $address->getVerificationStatusBadge();
                                    @endphp
                                    <span class="absolute top-2 left-2 {{ $statusBadge['bg_color'] }} {{ $statusBadge['text_color'] }} text-xs font-medium px-2.5 py-0.5 rounded">
                                        {{ $statusBadge['label'] }}
                                    </span>

                                    {{-- Informasi alamat --}}
                                    <h3 class="font-medium text-gray-900 mt-6">{{ $address->name }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $address->address }}</p>
                                    <p class="text-sm text-gray-600">{{ $address->city }}, {{ $address->state }} {{ $address->postal_code }}</p>

                                    {{-- Rejection Reason --}}
                                    @if($address->isRejected())
                                        <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded">
                                            <p class="text-sm text-red-800">
                                                <strong>Alasan Penolakan:</strong><br>
                                                {{ $address->rejection_reason }}
                                            </p>
                                        </div>
                                    @endif

                                    {{-- Preview KTP jika tersedia --}}
                                    @if($address->ktp_path)
                                        <div class="mt-4">
                                            <p class="text-sm text-gray-500 mb-1">Bukti KTP yang diunggah:</p>
                                            <img src="{{ asset('storage/' . $address->ktp_path) }}" alt="KTP Upload" class="w-40 border rounded shadow-sm">
                                        </div>
                                    @endif

                                    {{-- Tombol aksi --}}
                                    <div class="mt-4 flex justify-end gap-5">
                                        <button type="button"
                                            x-data
                                            @click="$dispatch('edit', { id: {{ $address->id }} })"
                                            class="hover:cursor-pointer inline-flex items-center gap-x-2 text-sm font-medium text-emerald-600 hover:text-emerald-700 focus:outline-none focus:text-emerald-700">
                                            <svg class="shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="24" height="24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>                                              
                                            Edit
                                        </button>
                                        <form action="{{ route('user.addresses.destroy', $address) }}" method="POST" class="inline delete-address-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="hover:cursor-pointer inline-flex items-center gap-x-2 text-sm font-medium text-red-600 hover:text-red-700 focus:outline-none focus:text-red-700">
                                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18"></path>
                                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="col-span-2 text-center py-8">
                                    <p class="text-gray-500">Belum ada alamat. Tambah alamat sekarang!!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-address-form').forEach(function(form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Alamat ini akan dihapus dan tidak dapat dikembalikan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            @if(session('success'))
                Swal.fire({
                    title: "{{ session('success') }}",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    title: "{{ session('error') }}",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 3000
                });
            @endif
        });
    </script>
@endpush

@endsection 