@extends("layout.mainLayout")

@section("content")
    <div class="min-h-screen bg-white">
        <section class="relative bg-gradient-to-tr from-[#F0F7FF] to-white pt-20 pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center relative z-10">
                <div>
                    <span
                        class="inline-block px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-bold mb-6 italic tracking-wide">
                        Modern Healthcare Solution
                    </span>
                    <h1 class="text-6xl font-black text-slate-900 leading-[1.1] mb-6">
                        Solusi Kesehatan <br>
                        <span class="text-blue-600 underline decoration-blue-100 decoration-8 underline-offset-4">Tanpa
                            Antre.</span>
                    </h1>
                    <p class="text-lg text-slate-500 mb-10 max-w-md leading-relaxed">
                        Cek jadwal dokter spesialis secara real-time dan pesan antrean Anda dengan lebih efisien melalui
                        portal layanan kesehatan kami.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route("dokter-siaga.index") }}"
                            class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold shadow-xl shadow-blue-200 hover:bg-blue-700 transition-all">
                            Cek Jadwal Dokter
                        </a>
                        @auth
                            <a href="{{ route("poli.index") }}"
                                class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                                Masuk Ke Polnik
                            </a>
                        @endauth
                        @guest
                            <a href="{{ route("auth.login.index") }}"
                                class="px-8 py-4 bg-white text-slate-700 border border-slate-200 rounded-2xl font-bold hover:bg-slate-50 transition-all">
                                Masuk Ke Akun
                            </a>
                        @endguest
                    </div>
                </div>

                <div class="relative hidden lg:block">
                    <div class="absolute -top-10 -right-10 w-64 h-64 bg-emerald-100/50 rounded-full blur-3xl"></div>
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200 border border-slate-50">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center text-white shadow-lg shadow-emerald-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-slate-400 text-sm">Layanan Aktif</p>
                                <p class="text-xl font-bold text-slate-800">Sistem Antrean Real-time</p>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div class="h-4 bg-slate-50 rounded-full w-full overflow-hidden">
                                <div class="bg-blue-600 h-full w-[75%]"></div>
                            </div>
                            <p class="text-sm text-slate-500 font-medium italic">"Membantu lebih dari 1.000+ pasien setiap
                                harinya."</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-6 -mt-16 relative z-20">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($polis as $poli)
                    <div
                        class="bg-white/90 backdrop-blur-lg p-8 rounded-[2rem] shadow-xl shadow-slate-100 border border-slate-50 group hover:-translate-y-2 transition-all duration-300">
                        <div
                            class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl mb-6 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.628.281a2 2 0 01-1.106.114l-3.146-.449a2 2 0 01-1.726-2.131l.154-2.154a4 4 0 01.798-2.096l2.335-3.335a1 1 0 01.8-.4h4.285a1 1 0 01.8.4l2.335 3.335a4 4 0 01.798 2.096l.154 2.154a2 2 0 01-1.726 2.131l-3.146.449a2 2 0 01-1.106-.114l-.628-.281a6 6 0 00-3.86-.517l-2.387.477a2 2 0 00-1.022.547V18a2 2 0 002 2h11a2 2 0 002-2v-2.572z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-slate-800">{{ $poli->name }}</h4>
                        <p class="text-slate-400 text-sm mt-2">Lihat jadwal dokter spesialis {{ strtolower($poli->name) }} di
                            sini.</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section id="jadwal" class="max-w-7xl mx-auto px-6 py-24">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-slate-900 mb-4">Jadwal Praktik Hari Ini</h2>
                <p class="text-slate-500">Pilih dokter pilihan Anda untuk melakukan pendaftaran.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($dokters as $dokter)
                    <div
                        class="bg-white border border-slate-100 rounded-3xl p-6 hover:shadow-2xl hover:shadow-blue-100 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase tracking-widest rounded-full">
                                    Tersedia: {{ $dokter->schedule_day }}
                                </div>
                                <span class="text-slate-300 text-sm">#{{ $dokter->id }}</span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-1">{{ $dokter->name }}</h3>
                            <p class="text-blue-600 font-medium text-sm mb-4">{{ $dokter->poli->name }}</p>

                            <div class="flex items-center gap-2 text-slate-500 text-sm mb-6">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Sesi: {{ date('H:i', strtotime($dokter->start_time)) }} -
                                    {{ date('H:i', strtotime($dokter->end_time)) }} WIB</span>
                            </div>
                        </div>

                        <a href="/login"
                            class="w-full py-4 text-center bg-slate-50 text-slate-700 font-bold rounded-2xl hover:bg-blue-600 hover:text-white transition-all group">
                            Daftar Antrean
                            <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection