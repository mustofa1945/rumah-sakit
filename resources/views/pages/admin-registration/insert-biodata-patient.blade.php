@extends('layout.adregis-layout')

@section('content')
@if($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc ml-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<nav class="flex text-xs text-gray-400 ml-2 mb-2 space-x-2">
    <a href="{{ url()->previous() }}" class="hover:text-green-600">Dashboard</a>
    <span>/</span>
    <span class="text-green-600 font-medium">Add Account</span>
</nav>

<div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden" x-data="{ isSubmitting: false, showPassword: false }">
    
    <div class="h-1.5 w-full bg-slate-50">
        <div class="h-full bg-emerald-500 transition-all duration-500" style="width: 25%"></div>
    </div>

    <form action="{{ route('admin-registration.store') }}" method="POST" @submit="isSubmitting = true" class="p-8 space-y-12">
        @csrf

        <section class="space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-50 pb-3">
                <div class="p-2 bg-blue-600 rounded-lg shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.15em]">Kredensial Akun Sistem</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Username</label>
                    <input type="text" name="name" value="user_baru" required placeholder="username_pasien" class="p-2.5 border border-slate-100 bg-white focus:border-blue-200 focus:ring-4 focus:ring-blue-50 rounded-xl text-sm transition-all font-medium">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Email Aktif</label>
                    <input type="email" name="email" value="pasien@rs-pemerintah.com" required placeholder="pasien@email.com" class="p-2.5 border border-slate-100 bg-white focus:border-blue-200 focus:ring-4 focus:ring-blue-50 rounded-xl text-sm transition-all font-medium">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Password Sementara</label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" name="password" value="P@ssw0rd2024" required class="w-full p-2.5 border border-slate-100 bg-white focus:border-blue-200 focus:ring-4 focus:ring-blue-50 rounded-xl text-sm transition-all font-mono">
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-2.5 text-slate-300">
                            <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <svg x-show="showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 1.247 0 2.447.254 3.528.711m-1.414 1.414L11.242 11.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-50 pb-3">
                <div class="p-2 bg-slate-100 rounded-lg"><svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.15em]">Administrasi Rumah Sakit</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">No. Rekam Medis</label>
                    <input type="text" name="no_rm" value="RM-{{ now()->format('Ymd') }}-001" class="p-2.5 bg-slate-50 border-transparent focus:border-blue-200 focus:bg-white focus:ring-4 focus:ring-blue-50 rounded-xl text-sm font-mono">
                </div>
                <div class="flex flex-col gap-1.5 md:col-span-2">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">No. BPJS Kesehatan</label>
                    <input type="text" name="no_bpjs" value="0001234567890" class="p-2.5 bg-slate-50 border-transparent focus:border-blue-200 focus:bg-white focus:ring-4 focus:ring-blue-50 rounded-xl text-sm font-mono">
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-50 pb-3">
                <div class="p-2 bg-emerald-50 rounded-lg"><svg class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.15em]">Biodata Lengkap Pasien</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div class="md:col-span-2 flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Nama Lengkap (Sesuai KTP)</label>
                    <input type="text" name="full_name" value="Nama Lengkap Pasien" required class="p-2.5 border border-slate-100 focus:border-emerald-200 focus:ring-4 focus:ring-emerald-50 rounded-xl text-sm transition-all">
                </div>
                <div class="md:col-span-2 flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">NIK (16 Digit)</label>
                    <input type="text" name="nik" value="327101XXXXXXXXXX" required maxlength="16" class="p-2.5 border border-slate-100 focus:border-emerald-200 focus:ring-4 focus:ring-emerald-50 rounded-xl text-sm font-mono">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Jenis Kelamin</label>
                    <select name="gender" class="p-2.5 border border-slate-100 bg-white rounded-xl text-sm appearance-none cursor-pointer">
                        <option value="L" selected>Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Golongan Darah</label>
                    <select name="blood_type" class="p-2.5 border border-slate-100 bg-white rounded-xl text-sm">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O" selected>O</option>
                    </select>
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Tempat Lahir</label>
                    <input type="text" name="place_of_birth" value="Jakarta" class="p-2.5 border border-slate-100 rounded-xl text-sm">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" value="2000-01-01" class="p-2.5 border border-slate-100 rounded-xl text-sm">
                </div>
                <div class="flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Agama</label>
                    <input type="text" name="religion" value="Islam" class="p-2.5 border border-slate-100 rounded-xl text-sm">
                </div>
                <div class="flex flex-col gap-1.5 md:col-span-1">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Status Marital</label>
                    <select name="marital_status" class="p-2.5 border border-slate-100 rounded-xl text-sm">
                        <option selected>Belum Kawin</option>
                        <option>Kawin</option>
                        <option>Cerai Hidup</option>
                        <option>Cerai Mati</option>
                    </select>
                </div>
            </div>
        </section>

        <section class="space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-50 pb-3">
                <div class="p-2 bg-slate-100 rounded-lg"><svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg></div>
                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-[0.15em]">Alamat Lengkap & Domisili</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="md:col-span-3 flex flex-col gap-1.5">
                    <label class="text-[11px] font-semibold text-slate-500 ml-1 uppercase">Alamat Sesuai Identitas</label>
                    <textarea name="address" rows="2" class="p-2.5 border border-slate-100 rounded-xl text-sm resize-none focus:border-slate-300">Jl. Contoh Nomor 123</textarea>
                </div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase">Kelurahan</label><input type="text" name="village" value="Gambir" class="p-2.5 border border-slate-100 rounded-xl text-sm"></div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase">Kecamatan</label><input type="text" name="district" value="Gambir" class="p-2.5 border border-slate-100 rounded-xl text-sm"></div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase">Kota</label><input type="text" name="city" value="Jakarta Pusat" class="p-2.5 border border-slate-100 rounded-xl text-sm"></div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase">Provinsi</label><input type="text" name="province" value="DKI Jakarta" class="p-2.5 border border-slate-100 rounded-xl text-sm"></div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase">Kode Pos</label><input type="text" name="postal_code" value="10110" class="p-2.5 border border-slate-100 rounded-xl text-sm"></div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase">No. Telepon Aktif</label><input type="text" name="phone" value="081234567890" class="p-2.5 border border-slate-100 rounded-xl text-sm font-mono"></div>
            </div>
        </section>

        <section class="bg-slate-50 p-6 rounded-2xl space-y-6">
            <div class="flex items-center gap-3 border-b border-slate-200/50 pb-3">
                <div class="p-2 bg-white rounded-lg"><svg class="h-4 w-4 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg></div>
                <h3 class="text-xs font-bold text-slate-500 uppercase tracking-[0.15em]">Kontak Darurat</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider ml-1">Nama Penanggung Jawab</label><input type="text" name="emergency_contact_name" value="Ibu Kandung" class="p-2.5 border-transparent bg-white rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-slate-200"></div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider ml-1">Hubungan</label><input type="text" name="emergency_contact_relation" value="Orang Tua" placeholder="Ibu/Ayah/Suami" class="p-2.5 border-transparent bg-white rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-slate-200"></div>
                <div class="flex flex-col gap-1.5"><label class="text-[11px] font-semibold text-slate-500 uppercase tracking-wider ml-1">No. Telp Darurat</label><input type="text" name="emergency_contact_phone" value="08987654321" class="p-2.5 border-transparent bg-white rounded-xl text-sm shadow-sm focus:ring-2 focus:ring-slate-200 font-mono"></div>
            </div>
        </section>

        <div class="flex items-center justify-between pt-8 border-t border-slate-50">
            <button type="reset" class="text-[11px] font-bold text-slate-300 uppercase tracking-widest hover:text-rose-400 transition-all">Reset Data</button>
            <button type="submit" :disabled="isSubmitting" class="bg-slate-800 hover:bg-slate-900 text-white px-10 py-3.5 rounded-2xl font-bold text-xs uppercase tracking-widest transition-all shadow-xl shadow-slate-200 flex items-center gap-3">
                <span x-text="isSubmitting ? 'Mendaftarkan...' : 'Simpan & Aktivasi Pasien'"></span>
                <svg x-show="!isSubmitting" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </button>
        </div>
    </form>
</div>
@endsection