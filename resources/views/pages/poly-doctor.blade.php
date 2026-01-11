@extends("layout.mainLayout")

@section("content")
    <div class="min-h-screen bg-[#F8FAFC] py-12 px-4">
        <div class="max-w-5xl mx-auto">
            <nav class="flex items-center gap-2 text-sm font-medium text-gray-400 mb-4">
                <a href="/dashboard" class="hover:text-blue-600 transition-colors">Dashboard</a>
                <span>/</span>
                <span class="text-gray-600">Poliklinik</span>
                <span>/</span>
                <span class="text-blue-600 font-bold">{{ $poli->name }}</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6">
                <div>
                    <h1 class="text-4xl font-black text-gray-900 tracking-tight italic">{{ $poli->name }}</h1>
                    <p class="text-gray-500 mt-2 text-lg">Daftar jadwal praktek dokter spesialis {{ $poli->name }}.</p>
                </div>
                <div class="bg-white px-6 py-3 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-3">
                    <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                    <span class="text-gray-700 font-bold uppercase tracking-widest text-sm">
                        {{ \Carbon\Carbon::now()->translatedFormat('l') }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($poli->dokters as $dokter)
                    @php
                        $now = \Carbon\Carbon::now();

                        // Mapping hari Carbon ke enum DB
                        $dayMap = [
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu',
                            'Sunday' => 'Minggu',
                        ];

                        $today = $dayMap[$now->format('l')] ?? null;

                        // Jam praktik hari ini
                        $start = \Carbon\Carbon::today()->setTimeFromTimeString($dokter->start_time);
                        $end = \Carbon\Carbon::today()->setTimeFromTimeString($dokter->end_time);

                        $isAvailable =
                            $today === $dokter->schedule_day &&
                            $now->between($start, $end);
                    @endphp


                    <div
                        class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-xl shadow-blue-900/5 flex flex-col justify-between transition-all duration-300 {{ !$isAvailable ? 'opacity-75 grayscale-[0.5]' : 'hover:border-blue-200 hover:shadow-blue-900/10' }}">

                        <div>
                            <div class="flex justify-between items-start mb-6">
                                <div
                                    class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center font-bold text-xl border border-blue-100">
                                    {{ substr($dokter->name, 0, 2) }}
                                </div>
                                @if($isAvailable)
                                    <span
                                        class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black rounded-full border border-emerald-100 uppercase tracking-tighter">
                                        Tersedia Hari Ini
                                    </span>
                                @else
                                    <span
                                        class="px-4 py-1.5 bg-gray-100 text-gray-400 text-[10px] font-black rounded-full border border-gray-200 uppercase tracking-tighter">
                                        Praktek Hari {{ $dokter->schedule_day }}
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-xl font-bold text-gray-800 leading-tight">dr. {{ $dokter->name }}</h3>

                            <div class="mt-4 space-y-3">
                                <div class="flex items-center gap-3 text-gray-500">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span
                                        class="text-sm font-medium">{{ \Carbon\Carbon::parse($dokter->start_time)->format('H:i') }}
                                        - {{ \Carbon\Carbon::parse($dokter->end_time)->format('H:i') }} WIB</span>
                                </div>
                                <div class="flex items-center gap-3 text-gray-500">
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="text-sm font-medium">Setiap Hari {{ $dokter->schedule_day }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">
                            @if($isAvailable)
                                <a href="{{ route('queue.create', ['dokter_id' => $dokter->id]) }}"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2 group">
                                    <span>Daftar Antrian</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            @else
                                <button disabled
                                    class="w-full bg-gray-100 text-gray-400 font-bold py-4 rounded-2xl cursor-not-allowed flex items-center justify-center gap-2 border border-gray-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Tidak Praktek Hari Ini</span>
                                </button>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection