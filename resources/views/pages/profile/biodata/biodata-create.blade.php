@extends('layout.profile-layout')

@section('content')
<div class="min-h-screen bg-slate-50 py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('profile.biodata.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-emerald-600 transition-colors mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Profil
            </a>
            <h1 class="text-2xl font-bold text-slate-800">Lengkapi Biodata Pasien</h1>
            <p class="text-slate-500">Pastikan data yang Anda masukkan sesuai dengan KTP dan kartu jaminan kesehatan Anda.</p>
        </div>

        <form action="{{ route('profile.biodata.store') }}" method="POST" class="space-y-8">
            @csrf
            @if($biodata) @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-emerald-50 px-6 py-4 border-b border-emerald-100">
                    <h3 class="flex items-center font-bold text-emerald-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Identitas Pribadi
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap (Sesuai KTP)</label>
                        <input type="text" name="full_name" value="{{ old('full_name', $biodata->full_name ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" placeholder="Masukkan nama lengkap">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">NIK (16 Digit)</label>
                        <input type="text" name="nik" value="{{ old('nik', $biodata->nik ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" placeholder="3201xxxxxxxxxxxx">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">No. BPJS (Opsional)</label>
                        <input type="text" name="no_bpjs" value="{{ old('no_bpjs', $biodata->no_bpjs ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" placeholder="0001xxxxxxxx">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" value="{{ old('place_of_birth', $biodata->place_of_birth ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $biodata->date_of_birth ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Kelamin</label>
                        <div class="flex gap-4 mt-2">
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="gender" value="L" {{ old('gender', $biodata->gender ?? '') == 'L' ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500">
                                <span class="ml-2 text-slate-600 group-hover:text-emerald-600">Laki-laki</span>
                            </label>
                            <label class="flex items-center cursor-pointer group">
                                <input type="radio" name="gender" value="P" {{ old('gender', $biodata->gender ?? '') == 'P' ? 'checked' : '' }} class="w-4 h-4 text-emerald-600 border-slate-300 focus:ring-emerald-500">
                                <span class="ml-2 text-slate-600 group-hover:text-emerald-600">Perempuan</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Golongan Darah</label>
                        <select name="blood_type" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 outline-none appearance-none bg-no-repeat bg-[right_1rem_center]">
                            <option value="">Pilih</option>
                            @foreach(['A', 'B', 'AB', 'O'] as $type)
                                <option value="{{ $type }}" {{ old('blood_type', $biodata->blood_type ?? '') == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Agama</label>
                        <input type="text" name="religion" value="{{ old('religion', $biodata->religion ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="Contoh: Islam">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status Pernikahan</label>
                        <select name="marital_status" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-emerald-500 outline-none">
                            @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                <option value="{{ $status }}" {{ old('marital_status', $biodata->marital_status ?? '') == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
                    <h3 class="flex items-center font-bold text-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Alamat & Kontak
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Jalan</label>
                        <textarea name="address" rows="2" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Nama jalan, No. Rumah, RT/RW">{{ old('address', $biodata->address ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Desa / Kelurahan</label>
                        <input type="text" name="village" value="{{ old('village', $biodata->village ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kecamatan</label>
                        <input type="text" name="district" value="{{ old('district', $biodata->district ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kota / Kabupaten</label>
                        <input type="text" name="city" value="{{ old('city', $biodata->city ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Provinsi</label>
                        <input type="text" name="province" value="{{ old('province', $biodata->province ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kode Pos</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $biodata->postal_code ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nomor Telepon Aktif</label>
                        <input type="text" name="phone" value="{{ old('phone', $biodata->phone ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 outline-none" placeholder="08xxxxxxxx">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden border-l-4 border-l-rose-500">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="flex items-center font-bold text-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Kontak Darurat
                    </h3>
                </div>
                <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Kontak</label>
                        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $biodata->emergency_contact_name ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-rose-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Hubungan</label>
                        <input type="text" name="emergency_contact_relation" value="{{ old('emergency_contact_relation', $biodata->emergency_contact_relation ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-rose-500 outline-none" placeholder="Contoh: Istri / Ayah">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">No. Telp Darurat</label>
                        <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $biodata->emergency_contact_phone ?? '') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:ring-2 focus:ring-rose-500 outline-none">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pb-12">
                <button type="reset" class="px-6 py-3 text-sm font-bold text-slate-500 hover:text-slate-700 transition-colors">
                    Reset Form
                </button>
                <button type="submit" class="px-10 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-emerald-100 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
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
            .informasi-bpjs {
                color: var(--gray-500);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .antrian:hover,
            .riwayat:hover,
            .informasi-bpjs:hover {
                background-color: var(--gray-50);
                color: var(--blue-600);
            }

            .biodata-asli {
                color: var(--emerald-dark);
                background-color: var(--emerald-light);
                cursor: pointer;
            }
        </style>
    @endpush