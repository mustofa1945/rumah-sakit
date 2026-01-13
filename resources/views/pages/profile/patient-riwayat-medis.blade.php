@extends('layout.profile-layout')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-10 medical-font" x-data="{ selected: null }">
    
    <div class="mb-8 flex justify-between items-end border-b border-slate-100 pb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Panel Rekam Medis</h1>
            <p class="text-slate-500 text-sm mt-1 font-medium">Manajemen data kesehatan dan pengajuan administrasi.</p>
        </div>
    </div>

    <div class="overflow-x-auto px-1">
        <table class="w-full border-separate border-spacing-y-4">
            <thead>
                <tr class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.15em]">
                    <th class="px-6 py-2 text-left">Antrean</th>
                    <th class="px-6 py-2 text-left">Pasien & Dokter</th>
                    <th class="px-6 py-2 text-left">Keluhan Utama</th>
                    <th class="px-6 py-2 text-center">Status Validasi</th>
                    <th class="px-6 py-2 text-right">Manajemen Tindakan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($histories as $history)
                <tr class="bg-white border border-slate-100 shadow-sm transition-all duration-300">
                    <td class="px-6 py-5 rounded-l-2xl border-y border-l border-slate-100">
                        <span class="text-sm font-bold text-slate-400">#{{ str_pad($history->nomor_antrian, 2, '0', STR_PAD_LEFT) }}</span>
                    </td>

                    <td class="px-6 py-5 border-y border-slate-100">
                        <div class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</div>
                        <div class="text-[11px] text-slate-400 font-medium">dr. {{ $history->dokter->user->name ?? $history->dokter->nama }}</div>
                    </td>

                    <td class="px-6 py-5 border-y border-slate-100">
                        <p class="text-sm text-slate-500 truncate max-w-[180px] italic">"{{ $history->keluhan }}"</p>
                    </td>

                    <td class="px-6 py-5 border-y border-slate-100">
                        <div class="flex justify-center items-center">
                            @if($history->status == 'EMERGENCY')
                                <div class="flex items-center gap-2 bg-rose-50 px-3 py-1 rounded-full border border-rose-100 shadow-sm">
                                    <span class="w-1 h-1.5 rounded-full bg-rose-500 pulse-subtle"></span>
                                    <span class="text-[9px] font-black text-rose-600 uppercase">Emergency</span>
                                </div>
                            @elseif($history->status_rekap == 'COMPLETE-REVISI')
                                <div class="flex items-center gap-2 bg-blue-50 px-3 py-1 rounded-full border border-blue-100 shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 pulse-subtle"></span>
                                    <span class="text-[9px] font-black text-blue-600 uppercase">Updated</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    <span class="text-[9px] font-black text-emerald-600 uppercase">Verified</span>
                                </div>
                            @endif
                        </div>
                    </td>

                    <td class="px-6 py-5 rounded-r-2xl border-y border-r border-slate-100 text-right">
                        <div class="flex items-center justify-end gap-2">
                            @if ($history->status_download == "NONE")
                            <a href="{{ route('patient.ajukan.download' , ['id' => $history->id , 'status' => 'PENDING']) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-600 border border-blue-200 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm group-hover:shadow-blue-100 group">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span>Ajukan </span>
                                           </a>
                            @elseif($history->status_download == "PENDING" || $history->status_download == "APPROVED_LEVEL_1")
                         <div class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-50/50 text-amber-600 border border-amber-200 rounded-xl text-xs font-bold shadow-sm shadow-amber-100/50 cursor-default">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 animate-pulse shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    
                                    <div class="flex flex-col items-start leading-none">
                                        <span class="text-[12px]">Pending</span>
                                         <span class="text-[8px] font-medium opacity-70 whitespace-nowrap">Verifikasi Admin</span>
                                    </div>
                                </div>
                            @elseif($history->status_download == "REJECTED")
                                 <div class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-rose-50/50 text-rose-600 border border-rose-200 rounded-xl text-xs font-bold shadow-sm shadow-rose-100/50 cursor-default">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        
                                        <div class="flex flex-col items-start leading-none">
                                            <span class="text-[12px]">Rejected</span>
                                            <span class="text-[8px] font-medium opacity-70 whitespace-nowrap">Data Tidak Valid</span>
                                        </div>
                                    </div>
                                    @elseif($history->status_download == "CANCELLED")
                                    <div class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-50/50 text-slate-600 border border-slate-200 rounded-xl text-xs font-bold shadow-sm shadow-slate-100/50 cursor-default">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                        </svg>
                                        
                                        <div class="flex flex-col items-start leading-none">
                                            <span class="text-[12px]">Cancelled</span>
                                            <span class="text-[8px] font-medium opacity-70 whitespace-nowrap">Oleh Pengguna</span>
                                        </div>
                                    </div>
                                @elseif($history->status_download == "APPROVED_LEVEL_2")
                                  <a href="{{ route('patient.ajukan.download' , ['id' => $history->id , 'status' => 'PENDING']) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-600 border border-blue-200 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm group-hover:shadow-blue-100 group">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span>Download</span>
                                    </a>
                                
                            @endif
                            
                            <button @click="selected === {{ $history->id }} ? selected = null : selected = {{ $history->id }}"
                                class="p-2 bg-slate-900 text-white rounded-xl hover:bg-slate-700 transition-all shadow-md">
                                <svg class="w-4 h-4 transition-transform duration-500" :class="selected === {{ $history->id }} ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>

                <tr x-show="selected === {{ $history->id }}" 
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-cloak>
                    <td colspan="5" class="px-2 pb-6 pt-0">
                        <div class="bg-slate-50 border-x border-b border-slate-100 rounded-b-[2rem] p-8 shadow-inner">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                <div>
                                    <h4 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                                        <div class="w-1 h-3 bg-emerald-500 rounded-full"></div>
                                        Catatan Klinis Pasien
                                    </h4>
                                    <div class="space-y-6">
                                        <div class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm">
                                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-2">Analisa Diagnosa</p>
                                            <p class="text-sm text-slate-700 font-semibold leading-relaxed">
                                                {{ $history->diagnosa ?: 'Dokter belum memberikan diagnosa spesifik.' }}
                                            </p>
                                        </div>
                                        <div class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-sm">
                                            <p class="text-[10px] font-bold text-slate-400 uppercase mb-2">Tindakan Medis</p>
                                            <p class="text-sm text-slate-600 font-medium italic">
                                                {{ $history->tindakan ?: 'Pemeriksaan fisik standar dan konsultasi.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-sm relative">
                                    <div class="absolute top-6 right-8">
                                        <svg class="w-6 h-6 text-slate-100" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/></svg>
                                    </div>
                                    <h4 class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest mb-5">Rencana Farmasi</h4>
                                    <div class="bg-emerald-50/30 p-5 rounded-2xl border border-emerald-100 min-h-[100px]">
                                        <p class="text-sm text-slate-700 leading-loose font-medium italic">
                                            {!! nl2br(e($history->resep ?: 'Tidak ada resep obat untuk kunjungan ini.')) !!}
                                        </p>
                                    </div>
                                    <div class="mt-6 flex justify-between items-center text-[9px] font-bold text-slate-300 uppercase">
                                        <span>Digital Verified Record</span>
                                        <span>KlinikCare Dashboard v2.0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center">
                        <p class="text-sm text-slate-400 font-medium italic">Belum ada aktivitas rekam medis yang tercatat.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
        <style>
     .medical-font { font-family: 'Inter', sans-serif; }
    [x-cloak] { display: none !important; }
    
    /* Animasi Pulse Tipis & Halus */
    .pulse-subtle {
        animation: pulse-light 2.5s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    @keyframes pulse-light {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.3; transform: scale(1.4); }
    }

            :root {
                --emerald-dark: #064e3b;
                --emerald-light: #ecfdf5;
                --gray-500: #6B7280;
                --gray-50: #F9FAFB;
                --blue-600: #2563EB;
            }

            .antrian,
            .biodata-asli,
            .informasi-bpjs {
                color: var(--gray-500);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .antrian:hover,
            .biodata-asli   :hover,
            .informasi-bpjs:hover {
                background-color: var(--gray-50);
                color: var(--blue-600);
            }

            .riwayat {
                color: var(--emerald-dark);
                background-color: var(--emerald-light);
                cursor: pointer;
            }
        </style>
    @endpush