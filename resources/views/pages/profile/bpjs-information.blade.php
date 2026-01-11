@extends('layout.profile-layout')

@section('content')
<div class="container mx-auto mt-10 px-4 py-0 max-w-4xl">
      @if (session('success'))
        <x-partials.notif-component message="Berhasil" sign="Data Bpjs Medis Berhasil Dibuat">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
      @if (session('warning'))
        <x-partials.notif-component message="Warning" sign="Data Bpjs telah dibuat">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
    @if($bpjs)
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-bold text-slate-800">Informasi <span class="text-emerald-600">BPJS Kesehatan</span></h1>
            <p class="text-slate-500 mt-2">Data kepesertaan aktif Anda untuk layanan kesehatan.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-5">
                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-600 to-emerald-800 p-8 shadow-2xl shadow-emerald-200">
                    <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10"></div>
                    <div class="relative z-10">
                        <div class="flex justify-between items-start mb-12">
                            <div class="bg-white/20 p-2 rounded-lg backdrop-blur-md">
                                <span class="text-white font-bold tracking-tighter text-xl">BPJS</span>
                            </div>
                            <span class="text-xs font-bold text-emerald-100 uppercase tracking-widest">Kartu Digital</span>
                        </div>
                        <div class="mb-8">
                            <p class="text-emerald-100 text-xs uppercase tracking-widest mb-1">Nomor Kartu</p>
                            <p class="text-white text-2xl font-mono tracking-widest font-bold">{{ wordwrap($bpjs->nomor_kartu, 4, ' ', true) }}</p>
                        </div>
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-emerald-100 text-xs uppercase mb-1">Nama Peserta</p>
                                <p class="text-white font-semibold text-lg uppercase">{{ $bpjs->nama_peserta }}</p>
                            </div>
                            <span class="bg-white text-emerald-700 px-3 py-1 rounded-full text-xs font-bold shadow-sm uppercase">{{ $bpjs->status_kepesertaan }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
                 <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center">
                    <span class="w-1.5 h-6 bg-emerald-500 rounded-full mr-3"></span>
                    Detail Kepesertaan
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6">
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">NIK Pasien</label>
                        <p class="text-slate-700 font-medium mt-1">{{ $bpjs->nik }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Kelas Rawat</label>
                        <p class="text-slate-700 font-medium mt-1">{{ str_replace('_', ' ', $bpjs->kelas) }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Faskes Utama</label>
                        <p class="text-slate-700 font-medium mt-1">{{ $bpjs->faskes_tingkat_1 }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-slate-400 uppercase tracking-wider">Jenis</label>
                        <p class="text-slate-700 font-medium mt-1 italic text-sm">{{ str_replace('_', ' ', $bpjs->jenis_peserta) }}</p>
                    </div>
                </div>
                <div class="mt-10">
                    <a href="{{ route("profile.bpjs.create") }}" class="w-full flex items-center justify-center  bg-blue-900 text-white font-bold py-3 rounded-xl hover:bg-blue-800 transition">Update Data BPJS</a>
                </div>
            </div>
        </div>

    @else
        <div class="max-w-2xl mx-auto mt-10">
            <div class="bg-white rounded-[2rem] border border-dashed border-slate-300 p-12 text-center shadow-sm">
                <div class="w-24 h-24 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                    </svg>
                </div>
                
                <h2 class="text-2xl font-bold text-slate-800 mb-3">Data BPJS Belum Terhubung</h2>
                <p class="text-slate-500 mb-8 leading-relaxed px-4">
                    Kami tidak menemukan informasi BPJS yang terkait dengan profil Anda. 
                    Hubungkan kartu BPJS Anda sekarang untuk mempermudah proses administrasi dan klaim biaya berobat.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('profile.bpjs.create') }}" class="bg-emerald-600 text-white font-bold px-8 py-3 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Hubungkan Kartu Sekarang
                    </a>
                    <button class="bg-white border border-slate-200 text-slate-600 font-bold px-8 py-3 rounded-xl hover:bg-slate-50 transition">
                        Bantuan Layanan
                    </button>
                </div>

                <div class="mt-10 pt-8 border-t border-slate-100 grid grid-cols-2 gap-4 text-left">
                    <div class="flex items-start space-x-3">
                        <span class="text-blue-600 italic">✔</span>
                        <p class="text-xs text-slate-400 font-medium leading-tight italic">Proses administrasi rumah sakit jadi lebih cepat.</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span class="text-blue-600 italic">✔</span>
                        <p class="text-xs text-slate-400 font-medium leading-tight italic">Pantau status kepesertaan secara real-time.</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

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