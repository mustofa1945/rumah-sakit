@extends('layout.profile-layout')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 border-b border-gray-100 pb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Riwayat <span class="text-emerald-600">Medis</span></h1>
            <p class="text-slate-500 mt-1">Daftar lengkap riwayat kunjungan dan konsultasi kesehatan Anda.</p>
        </div>
        <div class="mt-4 md:mt-0">
            <button class="bg-blue-900 text-white px-6 py-2 rounded-full font-medium hover:bg-blue-800 transition shadow-sm">
                Cetak Riwayat
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <span class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total Kunjungan</span>
            <p class="text-2xl font-bold text-blue-900">{{ $histories->count() }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 border-l-4 border-l-emerald-500">
            <span class="text-slate-400 text-sm font-medium uppercase tracking-wider">Status Terakhir</span>
            <p class="text-2xl font-bold text-emerald-600">Selesai</p>
        </div>
    </div>

    <div class="space-y-6">
        @forelse($histories as $history)
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition duration-300">
            <div class="bg-slate-50 px-6 py-4 flex flex-wrap justify-between items-center gap-4 border-b border-gray-100">
                <div class="flex items-center space-x-4">
                    <div class="bg-emerald-100 p-3 rounded-xl">
                        <svg class="w-6 h-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="Date_Icon_Path_Here"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500 font-medium">{{ \Carbon\Carbon::parse($history->tanggal_kunjungan)->translatedFormat('d F Y') }}</p>
                        <p class="font-bold text-slate-800">Antrian #{{ $history->nomor_antrian }}</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <div class="text-right">
                        <p class="text-xs text-slate-400 uppercase tracking-widest">Dokter Pemeriksa</p>
                        <p class="font-semibold text-blue-900">{{ $history->dokter->name }}</p>
                    </div>
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold 
                        {{ $history->status == 'DONE' ? 'bg-emerald-100 text-emerald-700' : 
                           ($history->status == 'EMERGENCY' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') }}">
                        {{ $history->status }}
                    </span>
                </div>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h4 class="text-xs font-bold text-slate-400 uppercase mb-2">Keluhan & Diagnosa</h4>
                    <p class="text-slate-700 mb-4 italic">"{{ $history->keluhan }}"</p>
                    <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                        <p class="text-sm font-semibold text-blue-900 mb-1">Diagnosa:</p>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ $history->diagnosa ?? 'Belum ada diagnosa' }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase mb-2">Tindakan Medis</h4>
                        <p class="text-sm text-slate-600">{{ $history->tindakan ?? '-' }}</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-emerald-600 uppercase mb-2">Resep Obat</h4>
                        <div class="flex items-start space-x-2">
                            <span class="text-emerald-600 text-lg">💊</span>
                            <p class="text-sm text-slate-700 font-medium bg-emerald-50 px-3 py-2 rounded-lg w-full">
                                {{ $history->resep ?? 'Tidak ada resep' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-gray-300">
            <p class="text-slate-400">Belum ada riwayat medis yang tercatat.</p>
        </div>
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
            .biodata-asli,
            .informasi-bpjs {
                color: var(--gray-500);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .antrian:hover,
            .biodata-asli:hover,
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