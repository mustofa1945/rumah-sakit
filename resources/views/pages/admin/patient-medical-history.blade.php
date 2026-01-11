@extends('layout.admin')

@section('content')
    @if (session('success'))
        <x-partials.notif-component message="Berhasil" sign="Data Rekap Medis Berhasill Dibuat">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
    <div class="space-y-8 animate-fadeIn">
        <nav class="flex text-xs text-gray-400 ml-2 space-x-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-green-600">Dashboard</a>
            <span>/</span>
            <span class="text-green-600 font-medium">Rekam Medis</span>
        </nav>
        <header class="bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-50 rounded-full blur-3xl -mr-20 -mt-20 opacity-60">
            </div>

            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div
                        class="w-20 h-20 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                        <span class="text-2xl font-bold">{{ substr($biodata->fullname, 0, 2) }}</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-2xl font-black text-slate-800 tracking-tight">{{ $biodata->full_name }}</h1>
                            <span
                                class="px-3 py-1 bg-emerald-100 text-emerald-700 text-[10px] font-black uppercase rounded-full tracking-wider">
                                No. RM: {{ $biodata->no_rm }}
                            </span>
                        </div>
                        <div class="flex gap-4 mt-2 text-sm text-slate-500 font-medium">
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg> {{ $biodata->nik }}</span>
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002-2z">
                                    </path>
                                </svg> {{ \Carbon\Carbon::parse($biodata->date_of_birth)->age }} Tahun</span>
                            <span class="flex items-center gap-1.5"><svg class="w-4 h-4" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                </svg> {{ $biodata->city }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button
                        class="bg-white hover:bg-slate-50 text-slate-600 px-6 py-3 rounded-xl text-xs font-bold transition-all border border-slate-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 10v6m0 0l-3-3m3 3l3-3m2-8H7a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V9l-5-5z">
                            </path>
                        </svg>
                        Cetak Resume
                    </button>
                    @if ($dokterSudahMencatat)
                    <a href="{{ route('admin.patient-histories.create', ['user' => $biodata->user_id]) }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl text-xs font-bold transition-all shadow-lg shadow-emerald-100 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                            </svg>
                            Perbarui Data
                        </a>
                    @else
                    <a href="{{ route('admin.patient-histories.create', ['user' => $biodata->user_id]) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl text-xs font-bold transition-all shadow-lg shadow-blue-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 4v16m8-8H4"></path>
                        </svg>
                        Kunjungan Baru
                    </a>
                    @endif
                </div>
            </div>

            <hr class="my-8 border-slate-100">

            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold mb-1">Golongan Darah</p>
                    <p class="text-sm font-bold text-slate-700">{{ $biodata->blood_type }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold mb-1">Status BPJS</p>
                    <p class="text-sm font-bold text-slate-700">{{ $biodata->no_bpjs ?? 'Mandiri' }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold mb-1">Kontak Darurat</p>
                    <p class="text-sm font-bold text-slate-700">{{ $biodata->emergency_contact_phone }}</p>
                </div>
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-400 font-bold mb-1">Alamat Domisili</p>
                    <p class="text-sm font-bold text-slate-700 truncate">{{ $biodata->address }}</p>
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    Timeline Riwayat Medis
                    <span class="bg-slate-100 text-slate-500 text-[10px] px-2 py-0.5 rounded-full">{{ count($histories) }}
                        Sesi</span>
                </h3>

                @foreach($histories as $history)
                    <div
                        class="group bg-white rounded-2xl p-6 border border-slate-100 hover:border-emerald-200 transition-all duration-300 relative">
                        <div class="absolute top-6 right-6">
                            <span
                                class="px-3 py-1 {{ $history->status == 'DONE' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} text-[10px] font-black rounded-lg">
                                {{ $history->status }}
                            </span>
                        </div>

                        <div class="flex gap-6">
                            <div class="text-center">
                                <p class="text-[10px] uppercase tracking-tighter text-slate-400 font-bold">
                                    {{ \Carbon\Carbon::parse($history->tanggal_kunjungan)->format('M') }}</p>
                                <p class="text-2xl font-black text-slate-800">
                                    {{ \Carbon\Carbon::parse($history->tanggal_kunjungan)->format('d') }}</p>
                                <p class="text-[10px] text-slate-400">
                                    {{ \Carbon\Carbon::parse($history->tanggal_kunjungan)->format('Y') }}</p>
                            </div>

                            <div class="flex-1 space-y-4">
                                <div>
                                    <p class="text-xs font-bold text-blue-600 mb-1">{{ $history->dokter->name }}</p>
                                    <h4 class="text-md font-bold text-slate-800">Keluhan: {{ $history->keluhan }}</h4>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="bg-slate-50/50 rounded-xl p-3 border border-slate-100">
                                        <p class="text-[9px] uppercase font-black text-slate-400 tracking-wider mb-1">Diagnosa
                                        </p>
                                        <p class="text-xs text-slate-600 leading-relaxed">
                                            {{ $history->diagnosa ?? 'Belum ada diagnosa' }}</p>
                                    </div>
                                    <div class="bg-slate-50/50 rounded-xl p-3 border border-slate-100">
                                        <p class="text-[9px] uppercase font-black text-slate-400 tracking-wider mb-1">Tindakan &
                                            Resep</p>
                                        <p class="text-xs text-slate-600 leading-relaxed">{{ $history->resep ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="space-y-6">
                <h3 class="text-lg font-bold text-slate-800 mb-6">Informasi Klinis</h3>

                <div
                    class="bg-[#064E3B] rounded-[2rem] p-6 text-white shadow-xl shadow-emerald-900/10 relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-4">
                            <div class="p-2 bg-emerald-400/20 rounded-lg">
                                <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest text-emerald-300">Catatan Medis</span>
                        </div>
                        <p class="text-sm font-medium leading-relaxed text-emerald-50/80 italic">
                            "Pasien memiliki riwayat alergi obat antibiotik golongan Penicillin. Harap perhatikan pemberian
                            resep obat luar."
                        </p>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>
                </div>

                <div class="bg-white rounded-[2rem] p-6 border border-slate-100">
                    <p class="text-xs font-black text-slate-800 uppercase tracking-widest mb-4">Aksi Cepat</p>
                    <div class="space-y-2">
                        <button
                            class="w-full text-left px-4 py-3 rounded-xl hover:bg-slate-50 text-slate-600 text-xs font-semibold flex items-center justify-between group transition-all">
                            Unggah Hasil Lab
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all text-blue-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <button
                            class="w-full text-left px-4 py-3 rounded-xl hover:bg-slate-50 text-slate-600 text-xs font-semibold flex items-center justify-between group transition-all">
                            Rujuk Pasien
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all text-blue-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        <button
                            class="w-full text-left px-4 py-3 rounded-xl hover:bg-rose-50 text-rose-500 text-xs font-semibold flex items-center justify-between group transition-all">
                            Tandai Emergency
                            <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all text-rose-500" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.6s ease-out forwards;
        }
    </style>
@endpush