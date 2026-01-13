@extends('layout.mainLayout')

@section('content')
@if (session('warning'))
        <x-partials.notif-component message="Warning" sign="{{ session('warning') }}">
            <x-partials.icon-alert />
        </x-partials.notif-component>
    @endif
<div class="min-h-screen bg-[#F8FAFC] py-12 px-4">
    <div class="max-w-5xl mx-auto">
        
        <a href="{{ route('tenaga-medis.index') }}" class="inline-flex items-center text-slate-400 hover:text-blue-600 transition-colors mb-8 group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            <span class="font-medium">Kembali ke Daftar Dokter</span>
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white rounded-[2.5rem] p-4 shadow-xl shadow-slate-200/50 border border-slate-100">
                    <div class="aspect-[3/4] rounded-[2rem] overflow-hidden bg-slate-100 relative">
                        <img src="{{ $profile->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode($profile->full_name).'&background=E0F2FE&color=0369A1&size=512' }}" 
                             alt="{{ $profile->full_name }}" 
                             class="w-full h-full object-cover">
                        
                        @if($profile->is_active)
                        <div class="absolute top-4 right-4 bg-emerald-500 text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest shadow-lg">
                            Aktif Praktik
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-6 px-4 pb-4 text-center">
                        <h1 class="text-2xl font-bold text-slate-800 leading-tight">
                            <span class="text-blue-600 font-medium text-lg block mb-1">{{ $profile->title_prefix }}</span>
                            {{ $profile->full_name }}, {{ $profile->title_suffix }}
                        </h1>
                        <p class="text-slate-500 font-medium mt-2">{{ $profile->specialization }}</p>
                        @if($profile->sub_specialization)
                            <span class="inline-block mt-2 px-3 py-1 bg-slate-100 text-slate-600 rounded-lg text-xs font-semibold">
                                {{ $profile->sub_specialization }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-[2rem] p-8 text-white shadow-lg shadow-blue-200">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-blue-100 text-xs font-bold uppercase tracking-wider">Pengalaman</p>
                            <p class="text-xl font-bold">{{ $profile->practice_experience_years }} Tahun Praktik</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8 space-y-6">
                
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center">
                        <span class="w-1.5 h-6 bg-blue-500 rounded-full mr-3"></span>
                        Profil Profesional
                    </h3>
                    <p class="text-slate-600 leading-relaxed italic">
                        "{{ $profile->biography ?? 'Dokter belum menambahkan biografi singkat.' }}"
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-3">Pendidikan Terakhir</h4>
                        <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line">
                            {{ $profile->education }}
                        </p>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
                        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-3">Legalitas Praktik</h4>
                        <div class="space-y-3">
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">No. STR (Publik)</p>
                                <p class="text-sm font-mono text-slate-700">{{ $profile->str_number }}</p>
                            </div>
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter">Masa Berlaku STR</p>
                                <p class="text-sm text-slate-700">{{ \Carbon\Carbon::parse($profile->str_valid_until)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
                        <div>
                            <h3 class="text-xl font-bold mb-2">Lokasi & Jadwal Praktik</h3>
                            <div class="flex items-center text-slate-400 mb-6">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <span>{{ $profile->practice_location }}</span>
                            </div>
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10">
                                <p class="text-sm leading-relaxed text-blue-100">
                                    {{ $profile->practice_schedule }}
                                </p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <a href="{{ route('queue.create', ['dokter_id' => $profile->dokter_id]) }}" 
                               class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-500 text-white rounded-[1.5rem] font-bold transition-all shadow-xl shadow-blue-900/20">
                                Ambil Nomor Antrean
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-blue-600/10 rounded-full blur-3xl"></div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection