@extends('layout.profile-layout')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-3xl">
    <nav class="mb-6 flex items-center text-sm font-medium text-slate-400">
        <a href="{{ route('profile.bpjs.index') }}" class="hover:text-emerald-600 transition">Informasi BPJS</a>
        <span class="mx-2">/</span>
        <span class="text-slate-800">
            {{ $bpjs ? 'Perbarui Data' : 'Hubungkan Kartu' }}
        </span>
    </nav>

    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-100 overflow-hidden border border-gray-50">
        <div class="h-1.5 w-full bg-slate-100">
            <div class="h-full bg-emerald-500 w-1/2"></div>
        </div>

        <div class="p-8 md:p-12">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800">
                        {{ $bpjs ? 'Perbarui Data BPJS' : 'Lengkapi Data BPJS' }}
                    </h1>
                    <p class="text-slate-500 text-sm mt-1">
                        Pastikan data sesuai dengan kartu fisik atau aplikasi Mobile JKN Anda.
                    </p>
                </div>
            </div>

            <form action="{{ route('profile.bpjs.store') }}" method="POST" class="space-y-8">
                @csrf

                {{-- IDENTITAS --}}
                <div>
                    <h3 class="text-sm font-bold text-blue-900 uppercase tracking-widest mb-4">
                        01. Identitas Kartu
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold">Nomor Kartu BPJS</label>
                            <input type="text" name="nomor_kartu" maxlength="16"
                                value="{{ old('nomor_kartu', $bpjs->nomor_kartu ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border-gray-200">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">NIK</label>
                            <input type="text" name="nik" maxlength="16"
                                value="{{ old('nik', $bpjs->nik ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border-gray-200">
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm font-semibold">Nama Peserta</label>
                            <input type="text" name="nama_peserta"
                                value="{{ old('nama_peserta', $bpjs->nama_peserta ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border-gray-200 uppercase">
                        </div>
                    </div>
                </div>

                <hr>

                {{-- DETAIL --}}
                <div>
                    <h3 class="text-sm font-bold text-blue-900 uppercase tracking-widest mb-4">
                        02. Detail Layanan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold">Kelas</label>
                            <select name="kelas" class="w-full px-4 py-3 rounded-xl border-gray-200">
                                @foreach(['KELAS_1','KELAS_2','KELAS_3'] as $kelas)
                                    <option value="{{ $kelas }}"
                                        {{ old('kelas', $bpjs->kelas ?? '') == $kelas ? 'selected' : '' }}>
                                        {{ str_replace('_',' ', $kelas) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Jenis Peserta</label>
                            <select name="jenis_peserta" class="w-full px-4 py-3 rounded-xl border-gray-200">
                                @foreach(['MANDIRI','PBI','PEKERJA_PENERIMA_UPAH','BUKAN_PENERIMA_UPAH'] as $jenis)
                                    <option value="{{ $jenis }}"
                                        {{ old('jenis_peserta', $bpjs->jenis_peserta ?? '') == $jenis ? 'selected' : '' }}>
                                        {{ ucwords(strtolower(str_replace('_',' ', $jenis))) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm font-semibold">Faskes Tingkat 1</label>
                            <input type="text" name="faskes_tingkat_1"
                                value="{{ old('faskes_tingkat_1', $bpjs->faskes_tingkat_1 ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border-gray-200">
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Status</label>
                            <select name="status_kepesertaan" class="w-full px-4 py-3 rounded-xl border-gray-200">
                                @foreach(['AKTIF','NONAKTIF','MENUNGGAK'] as $status)
                                    <option value="{{ $status }}"
                                        {{ old('status_kepesertaan', $bpjs->status_kepesertaan ?? '') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold">Tanggal Aktif</label>
                            <input type="date" name="tanggal_aktif"
                                value="{{ old('tanggal_aktif', $bpjs->tanggal_aktif ?? '') }}"
                                class="w-full px-4 py-3 rounded-xl border-gray-200">
                        </div>
                    </div>
                </div>

                <div class="pt-8 flex gap-4">
                    <button class="flex-1 bg-emerald-600 text-white font-bold py-4 rounded-2xl">
                        {{ $bpjs ? 'Perbarui Data BPJS' : 'Simpan Informasi BPJS' }}
                    </button>

                    <a href="{{ route('profile.bpjs.index') }}"
                        class="flex-1 text-center py-4 text-slate-500 font-semibold">
                        Batal
                    </a>
                </div>
            </form>
        </div>
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
            .riwayat,
            .biodata-asli {
                color: var(--gray-500);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .antrian:hover,
            .riwayat:hover,
            .biodata-asli:hover {
                background-color: var(--gray-50);
                color: var(--blue-600);
            }

            .informasi-bpjs  {
                color: var(--emerald-dark);
                background-color: var(--emerald-light);
                cursor: pointer;
            }
        </style>
