@extends("layout.mainLayout")

@section("content")
    <div class="min-h-screen bg-[#F8FAFC] py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <a href="{{ route("poli.index") }}"
                        class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 mb-6 transition-colors">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Daftar Poli
                    </a>

                    <h1 class="text-2xl font-bold text-gray-900">Antrian Aktif Anda</h1>
                    <p class="text-gray-500 mt-1">Pantau status kunjungan Anda secara real-time.</p>
                </div>
                <div
                    class="h-12 w-12 bg-white rounded-2xl border border-gray-100 shadow-sm flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4v-3a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-6">
                @forelse($antrians as $antrian)
                    <div
                        class="bg-white rounded-[   ] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden flex flex-col md:flex-row">

                        <div
                            class="bg-gradient-to-br from-blue-600 to-blue-800 p-8 md:w-48 flex flex-col items-center justify-center text-white relative">
                            <p class="text-blue-200 text-xs font-bold uppercase tracking-widest">Nomor</p>
                            <span
                                class="text-5xl font-black mt-2">{{ str_pad($antrian->nomor_antrian, 3, '0', STR_PAD_LEFT) }}</span>

                            <div class="hidden md:block absolute -right-3 top-0 bottom-0 w-6 flex flex-col justify-around py-4">
                                @for($i = 0; $i < 8; $i++)
                                    <div class="w-6 h-6 bg-[#F8FAFC] rounded-full -mr-3"></div>
                                @endfor
                            </div>
                        </div>

                        <div class="p-8 flex-1 flex flex-col justify-between">
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span
                                            class="px-3 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-bold rounded-lg uppercase border border-emerald-100">
                                            {{ $antrian->dokter->poli->name }}
                                        </span>
                                        @if($antrian->status == 'CALLED')
                                            <span
                                                class="animate-pulse px-3 py-1 bg-blue-100 text-blue-600 text-[10px] font-bold rounded-lg uppercase">
                                                Sedang Dipanggil
                                            </span>
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-800 uppercase leading-tight">dr.
                                        {{ $antrian->dokter->name }}</h3>
                                    <p class="text-gray-400 text-sm mt-1 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ \Carbon\Carbon::parse($antrian->tanggal_kunjungan)->translatedFormat('d F Y') }}
                                    </p>
                                    @if($antrian->status == "WAITING")
                                        <span
                                            class="px-3 py-1 bg-emerald-50 block mt-2 w-fit text-emerald-600 text-[10px] font-bold rounded-lg uppercase border border-emerald-100">
                                            Waiting
                                        </span>
                                    @elseif($antrian->status == "CALLED")
                                        <span
                                            class="px-3 py-1 bg-blue-50 block mt-2 w-fit text-blue-600 text-[10px] font-bold rounded-lg uppercase border border-blue-100">
                                            Called
                                        </span>
                                    @elseif($antrian->status == "DONE")
                                        <span
                                            class="px-3 py-1 bg-slate-100 block mt-2 w-fit text-slate-500 text-[10px] font-bold rounded-lg uppercase border border-slate-200">
                                            Done
                                        </span>
                                        @eleif($antrian->status == "CANCELED")
                                        <span
                                            class="px-3 py-1 bg-rose-50 block mt-2 w-fit text-rose-600 text-[10px] font-bold rounded-lg uppercase border border-rose-100">
                                            Canceled
                                        </span>
                                    @endif
                                </div>

                                <div class="text-left md:text-right">
                                    <p class="text-xs text-gray-400 font-medium">Jam Praktik</p>
                                    <p class="text-sm font-bold text-gray-700">
                                        {{ \Carbon\Carbon::parse($antrian->dokter->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($antrian->dokter->end_time)->format('H:i') }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-50">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-tighter mb-2">Keluhan Anda:</p>
                                <p class="text-gray-600 text-sm italic line-clamp-2">"{{ $antrian->keluhan }}"</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[2.5rem] p-16 border border-dashed border-gray-200 text-center">
                        <div class="bg-gray-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Tidak Ada Antrian Aktif</h3>
                        <p class="text-gray-400 max-w-xs mx-auto mt-2">Anda belum mendaftar antrian hari ini. Silakan pilih
                            dokter untuk memulai.</p>
                        <a href="{{ route('dokter-siaga.index') }}"
                            class="inline-block mt-6 text-blue-600 font-bold hover:underline">Lihat Dokter Siaga →</a>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 p-6 bg-blue-50/50 rounded-2xl border border-blue-100 flex items-start gap-4">
                <svg class="w-6 h-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm text-blue-700 leading-relaxed">
                    Mohon datang **15 menit sebelum** jam praktik dimulai. Tunjukkan halaman ini kepada petugas administrasi
                    saat nomor Anda dipanggil.
                </p>
            </div>
        </div>
    </div>
@endsection