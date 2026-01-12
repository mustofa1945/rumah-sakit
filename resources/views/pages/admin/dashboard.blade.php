@extends('layout.admin')

@section('content')
    <div class="max-w-7xl mx-auto space-y-8 animate-fade-in">

        <div class="relative overflow-hidden bg-white border border-slate-200/60 p-8 rounded-[2rem] shadow-sm">
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-50 rounded-full -mr-20 -mt-20 blur-3xl opacity-50">
            </div>
            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div
                            class="w-20 h-20 bg-gradient-to-br from-[#064E3B] to-emerald-700 rounded-3xl flex items-center justify-center text-white shadow-2xl shadow-emerald-200 transition-transform hover:scale-105 duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-500 border-4 border-white rounded-full">
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                            {{ Auth::user()->dokter->name }}
                        </h1>
                        <div class="flex items-center gap-3 mt-1">
                            <span
                                class="flex items-center text-xs font-bold text-blue-700 bg-blue-50 px-3 py-1 rounded-full border border-blue-100 uppercase tracking-tighter">
                                {{ Auth::user()->dokter->poli->name }}
                            </span>
                            <span class="text-slate-400 text-sm font-medium">
                                {{ Auth::user()->dokter->schedule_day }} •
                                {{ \Carbon\Carbon::parse(Auth::user()->dokter->start_time)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse(Auth::user()->dokter->end_time)->format('H:i') }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-end">
                    <div class="text-right hidden md:block">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Status Klinik</p>
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
                            $start = \Carbon\Carbon::today()->setTimeFromTimeString(Auth::user()->dokter->start_time);
                            $end = \Carbon\Carbon::today()->setTimeFromTimeString(Auth::user()->dokter->end_time);

                            $isAvailable =
                                $today === Auth::user()->dokter->schedule_day &&
                                $now->between($start, $end);
                        @endphp
                        @if ($isAvailable)
                            <p class="text-sm font-bold text-emerald-600">Praktek Aktif</p>

                        @else
                            <p class="text-sm font-bold text-red-600">Praktek Tidak Aktif</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div
                class="group bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div class="p-3 bg-amber-50 rounded-2xl group-hover:bg-amber-100 transition-colors">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Queueing</span>
                </div>
                <div class="mt-6 flex items-baseline gap-2">
                    <h3 class="text-5xl font-black text-slate-800">{{ $antrians->where('status', 'WAITING')->count() }}</h3>
                    <span class="text-slate-400 font-bold text-sm uppercase">Pasien</span>
                </div>
                <p class="text-xs text-slate-400 mt-2 font-medium">Menunggu di ruang tunggu</p>
            </div>

            <div class="group bg-[#064E3B] p-8 rounded-[2rem] shadow-2xl shadow-emerald-900/20 relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-white/5 rounded-full"></div>
                <div class="relative z-10">
                    <div class="flex justify-between items-start">
                        <div class="p-3 bg-white/10 rounded-2xl text-emerald-100">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-[10px] font-black text-emerald-200/50 uppercase tracking-[0.2em]">Completed</span>
                    </div>
                    <div class="mt-6 flex items-baseline gap-2">
                        <h3 class="text-5xl font-black text-white">{{ $antrians->where('status', 'DONE')->count() }}</h3>
                        <span class="text-emerald-200 font-bold text-sm uppercase">Selesai</span>
                    </div>
                    <p class="text-xs text-emerald-100/60 mt-2 font-medium">Total penanganan hari ini</p>
                </div>
            </div>

            <div class="group bg-[#1E3A8A] p-8 rounded-[2rem] shadow-2xl shadow-blue-900/20 relative overflow-hidden">
                <div class="relative z-10 text-white">
                    <div class="flex justify-between items-start">
                        <div class="p-3 bg-white/10 rounded-2xl">
                            <svg class="w-6 h-6 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-[10px] font-black text-blue-200/50 uppercase tracking-[0.2em]">Overall</span>
                    </div>
                    <div class="mt-6 flex items-baseline gap-2">
                        <h3 class="text-5xl font-black">{{ $antrians->count() }}</h3>
                        <span class="text-blue-100 font-bold text-sm uppercase">Total</span>
                    </div>
                    <p class="text-xs text-blue-100/60 mt-2 font-medium">Akumulasi antrian terdaftar</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-8 bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div
                    class="px-8 py-6 border-b border-slate-50 flex justify-between items-center bg-white/50 backdrop-blur-md sticky top-0 z-20">
                    <h3 class="font-bold text-slate-800 tracking-tight italic">Antrian Selanjutnya</h3>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Live Updates</span>
                    </div>
                </div>
                <div class="overflow-x-auto px-4 pb-4">
                    <div x-data="{ openModal: false, actionUrl: '', patientName: '', isExiting: false }">

                        <table class="w-full">
                            <thead>
                                <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em]">
                                    <th class="px-6 py-5 font-black text-left">No</th>
                                    <th class="px-6 py-5 font-black text-left">Biodata Pasien</th>
                                    <th class="px-6 py-5 font-black text-left">Status</th>
                                    <th class="px-6 py-5 font-black text-center">Cancel</th>
                                    <th class="px-6 py-5 font-black text-right italic text-blue-600">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($antrians as $item)
                                    <tr class="group hover:bg-slate-50/80 transition-all duration-300">
                                        <td class="px-6 py-6">
                                            <div
                                                class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center font-mono font-black text-slate-600 border border-slate-100 group-hover:border-blue-200 transition-colors">
                                                {{ str_pad($item->nomor_antrian, 2, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-6">
                                            <p class="font-bold text-slate-800 text-base leading-none">{{ $item->user->name }}
                                            </p>
                                            <p class="text-xs text-slate-400 mt-2 italic font-medium max-w-xs truncate">
                                                {{ $item->keluhan ?? 'Tidak ada keluhan tertulis' }}
                                            </p>
                                        </td>
                                        <td class="px-6 py-6">
                                            @php
                                                $statusStyle = [
                                                    'WAITING' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                    'CALLED' => 'bg-blue-50 text-blue-700 border-blue-200 shadow-sm shadow-blue-100',
                                                    'DONE' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                                    'CANCELED' => 'bg-rose-50 text-rose-600 border-rose-100'
                                                ];
                                            @endphp
                                            <span
                                                class="px-4 py-1.5 rounded-full text-[10px] font-black border uppercase tracking-wider {{ $statusStyle[$item->status] ?? 'bg-slate-50 text-slate-400' }}">
                                                {{ $item->status }}
                                            </span>
                                        </td>

                                        {{-- Kolom Cancel dengan Trigger Modal --}}
                                        <td class="px-6 py-6 text-center">
                                            @if($item->status == 'WAITING' || $item->status == 'CALLED')
                                                <button
                                                    @click="actionUrl = '{{ route('queue.nextStatus', $item->id) }}'; patientName = '{{ $item->user->name }}'; openModal = true; isExiting = false"
                                                    class="text-rose-500 hover:text-rose-700 font-bold text-xs uppercase tracking-tight transition-colors">
                                                    [ Cancel ]
                                                </button>
                                            @else
                                                <span class="text-slate-300 text-[10px] italic">-</span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-6 text-right">
                                            {{-- Button Panggil/Selesai tetap seperti kode sebelumnya --}}
                                            @if($item->status == 'WAITING')
                                            @if($isHasCalledStatus)
                                            <button type="button" 
                                                    class="bg-gray-400 text-gray-100 px-5 py-2 rounded-xl text-xs font-bold cursor-not-allowed shadow-none" 
                                                    disabled>
                                                    Call
                                                </button>
                                            @else
                                                <form action="{{ route('queue.nextStatus', $item->id) }}" method="POST">
                                                    @csrf @method('PATCH')
                                                    <input type="hidden" name="status" value="CALLED">

                                                    <button
                                                        class="bg-blue-600 hover:bg-blue-800 text-white px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-lg shadow-blue-200">Call</button>
                                                </form>
                                            @endif
                                            @elseif($item->status == 'CALLED')
                                                <a href="{{ route('admin.patient-histories.create', [$item->user_id]) }}"
                                                    class="bg-[#064E3B] hover:bg-emerald-900 text-white px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-lg shadow-emerald-200">Rekap</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <template x-teleport="body">
                            <div x-show="openModal"
                                class="fixed inset-0 z-50 flex items-center justify-center p-4 overflow-x-hidden overflow-y-auto"
                                x-cloak>

                                <div x-show="openModal" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-tart="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    @click="isExiting = true; setTimeout(() => { openModal = false }, 300)"
                                    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm"></div>

                                <div x-show="openModal" :class="isExiting ? 'fade-top-out' : ''"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 -translate-y-12"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    class="relative bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 text-center border border-slate-100">

                                    <div
                                        class="w-16 h-16 bg-rose-50 text-rose-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </div>

                                    <h3 class="text-xl font-black text-slate-800 mb-2">Batalkan Antrian?</h3>
                                    <p class="text-slate-500 text-sm mb-8">
                                        Anda akan membatalkan antrian untuk <span class="font-bold text-slate-700"
                                            x-text="patientName"></span>. Tindakan ini tidak dapat dibatalkan.
                                    </p>

                                    <div class="flex gap-3">
                                        <button @click="isExiting = true; setTimeout(() => { openModal = false }, 300)"
                                            class="flex-1 px-6 py-3 rounded-xl bg-slate-100 text-slate-600 font-bold text-xs hover:bg-slate-200 transition-colors">
                                            TIDAK
                                        </button>

                                        <form :action="actionUrl" method="POST" class="flex-1">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="CANCELED">
                                            <button type="submit"
                                                class="w-full px-6 py-3 rounded-xl bg-rose-500 text-white font-bold text-xs hover:bg-rose-600 shadow-lg shadow-rose-200 transition-all transform active:scale-95">
                                                YA, BATALKAN
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                @php $current = $antrians->where('status', 'CALLED')->first(); @endphp
                <div
                    class="bg-white p-10 rounded-[2.5rem] border-2 {{ $current ? 'border-blue-500 shadow-2xl shadow-blue-100' : 'border-slate-100' }} relative overflow-hidden transition-all duration-500">
                    <div class="relative z-10 text-center">
                        <p class="text-blue-600 font-black text-[10px] uppercase tracking-[0.3em] mb-6">Pemeriksaan Aktif
                        </p>

                        @if($current)
                            <div
                                class="w-24 h-24 bg-blue-50 rounded-[2rem] mx-auto flex items-center justify-center mb-6 shadow-inner">
                                <span class="text-4xl font-black text-blue-600 italic">#{{ $current->nomor_antrian }}</span>
                            </div>

                            <h2 class="text-2xl font-black text-slate-800 tracking-tight">{{ $current->user->name }}</h2>

                            <a href="{{ route('patients.histories.index', ['patient' => $current->user_id]) }}"
                                class="group mt-6 p-5 bg-white hover:bg-slate-50 border border-slate-100 hover:border-blue-200 rounded-2xl block transition-all duration-300 shadow-sm hover:shadow-md relative overflow-hidden">

                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">Keluhan
                                        Pasien</span>
                                    <span
                                        class="text-[10px] text-blue-500 font-bold opacity-0 group-hover:opacity-100 transition-opacity flex items-center gap-1">
                                        Lihat Rekam Medis
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </span>
                                </div>

                                <p class="text-xs text-slate-600 leading-relaxed italic pr-4">
                                    "{{ $current->keluhan }}"
                                </p>

                                <div
                                    class="absolute bottom-0 right-0 w-16 h-16 bg-blue-500/5 rounded-full blur-2xl translate-x-8 translate-y-8 group-hover:translate-x-4 group-hover:translate-y-4 transition-transform duration-500">
                                </div>
                            </a>
                        @else
                            <div class="py-10">
                                <div class="w-16 h-16 bg-slate-50 rounded-full mx-auto flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                        </path>
                                    </svg>
                                </div>
                                <p class="text-slate-400 font-bold text-sm tracking-tight uppercase">Belum ada pasien</p>
                            </div>
                        @endif
                    </div>
                    <div class="absolute -right-10 -bottom-10 w-32 h-32 bg-blue-50 rounded-full opacity-30"></div>
                </div>
                @if ($isHasCalledStatus)
                    <div
                        class="w-full bg-gradient-to-r from-gray-400 to-gray-500 p-1 rounded-[2rem] shadow-none cursor-not-allowed">
                        <div class="bg-gray-800/10 rounded-[1.9rem] p-6 flex items-center justify-between">
                            <div class="text-left text-white/60 px-2">
                                <p class="text-gray-300 text-[9px] font-black uppercase tracking-[0.25em] mb-1">Queue Control
                                </p>
                                <h4 class="font-extrabold text-xl tracking-tight text-gray-200">Panggil Berikutnya</h4>
                            </div>
                            <div
                                class="w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-gray-300 backdrop-blur-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 opacity-50" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @else
                    <form action="{{ route('admin.dashboad.antrian.call-next') }}" method="POST"
                        class="w-full group bg-gradient-to-r from-[#064E3B] to-emerald-700 hover:to-emerald-800 p-1 rounded-[2rem] transition-all duration-300 shadow-xl shadow-emerald-200 transform hover:-translate-y-1">
                        @csrf
                        <div class="bg-[#064E3B]/10 rounded-[1.9rem] p-6 flex items-center justify-between">
                            <div class="text-left text-white px-2">
                                <p class="text-emerald-300 text-[9px] font-black uppercase tracking-[0.25em] mb-1">Queue Control
                                </p>
                                <h4 class="font-extrabold text-xl tracking-tight">Panggil Berikutnya</h4>
                            </div>
                            <button type="submit"
                                class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-white backdrop-blur-lg group-hover:scale-110 transition-transform">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }

        .fade-top-out {
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.3s ease-in;
        }
    </style>
@endsection