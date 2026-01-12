@extends('layout.admin')

@section('content')
<div class="max-w-4xl mx-auto" 
     x-data="{ isSubmitting: false }" 
     x-init="setTimeout(() => $el.classList.remove('opacity-0'), 100)">
    
    <div class="flex items-center justify-between mb-8 transition-all duration-500">
        <div>
            <nav class="flex text-sm text-slate-400 mb-2" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ url()->previous() }}" class="hover:text-blue-600">Riwayat</a></li>
                    <li><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg></li>
                    <li class="text-slate-600 font-medium">Form Revisi Medis</li>
                </ol>
            </nav>
            <h2 class="text-2xl font-bold text-slate-800">Revisi Rekap Medis</h2>
        </div>
        <a href="{{ url()->previous() }}" class="text-sm font-semibold text-slate-500 hover:text-slate-700 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('revision.store') }}" method="POST" @submit="isSubmitting = true">
        @csrf
        <input type="hidden" name="patient_history_id" value="{{ $history->id }}">
        <input type="hidden" name="edited_by" value="{{ Auth::user()->dokter->id }}">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Informasi Kunjungan</h3>
                    <div class="space-y-4">
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold">Pasien</p>
                            <p class="text-sm font-bold text-slate-700">{{ $history->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-400 uppercase font-bold">Tanggal & Antrian</p>
                            <p class="text-sm font-semibold text-slate-600">{{ \Carbon\Carbon::parse($history->tanggal_kunjungan)->format('d F Y') }} <span class="text-emerald-500 ml-1">#{{ $history->nomor_antrian }}</span></p>
                        </div>
                        <div class="pt-4 border-t border-slate-50">
                            <p class="text-[10px] text-slate-400 uppercase font-bold mb-2">Keluhan Asli</p>
                            <p class="text-xs text-slate-500 leading-relaxed italic">"{{ $history->keluhan }}"</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-600 p-6 rounded-3xl shadow-lg shadow-blue-200 text-white">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-white/20 rounded-lg backdrop-blur-md">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h4 class="font-bold text-sm">Penting</h4>
                    </div>
                    <p class="text-xs text-blue-100 leading-relaxed">Setiap perubahan data medis akan dicatat dalam log riwayat revisi sesuai standar prosedur medis.</p>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Bagian Yang Direvisi</label>
                            <select name="field_name" class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-500/20 font-semibold text-slate-700 outline-none transition-all">
                                <option value="diagnosa" {{ old('field_name') == 'diagnosa' ? 'selected' : '' }}>Diagnosa Medis</option>
                                <option value="tindakan" {{ old('field_name') == 'tindakan' ? 'selected' : '' }}>Tindakan / Prosedur</option>
                                <option value="resep" {{ old('field_name') == 'resep' ? 'selected' : '' }}>Resep Obat</option>
                            </select>
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Nilai Saat Ini</label>
                            <textarea name="old_value" readonly class="w-full bg-slate-50 border-none rounded-2xl px-4 py-3 text-sm text-slate-400 h-32 outline-none cursor-not-allowed">{{ $history->diagnosa }}</textarea>
                            <p class="text-[10px] text-slate-400 mt-2 italic">*Data ini diambil dari database saat ini</p>
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-blue-600 uppercase mb-2 ml-1">Nilai Revisi Baru</label>
                            <textarea name="new_value" placeholder="Masukkan diagnosa/tindakan baru..." class="w-full bg-white border border-blue-100 rounded-2xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 h-32 outline-none transition-all shadow-sm">{{ old('new_value') }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2 ml-1">Alasan Revisi Medis</label>
                            <textarea name="edit_reason" placeholder="Contoh: Koreksi hasil lab terbaru atau kesalahan input administratif..." class="w-full bg-white border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 h-24 outline-none transition-all">{{ old('edit_reason') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-50 flex items-center justify-end gap-4">
                        <button type="reset" class="px-6 py-3 text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">
                            Reset Form
                        </button>
                        <button type="submit" 
                                class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-8 py-3 rounded-2xl text-sm font-bold transition-all shadow-lg shadow-blue-200 flex items-center gap-2"
                                :class="isSubmitting ? 'opacity-70 cursor-not-allowed' : ''">
                            <span x-show="!isSubmitting">Simpan Revisi</span>
                            <span x-show="isSubmitting" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection