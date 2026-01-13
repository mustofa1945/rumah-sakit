@extends('layout.nurse-layout')

@section('content')
<div class="min-h-screen bg-[#F4F7F9] py-12 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h1 class="text-2xl font-semibold text-slate-800 tracking-tight">Registrasi & Verifikasi Pasien</h1>
                <p class="text-sm text-slate-500 mt-1">Pastikan data sesuai dengan dokumen identitas asli pasien.</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-2xl shadow-sm border border-slate-100">
                <div class="w-2 h-2 rounded-full bg-azure-500 animate-pulse"></div>
                <span class="text-xs font-bold text-slate-600 uppercase tracking-widest">Sesi Aktif Perawat</span>
            </div>
        </div>

        <form action="{{ route('nurse.user.create.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-5">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08s5.97 1.09 6 3.08c-1.29 1.94-3.5 3.22-6 3.22z"/></svg>
                </div>
                
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <span class="w-8 h-[1px] bg-slate-200"></span>
                    Kredensial Login
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Nama Pengguna (Display)</label>
                        <input type="text" name="name" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-blue-100 transition-all" placeholder="Nama Akun">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Alamat Email</label>
                        <input type="email" name="email" class="w-full bg-slate-50 border-none rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-blue-100 transition-all" placeholder="email@pasien.com">
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
                <h3 class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center gap-2">
                    <span class="w-8 h-[1px] bg-slate-200"></span>
                    Biodata Rekam Medis
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">No. Rekam Medis (RM)</label>
                        <input type="text" name="no_rm" class="w-full border-slate-200 rounded-xl px-4 py-3 text-blue-600 font-mono font-bold focus:ring-blue-500" placeholder="RM-XXXX-XXXX">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">NIK Pasien</label>
                        <input type="text" name="nik" class="w-full border-slate-200 rounded-xl px-4 py-3" placeholder="16 Digit NIK">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">No. BPJS</label>
                        <input type="text" name="no_bpjs" class="w-full border-slate-200 rounded-xl px-4 py-3" placeholder="Kartu Indonesia Sehat">
                    </div>

                    <div class="md:col-span-2 space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Nama Lengkap Sesuai KTP</label>
                        <input type="text" name="full_name" class="w-full border-slate-200 rounded-xl px-4 py-3">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Jenis Kelamin</label>
                        <select name="gender" class="w-full border-slate-200 rounded-xl px-4 py-3">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" class="w-full border-slate-200 rounded-xl px-4 py-3">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" class="w-full border-slate-200 rounded-xl px-4 py-3">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Golongan Darah</label>
                        <select name="blood_type" class="w-full border-slate-200 rounded-xl px-4 py-3">
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Agama</label>
                        <input type="text" name="religion" class="w-full border-slate-200 rounded-xl px-4 py-3">
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700 ml-1">Status Marital</label>
                        <select name="marital_status" class="w-full border-slate-200 rounded-xl px-4 py-3">
                            <option>Belum Kawin</option>
                            <option>Kawin</option>
                            <option>Cerai Hidup</option>
                            <option>Cerai Mati</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                        <span class="w-8 h-[1px] bg-slate-200"></span>
                        Alamat Tinggal
                    </h3>
                    <div class="space-y-4">
                        <textarea name="address" rows="2" class="w-full border-slate-200 rounded-xl px-4 py-3" placeholder="Alamat Lengkap"></textarea>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="village" placeholder="Kelurahan" class="border-slate-200 rounded-xl px-4 py-3 text-sm">
                            <input type="text" name="district" placeholder="Kecamatan" class="border-slate-200 rounded-xl px-4 py-3 text-sm">
                            <input type="text" name="city" placeholder="Kota/Kab" class="border-slate-200 rounded-xl px-4 py-3 text-sm">
                            <input type="text" name="province" placeholder="Provinsi" class="border-slate-200 rounded-xl px-4 py-3 text-sm">
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[2rem] p-8 shadow-xl text-white">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Kontak Darurat</h3>
                    <div class="space-y-4">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-black uppercase">Nama Wali</p>
                            <input type="text" name="emergency_contact_name" class="w-full border-none rounded-lg text-sm px-3 py-2">
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-black uppercase">Hubungan</p>
                            <input type="text" name="emergency_contact_relation" class="w-full border-none rounded-lg text-sm px-3 py-2">
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-black uppercase">Telepon</p>
                            <input type="text" name="emergency_contact_phone" class="w-full border-none rounded-lg text-sm px-3 py-2">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6">
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_filled_biodata" value="1" class="rounded text-blue-600 focus:ring-blue-500">
                    <span class="text-sm font-medium text-slate-600">Konfirmasi Kelengkapan Data</span>
                </div>
                <div class="flex gap-4">
                    <button type="button" class="px-8 py-3 rounded-xl text-sm font-bold text-slate-400 hover:text-slate-600 transition-colors">Batal</button>
                    <button type="submit" class="px-10 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-100 transition-all transform hover:-translate-y-1">
                        Finalisasi Data Pasien
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection