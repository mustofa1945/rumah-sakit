@extends('layout.adminLayout')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <nav class="flex text-sm text-gray-400 mb-2">
            <span>Manajemen Data</span>
            <span class="mx-2">/</span>
            <span class="text-blue-600 font-medium">
                @isset($dokter) Edit Dokter @else Tambah Dokter @endisset
            </span>
        </nav>
        <h1 class="text-3xl font-bold text-gray-800">@isset($dokter) Edit Tenaga Medis @else Registrasi Tenaga Medis @endisset</h1>
        <p class="text-gray-500 mt-1">Lengkapi informasi dokter dan jadwal praktek poliklinik.</p>
    </div>

    <div class="bg-white rounded-3xl shadow-xl shadow-blue-900/5 border border-gray-100 overflow-hidden">
        <div class="h-2 bg-linear-to-r from-blue-600 to-[#064e3b]"></div>
        
        <form action="@isset($dokter) {{ route('update.dokter', $dokter->id) }} @else {{ route('store.dokter') }} @endisset" method="POST" class="p-8 md:p-10">
            @csrf
            @isset($dokter)
                @method('PUT')
            @endisset
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-6">
                    <h3 class="text-sm font-bold text-emerald-800 uppercase tracking-widest border-b pb-2">Informasi Profil</h3>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap & Gelar</label>
                        <input type="text" name="name" placeholder="Contoh: dr. Aris, Sp.PD" required
                            value="{{ $dokter->name ?? old('name') }}"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Spesialisasi Poliklinik</label>
                        <select name="poli_id" required
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 focus:bg-white transition-all outline-none appearance-none">
                            <option value="" disabled @empty($dokter) selected @endempty>Pilih Poliklinik</option>
                            @foreach($polis as $poli)
                                <option value="{{ $poli->id }}" @isset($dokter) {{ $dokter->poli_id == $poli->id ? 'selected' : '' }} @endisset>
                                    {{ $poli->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-sm font-bold text-blue-800 uppercase tracking-widest border-b pb-2">Jadwal Praktek</h3>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Hari Praktek</label>
                        <select name="schedule_day" required
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all outline-none">
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                                <option value="{{ $day }}" @isset($dokter) {{ $dokter->schedule_day == $day ? 'selected' : '' }} @endisset>{{ $day }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Mulai</label>
                            <input type="time" name="start_time" required
                                value="{{ \Carbon\Carbon::parse($dokter->start_time)->format('H:i')  ?? old('start_time') }}"
                                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Jam Selesai</label>
                            <input type="time" name="end_time" required
                                value="{{ \Carbon\Carbon::parse($dokter->end_time)->format('H:i')  ?? old('end_time') }}"
                                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 focus:bg-white transition-all outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-gray-50 flex items-center justify-end space-x-4">
                <a href="{{ route('view.dokter') }}" type="button" class="px-6 py-3 text-sm font-semibold text-gray-400 hover:text-gray-600 transition">
                    Batal
                </a>
                <button type="submit" class="px-10 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-2xl font-bold shadow-lg shadow-blue-200 hover:shadow-blue-300 transition-all transform hover:-translate-y-1 active:scale-95">
                    @isset($dokter) Update Dokter @else Simpan Data Dokter @endisset
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
