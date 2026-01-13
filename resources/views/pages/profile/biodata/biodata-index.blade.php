@extends('layout.profile-layout')

@section('content')
 @if (session('message'))
        <x-partials.notif-component message="Warninf" sign="Tolong isi biodata">
            <x-partials.icon-alert />
        </x-partials.notif-component>
    @endif
     @if (session('success'))
        <x-partials.notif-component message="Success" sign="{{ session('success') }}">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
<div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Biodata Pasien</h1>
                <p class="text-sm text-slate-500">Kelola informasi profil medis Anda untuk mempermudah layanan kesehatan.</p>
            </div>
            @if($biodata)
                <a href="{{ route('profile.biodata.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-all shadow-md shadow-blue-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Edit Biodata
                </a>
            @endif
        </div>

        @forelse([$biodata] as $data)
            @if($data)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-24"></div>
                            <div class="px-6 pb-6">
                                <div class="relative -mt-12 mb-4">
                                    <div class="inline-flex items-center justify-center w-24 h-24 bg-white rounded-2xl shadow-lg border-4 border-white text-emerald-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                </div>
                                <h2 class="text-xl font-bold text-slate-800">{{ $data->full_name }}</h2>
                                <p class="text-sm text-slate-500">{{ $user->email }}</p>
                                
                                <div class="mt-6 pt-6 border-t border-slate-100 space-y-3">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-slate-400">No. RM</span>
                                        <span class="font-mono font-bold text-emerald-700 bg-emerald-50 px-2 py-1 rounded">{{ $data->no_rm }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-slate-400">Golongan Darah</span>
                                        <span class="font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-full text-xs">{{ $data->blood_type ?? '-' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100">
                            <h3 class="text-blue-800 font-bold flex items-center mb-4 text-sm uppercase tracking-wider">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Kontak Darurat
                            </h3>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-[10px] text-blue-500 uppercase font-bold">Nama Kontak</p>
                                    <p class="text-slate-700 font-medium">{{ $data->emergency_contact_name }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] text-blue-500 uppercase font-bold">Hubungan / Telepon</p>
                                    <p class="text-slate-700 font-medium">{{ $data->emergency_contact_relation }} - {{ $data->emergency_contact_phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                                <span class="w-1 h-6 bg-emerald-500 rounded-full mr-3"></span>
                                Informasi Identitas
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">NIK (KTP)</label>
                                    <p class="text-slate-700">{{ $data->nik }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">No. BPJS</label>
                                    <p class="text-slate-700">{{ $data->no_bpjs ?? 'Tidak ada' }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Tempat, Tanggal Lahir</label>
                                    <p class="text-slate-700">{{ $data->place_of_birth }}, {{ \Carbon\Carbon::parse($data->date_of_birth)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Jenis Kelamin</label>
                                    <p class="text-slate-700">{{ $data->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Agama</label>
                                    <p class="text-slate-700">{{ $data->religion }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Status Pernikahan</label>
                                    <p class="text-slate-700">{{ $data->marital_status }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
                            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                                <span class="w-1 h-6 bg-blue-500 rounded-full mr-3"></span>
                                Alamat Domisili
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Alamat Lengkap</label>
                                    <p class="text-slate-700 leading-relaxed">{{ $data->address }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Desa/Kelurahan</label>
                                    <p class="text-slate-700">{{ $data->village }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Kecamatan</label>
                                    <p class="text-slate-700">{{ $data->district }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Kota/Kabupaten</label>
                                    <p class="text-slate-700">{{ $data->city }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-400 uppercase mb-1">Provinsi</label>
                                    <p class="text-slate-700">{{ $data->province }} ({{ $data->postal_code }})</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-3xl border border-dashed border-slate-300 p-12 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-emerald-50 text-emerald-500 rounded-full mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 mb-2">Biodata Belum Diisi</h2>
                    <p class="text-slate-500 max-w-sm mx-auto mb-8">Anda belum melengkapi data profil pasien. Harap lengkapi biodata Anda untuk mendapatkan akses layanan penuh.</p>
                    <a href="{{ route('profile.biodata.create') }}" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-100">
                        Lengkapi Sekarang
                    </a>
                </div>
            @endif
        @empty
            @endforelse

    </div>
</div>
@endsection

   @push('styles')
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            :root {
                --emerald-dark: #064e3b;
                --emerald-light: #ecfdf5;
                --gray-500: #6B7280;
                --gray-50: #F9FAFB;
                --blue-600: #2563EB;
            }

            .antrian,
            .riwayat,
            .informasi-bpjs {
                color: var(--gray-500);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .antrian:hover,
            .riwayat:hover,
            .informasi-bpjs:hover {
                background-color: var(--gray-50);
                color: var(--blue-600);
            }

            .biodata-asli {
                color: var(--emerald-dark);
                background-color: var(--emerald-light);
                cursor: pointer;
            }
        </style>
    @endpush