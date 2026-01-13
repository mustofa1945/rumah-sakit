@extends('layout.adregis-layout')
@section('content')
<nav class="flex text-[10px] text-slate-400 ml-2 mb-6 space-x-2 uppercase tracking-widest">
    <a href="{{ route('admin-registration.index') }}" class="hover:text-emerald-600 transition-colors">Data Pasien</a>
    <span>/</span>
    <span class="text-slate-800 font-bold">Input Antrian Baru</span>
</nav>

<div class="max-w-4xl mx-auto">
    <form action="{{ route('poli.index') }}" method="POST" class="space-y-6">
        @csrf
        <input type="hidden" name="user_id" value="{{ $patient->id }}">
        <input type="hidden" name="tanggal_kunjungan" value="{{ now()->format('Y-m-d') }}">

        <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="bg-slate-900 p-8 text-white flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold tracking-tight">Registrasi Kunjungan</h2>
                    <p class="text-slate-400 text-xs mt-1 uppercase tracking-widest font-medium">Pasien: {{ $patient->name }}</p>
                </div>
                <div class="text-right">
                    <span class="block text-[10px] text-slate-400 uppercase font-bold italic">Tanggal Sesi</span>
                    <span class="text-sm font-mono text-emerald-400">{{ now()->format('d F Y') }}</span>
                </div>
            </div>

            <div class="p-8 md:p-12 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider ml-1">Dokter Pemeriksa</label>
                        <div class="relative group">
                            <select name="dokter_id" class="w-full pl-4 pr-10 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm appearance-none focus:bg-white focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all outline-none cursor-pointer font-semibold text-slate-700">
                                <option value="">-- NULL (Belum Ditentukan) --</option>
                                @foreach($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">dr. {{ $dokter->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider ml-1">Perawat Pendamping</label>
                        <div class="relative group">
                            <select name="nurse_id" class="w-full pl-4 pr-10 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm appearance-none focus:bg-white focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all outline-none cursor-pointer font-semibold text-slate-700">
                                <option value="">-- NULL (Belum Ditentukan) --</option>
                                @foreach($nurses as $nurse)
                                    <option value="{{ $nurse->id }}">{{ $nurse->name }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border-t border-slate-50 pt-10">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider ml-1">Nomor Antrian Manual (Opsional)</label>
                        <input type="number" name="nomor_antrian" placeholder="Auto-generate jika kosong" class="w-full px-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-sm focus:bg-white focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all outline-none font-mono">
                    </div>
                    
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider ml-1">Prioritas Status</label>
                        <div class="flex gap-3">
                            <label class="flex-1">
                                <input type="radio" name="status" value="WAITING" checked class="hidden peer">
                                <div class="text-center py-3 border border-slate-200 rounded-2xl text-xs font-bold text-slate-400 peer-checked:bg-emerald-50 peer-checked:border-emerald-500 peer-checked:text-emerald-700 cursor-pointer transition-all uppercase tracking-widest">Waiting</div>
                            </label>
                            <label class="flex-1">
                                <input type="radio" name="status" value="EMERGENCY" class="hidden peer">
                                <div class="text-center py-3 border border-slate-200 rounded-2xl text-xs font-bold text-slate-400 peer-checked:bg-rose-50 peer-checked:border-rose-500 peer-checked:text-rose-700 cursor-pointer transition-all uppercase tracking-widest">Emergency</div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="space-y-2 border-t border-slate-50 pt-10">
                    <label class="text-[11px] font-black text-slate-500 uppercase tracking-wider ml-1">Keluhan Pasien / Catatan Awal</label>
                    <textarea name="keluhan" rows="4" required placeholder="Tuliskan keluhan utama pasien di sini..." class="w-full px-4 py-4 bg-slate-50 border border-slate-200 rounded-[1.5rem] text-sm focus:bg-white focus:ring-4 focus:ring-emerald-500/5 focus:border-emerald-500 transition-all outline-none resize-none"></textarea>
                </div>
            </div>

            <div class="p-8 bg-slate-50/50 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ url()->previous() }}" class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.2em] hover:text-slate-600 transition-colors">Batal</a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-emerald-200 transition-all active:scale-95 flex items-center gap-3">
                    Submit Antrian
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 5l7 7m0 0l-7 7m7-7H3" /></svg>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
