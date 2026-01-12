@extends('layout.admin')

@section('content')
  @if (session('success'))
        <x-partials.notif-component message="Success" sign="{{ session('success') }}">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
    <div x-data="{ 
        showFilter: false, 
        search: '',
        timeFilter: 'all'
    }" x-init="setTimeout(() => showFilter = true, 100)" class="space-y-8">

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4" x-show="showFilter"
            x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0">

            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Rekap Medis Pasien</h2>
                <p class="text-sm text-slate-500">Kelola dan tinjau riwayat kesehatan pasien Anda</p>
            </div>

            <form method="GET" action="{{ route('admin.rekap-medis') }}" class="flex flex-wrap items-center gap-3">
                <!-- SEARCH -->
                <div class="relative group">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-4 h-4 text-slate-400 group-focus-within:text-blue-500 transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pasien..."
                        class="pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm
                       focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none w-64
                       transition-all shadow-sm">
                </div>
                <!-- TIME FILTER -->
                <div class="relative">
                    <select name="timeFilter" class="appearance-none pl-4 pr-10 py-2.5 bg-white border border-slate-200
                       rounded-xl text-sm font-semibold text-slate-600 focus:ring-2
                       focus:ring-blue-500/20 focus:border-blue-500 outline-none cursor-pointer
                       shadow-sm transition-all">

                        <option value="all">Semua Waktu</option>
                        <option value="today" {{ request('timeFilter') === 'today' ? 'selected' : '' }}>
                            Hari Ini
                        </option>
                        <option value="week" {{ request('timeFilter') === 'week' ? 'selected' : '' }}>
                            Minggu Ini
                        </option>
                        <option value="month" {{ request('timeFilter') === 'month' ? 'selected' : '' }}>
                            Bulan Ini
                        </option>
                        <option value="year" {{ request('timeFilter') === 'year' ? 'selected' : '' }}>
                            Tahun Ini
                        </option>
                    </select>

                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl
                       hover:bg-emerald-600 hover:text-white transition-all
                       border border-emerald-100 shadow-sm shadow-emerald-100/50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586
                         a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </button>

            </form>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" x-show="showFilter"
            x-transition:enter="transition ease-out duration-700 delay-100"
            x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden transition-all duration-500"
            x-show="showFilter" x-transition:enter="transition ease-out duration-700 delay-200"
            x-transition:enter-start="opacity-0 translate-y-12" x-transition:enter-end="opacity-100 translate-y-0">

            <div class="overflow-x-auto aside-scroll">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tgl / No.
                                Antrian</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Pasien</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Keluhan &
                                Diagnosa</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center">
                                Aksi</th>
                            <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-wider text-center">
                                Aksi Download</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse($histories as $history)
                            <tr class="hover:bg-blue-50/30 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-slate-700">
                                        {{ \Carbon\Carbon::parse($history->tanggal_kunjungan)->format('d M Y') }}</div>
                                    <div
                                        class="text-[10px] font-medium text-emerald-600 bg-emerald-50 w-fit px-2 py-0.5 rounded-full mt-1 uppercase tracking-tighter">
                                        Antrian #{{ $history->nomor_antrian }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                                            {{ substr($history->user->name, 0, 1) }}
                                        </div>
                                        <div class="text-sm font-semibold text-slate-700">{{ $history->user->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="text-sm text-slate-600 truncate font-medium"><span
                                            class="text-slate-400 italic">K:</span> {{ $history->keluhan }}</div>
                                    <div class="text-[11px] text-blue-500 font-semibold mt-1">
                                        <span class="text-slate-400 uppercase text-[9px]">Diagnosa:</span>
                                        {{ $history->diagnosa ?? 'Belum ada diagnosa' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'DONE' => 'bg-emerald-100 text-emerald-700',
                                            'CANCELED' => 'bg-slate-100 text-slate-600',
                                            'EMERGENCY' => 'bg-rose-100 text-rose-700',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-lg text-[10px] font-bold {{ $statusClasses[$history->status] ?? 'bg-gray-100' }}">
                                        {{ $history->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($history->status_revision == "NONE")
                                    <a href="{{ route('patient-history.ajukan-revisi' , ['id' => $history->id]) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-600 border border-blue-200 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm group-hover:shadow-blue-100 group">
                                                
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                
                                                <span>Ajukan Revisi</span>
                                            </a>
                                    @elseif($history->status_revision == "PENDING")
                                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50/50 text-amber-600 border border-amber-200 rounded-xl text-xs font-bold shadow-sm shadow-amber-100/50 cursor-default group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            
                                            <div class="flex flex-col items-start leading-tight">
                                                <span>Revisi Pending</span>
                                                <span class="text-[9px] font-medium opacity-70">Menunggu Verifikasi</span>
                                            </div>
                                        </div>
                                    @elseif($history->status_revision == "CANCELLED")
                                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-rose-50/50 text-rose-600 border border-rose-200 rounded-xl text-xs font-bold shadow-sm cursor-help group relative" title="Klik untuk lihat alasan penolakan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        
                                        <div class="flex flex-col items-start leading-tight">
                                            <span>Revisi Ditolak</span>
                                            <span class="text-[9px] font-medium opacity-70">Lihat Alasan</span>
                                        </div>
                                    </div>
                                    @else
                                       <a href="{{ route('revision.index' , ['id' => $history->id]) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-600 border border-blue-200 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm group-hover:shadow-blue-100 group">
                                                
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                
                                                <span>Revisi</span>
                                            </a>
                                    @endif
                                </td>
                                <td>
                                    @if($history->status_download == "PENDING")
                                        <a href="{{ route('patient.ajukan.download' , ['id' => $history->id , 'status' => 'APPROVED_LEVEL_1']) }}"
                                                class="inline-flex items-center gap-2 px-4 py-2 bg-white text-blue-600 border border-blue-200 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-all shadow-sm group-hover:shadow-blue-100 group">
                                                
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                
                                                <span>Ajukan Download</span>
                                            </a>
                                    @elseif($history->status_download == "APPROVED_LEVEL_1")
                                     <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-50/50 text-amber-600 border border-amber-200 rounded-xl text-xs font-bold shadow-sm shadow-amber-100/50 cursor-default group">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            
                                            <div class="flex flex-col items-start leading-tight">
                                                <span>Revisi Pending</span>
                                                <span class="text-[9px] font-medium opacity-70">Menunggu Verifikasi</span>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-slate-400 font-medium">Belum ada riwayat pemeriksaan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection