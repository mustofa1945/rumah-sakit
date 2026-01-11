@extends('layout.adminLayout')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <nav class="flex text-sm text-gray-400 mb-2">
            <span>Manajemen Data</span>
            <span class="mx-2">/</span>
            <span class="text-emerald-600 font-medium">Tambah Poli</span>
        </nav>
        <h1 class="text-3xl font-bold text-gray-800">Tambah Poliklinik</h1>
        <p class="text-gray-500 mt-1">Tambahkan spesialisasi layanan medis baru ke dalam sistem.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl shadow-emerald-900/5 border border-gray-100 overflow-hidden">
        <div class="h-2 bg-linear-to-r from-[#064e3b] to-blue-600"></div>

        <form action="{{ route('store.poli') }}" method="POST" class="p-8 md:p-10">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Poliklinik <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <input type="text" name="name" id="name" placeholder="Contoh: Poli Mata, Poli Jantung..." required
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-2xl text-gray-800 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all duration-200">
                    </div>
                    @error('name')
                        <p class="mt-2 text-xs text-red-500 font-light italic">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-gray-400 font-light italic">* Gunakan nama resmi sesuai standar pelayanan medis.</p>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-50 flex items-center justify-end space-x-4">
                <a href="{{ route('view.poli') }}" class="px-6 py-3 text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
                    Batal
                </a>
                <button type="submit" class="relative group overflow-hidden px-8 py-3 bg-[#064e3b] text-white rounded-2xl font-bold shadow-lg shadow-emerald-200 hover:shadow-emerald-300 transition-all duration-300 transform hover:-translate-y-1">
                    <span class="relative z-10 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Data
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
