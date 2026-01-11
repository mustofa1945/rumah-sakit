@extends('layout.admin')

@section('content')
<div class="min-h-screen bg-[#F8FAFC] py-10 px-4">
    <div class="max-w-4xl mx-auto">
        
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <nav class="flex text-xs text-gray-400 mb-2 space-x-2">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-green-600">Dashboard</a>
                    <span>/</span>
                    <a href="{{ url()->previous() }}" class="hover:text-green-600">Rekam medis</a>
                    <span>/</span>
                    <span class="text-green-600 font-medium">Input Rekam Medis</span>
                </nav>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Input Rekam Medis</h1>
                <p class="text-gray-500 mt-1">Lengkapi data pemeriksaan untuk antrian <span class="px-2 py-0.5 bg-blue-50 text-blue-700 rounded-md font-bold">#{{ $antrian->nomor_antrian }}</span></p>
            </div>
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-sm font-semibold text-gray-600 rounded-xl hover:bg-gray-50 hover:text-blue-600 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-500 p-1">
                <div class="bg-green-50/90 backdrop-blur-sm px-6 py-3 flex items-center gap-3">
                    <span class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center shadow-sm">
                        <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                    </span>
                    <p class="text-sm text-green-800 font-semibold tracking-wide">Sinkronisasi Otomatis: Data pasien dan dokter telah dimuat sesuai jadwal.</p>
                </div>
            </div>

            <form action="{{ route('admin.patients.histories.store' , ['user' => $antrian->user_id]) }}" method="POST" class="p-8 md:p-12">
                @csrf
                
                <input type="hidden" name="user_id" value="{{ $antrian->user_id }}">
                <input type="hidden" name="dokter_id" value="{{ $antrian->dokter_id }}">
                <input type="hidden" name="tanggal_kunjungan" value="{{ $antrian->tanggal_kunjungan }}">
                <input type="hidden" name="nomor_antrian" value="{{ $antrian->nomor_antrian }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div class="relative group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Nama Pasien</label>
                        <div class="flex items-center bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 group-focus-within:bg-white transition-all">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <input type="text" value="{{ $antrian->user->name }}" class="bg-transparent border-none text-gray-800 font-bold p-0 focus:ring-0 w-full" readonly>
                        </div>
                    </div>
                    <div class="relative group">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Dokter Pemeriksa</label>
                        <div class="flex items-center bg-gray-50 border border-gray-100 rounded-2xl px-5 py-4 group-focus-within:bg-white transition-all">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            <input type="text" value="{{ $antrian->dokter->name }}" class="bg-transparent border-none text-gray-800 font-bold p-0 focus:ring-0 w-full" readonly>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div>
                        <label for="keluhan" class="flex justify-between items-center mb-3">
                            <span class="text-sm font-bold text-gray-700 tracking-tight">Keluhan Utama <span class="text-red-500">*</span></span>
                            <span class="text-[10px] bg-green-100 text-green-700 px-2 py-1 rounded-md font-bold uppercase">Wajib Diisi</span>
                        </label>
                        <textarea name="keluhan" id="keluhan" rows="3" required 
                            class="w-full border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all duration-300 placeholder:text-gray-300" 
                            placeholder="Tuliskan keluhan utama pasien secara mendalam...">{{ old('keluhan', $antrian->keluhan) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="diagnosa" class="block text-sm font-bold text-gray-700 mb-3 tracking-tight">Diagnosa Medis</label>
                            <textarea name="diagnosa" id="diagnosa" rows="4" 
                                class="w-full border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all duration-300 placeholder:text-gray-300" 
                                placeholder="Analisis diagnosa...">{{ old('diagnosa') }}</textarea>
                        </div>
                        <div>
                            <label for="tindakan" class="block text-sm font-bold text-gray-700 mb-3 tracking-tight">Tindakan / Prosedur</label>
                            <textarea name="tindakan" id="tindakan" rows="4" 
                                class="w-full border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all duration-300 placeholder:text-gray-300" 
                                placeholder="Tindakan yang dilakukan...">{{ old('tindakan') }}</textarea>
                        </div>
                    </div>

                    <div>
                        <label for="resep" class="block text-sm font-bold text-gray-700 mb-3 tracking-tight">Resep Obat</label>
                        <div class="relative">
                            <textarea name="resep" id="resep" rows="3" 
                                class="w-full border-gray-200 rounded-2xl focus:ring-4 focus:ring-green-500/10 focus:border-green-500 transition-all duration-300 placeholder:text-gray-300 pl-12" 
                                placeholder="Contoh: Paracetamol 500mg (3x1 sesudah makan)">{{ old('resep') }}</textarea>
                            <svg class="w-6 h-6 text-gray-300 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-4 tracking-tight">Status Kunjungan Akhir</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="relative flex cursor-pointer">
                                <input type="radio" name="status" value="DONE" class="peer sr-only" checked>
                                <div class="w-full p-4 rounded-2xl border-2 border-gray-100 bg-white hover:bg-gray-50 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all duration-200">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                        <span class="font-bold text-gray-700 text-sm italic">Selesai</span>
                                    </div>
                                </div>
                            </label>

                            <label class="relative flex cursor-pointer">
                                <input type="radio" name="status" value="EMERGENCY" class="peer sr-only">
                                <div class="w-full p-4 rounded-2xl border-2 border-gray-100 bg-white hover:bg-gray-50 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all duration-200">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center text-red-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                        </div>
                                        <span class="font-bold text-gray-700 text-sm italic">Darurat</span>
                                    </div>
                                </div>
                            </label>

                            <label class="relative flex cursor-pointer">
                                <input type="radio" name="status" value="CANCELED" class="peer sr-only">
                                <div class="w-full p-4 rounded-2xl border-2 border-gray-100 bg-white hover:bg-gray-50 peer-checked:border-gray-400 peer-checked:bg-gray-100 transition-all duration-200">
                                    <div class="flex flex-col items-center gap-2">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </div>
                                        <span class="font-bold text-gray-700 text-sm italic">Batal</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex flex-col md:flex-row gap-4 border-t border-gray-50 pt-10">
                    <button type="reset" class="order-2 md:order-1 px-8 py-4 text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors uppercase tracking-widest">
                        Bersihkan Form
                    </button>
                    <button type="submit" class="order-1 md:order-2 flex-1 bg-gradient-to-r from-green-700 to-green-600 hover:from-green-800 hover:to-green-700 text-white font-extrabold py-4 rounded-2xl shadow-xl shadow-green-200 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-3 uppercase tracking-wider text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Simpan Rekam Medis
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-10 flex flex-col items-center">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Secure Medical Record System</p>
            </div>
            <p class="text-xs text-gray-400">© {{ date('Y') }} — Dashboard Admin v2.1.0</p>
        </div>
    </div>
</div>
@endsection