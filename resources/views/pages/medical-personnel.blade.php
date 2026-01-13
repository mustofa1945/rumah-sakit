@extends("layout.mainLayout")

@section("content")
@if (session('warning'))
        <x-partials.notif-component message="Warning" sign="{{ session('warning') }}">
            <x-partials.icon-alert />
        </x-partials.notif-component>
    @endif
<div class="min-h-screen bg-white">
    <section class="pt-24 pb-16 bg-gradient-to-b from-blue-50/50 to-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <span class="px-4 py-1.5 bg-blue-100 text-blue-700 rounded-full text-xs font-bold tracking-widest uppercase mb-4 inline-block">
                Professional Experts
            </span>
            <h1 class="text-5xl font-black text-slate-900 mb-6 tracking-tight">
                Kenali Tenaga <span class="text-blue-600">Medis Kami.</span>
            </h1>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">
                Tim dokter spesialis kami berkomitmen memberikan pelayanan kesehatan terbaik dengan standar internasional dan teknologi medis terkini.
            </p>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 mb-20">
        <div class="bg-white p-2 rounded-[2rem] shadow-2xl shadow-slate-200/60 border border-slate-100 flex flex-col md:flex-row gap-2">
            <div class="flex-1 flex items-center px-6 py-4 gap-4 border-r border-slate-100">
                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari nama dokter..." class="w-full bg-transparent border-none focus:ring-0 text-slate-700 placeholder:text-slate-300 font-medium">
            </div>
            <div class="flex-1 flex items-center px-6 py-4 gap-4">
                <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                <select class="w-full bg-transparent border-none focus:ring-0 text-slate-700 font-medium appearance-none">
                    <option value="">Semua Spesialisasi</option>
                    @foreach($polis as $poli)
                        <option value="{{ $poli->id }}">{{ $poli->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="px-10 py-4 bg-blue-600 text-white rounded-[1.5rem] font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">
                Cari
            </button>
        </div>
    </section>
    <section class="max-w-7xl mx-auto px-6 pb-32">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($dokters as $dokter)
            <div class="group">
                <div class="relative bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm group-hover:shadow-2xl group-hover:shadow-blue-100 transition-all duration-500">
                    <div class="h-80 bg-gradient-to-b from-blue-100 to-blue-50 relative overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($dokter->name) }}&background=E0F2FE&color=0369A1&size=512" 
                             alt="{{ $dokter->name }}" 
                             class="w-full h-full object-cover mix-blend-multiply opacity-80 group-hover:scale-110 transition-transform duration-700">
                        
                        <div class="absolute bottom-6 left-6">
                            <span class="px-4 py-2 bg-white/90 backdrop-blur text-blue-600 rounded-xl text-xs font-black shadow-sm uppercase tracking-widest">
                                {{ $dokter->poli->name }}
                            </span>
                        </div>
                    </div>

                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition-colors">{{ $dokter->name }}</h3>
                        
                        <div class="space-y-3 mb-8">
                            <div class="flex items-center gap-3 text-slate-500">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-blue-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                                <span class="text-sm font-medium">{{ $dokter->schedule_day }}</span>
                            </div>
                            <div class="flex items-center gap-3 text-slate-500">
                                <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center text-blue-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-sm font-medium">{{ date('H:i', strtotime($dokter->start_time)) }} - {{ date('H:i', strtotime($dokter->end_time)) }} WIB</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-6 border-t border-slate-50">
    <div class="flex flex-col gap-1">
        <div class="flex items-center gap-2">
            @php
                $now = \Carbon\Carbon::now();
                $start = \Carbon\Carbon::createFromTimeString($dokter->start_time);
                $end = \Carbon\Carbon::createFromTimeString($dokter->end_time);
                $isAvailable = $now->between($start, $end);
            @endphp
            
            @if ($isAvailable)
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest">Tersedia Hari Ini</span>
            @else
                <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tidak Tersedia</span>
            @endif
        </div>
        
        <a href="{{ route('profile.doctor.index', $dokter->id) }}" class="flex items-center gap-1.5 text-slate-400 hover:text-slate-600 transition-colors group/profile">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <span class="text-[11px] font-bold uppercase tracking-tight">Lihat Profil</span>
        </a>
    </div>

    @if ($isAvailable)
    <a href="{{ route('queue.create', ['dokter_id' => $dokter->id]) }}" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-sm flex items-center gap-2 transition-all shadow-md shadow-blue-100 group/link">
        Buat Janji 
        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
    </a>
    @endif
</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="bg-slate-900 py-20 overflow-hidden relative">
        <div class="max-w-7xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl font-bold text-white mb-8">Butuh bantuan darurat atau konsultasi cepat?</h2>
            <div class="flex justify-center gap-6">
                <button class="px-8 py-4 bg-emerald-500 text-white rounded-2xl font-bold hover:bg-emerald-600 transition-all">Hubungi Customer Service</button>
            </div>
        </div>
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute -left-20 -top-20 w-80 h-80 bg-blue-500 rounded-full blur-[120px]"></div>
        </div>
    </section>
</div>
@endsection