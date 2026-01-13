@extends('layout.adregis-layout')

@section('content')
    {{-- Notifikasi --}}
    @if (session('success'))
        <x-partials.notif-component message="Success" sign="{{ session('success') }}">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm flex items-center gap-5">
            <div class="p-4 bg-emerald-50 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.15em]">Total Registered</p>
                <h3 class="text-2xl font-black text-slate-700">{{ $patientsToday->count() }} <span class="text-xs font-medium text-slate-400">Pasien</span></h3>
            </div>
        </div>

        <div class="md:col-span-2 bg-white p-4 rounded-3xl border border-slate-100 shadow-sm flex items-center">
            <form action="#" method="GET" class="flex w-full gap-3">
                <div class="relative flex-grow">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="query" placeholder="Cari nama pasien atau NIK..." class="w-full pl-12 pr-4 py-3 bg-slate-50 border-transparent rounded-2xl text-sm focus:bg-white focus:ring-4 focus:ring-blue-50/50 transition-all outline-none">
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-black text-white px-8 py-3 rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all">
                    Cari Data
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. RM</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nama Pasien</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest">No. BPJS</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Antrian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($patientsToday as $patient)
                    <tr class="hover:bg-blue-50/30 transition-colors group">
                        <td class="px-6 py-4">
                            <span class="font-mono text-sm font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-md">
                                {{ $patient->patientBiodata->no_rm }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-slate-700 uppercase">{{ $patient->name }}</p>
                            <p class="text-[10px] text-slate-400 tracking-tight">{{ $patient->email }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $patient->patientBiodata->no_bpjs ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase bg-green-100 text-green-700 border border-green-200">
                                Terdaftar
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.regis.set.queue.index' , $patient->id) }}" >
                           
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                <button type="submit" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm shadow-emerald-100 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                    </svg>
                                    Get
                                </button>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <h4 class="text-slate-500 font-medium">Belum Ada Registrasi</h4>
                                <p class="text-slate-400 text-xs mt-1">Data pasien yang didaftarkan hari ini akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($patientsToday->isNotEmpty())
        <div class="bg-slate-50/50 px-6 py-3 border-t border-slate-100 flex justify-between items-center">
            <span class="text-[10px] text-slate-400 uppercase font-semibold italic">Live Update: {{ now()->format('H:i') }} WIB</span>
            <a href="#" class="text-[10px] text-blue-600 font-bold uppercase tracking-widest hover:underline">Lihat Semua Laporan →</a>
        </div>
        @endif
    </div>
@endsection