@extends('layout.mainLayout') {{-- Gunakan layout dengan header yang sudah kita buat --}}

@section('content')
@if (session('warning'))
        <x-partials.notif-component message="Warning" sign="{{ session('warning') }}">
            <x-partials.icon-alert />
        </x-partials.notif-component>
@endif
    <div class="min-h-screen bg-[#F8FAFC] p-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dokter Siaga Hari Ini</h1>
                    <p class="text-gray-500">Daftar tenaga medis profesional yang bertugas pada hari ini.</p>
                </div>
                <div
                    class="bg-emerald-50 text-emerald-700 px-4 py-2 rounded-2xl border border-emerald-100 flex items-center gap-2">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    <span class="font-semibold">{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>

            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-blue-900/5 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-8 py-5 text-sm font-semibold text-gray-600 uppercase tracking-wider">Nama
                                    Dokter</th>
                                <th class="px-8 py-5 text-sm font-semibold text-gray-600 uppercase tracking-wider">Spesialis
                                    / Poli</th>
                                <th class="px-8 py-5 text-sm font-semibold text-gray-600 uppercase tracking-wider">Jam
                                    Praktik</th>
                                <th
                                    class="px-8 py-5 text-sm font-semibold text-gray-600 uppercase tracking-wider text-right">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($dokters as $dokter)
                                <tr class="hover:bg-blue-50/30 transition-colors group">
                                    <td class="px-8 py-5">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold border-2 border-white shadow-sm text-sm">
                                                {{ substr($dokter->name, 0, 2) }}
                                            </div>
                                            <span
                                                class="font-bold text-gray-800 group-hover:text-blue-700 transition-colors">{{ $dokter->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-5">
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg border border-gray-200 uppercase">
                                            {{ $dokter->poli->name }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-5 text-gray-600 font-medium">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ \Carbon\Carbon::parse($dokter->start_time)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($dokter->end_time)->format('H:i') }}
                                        </div>
                                    </td>
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $start = \Carbon\Carbon::createFromTimeString($dokter->start_time);
                                        $end = \Carbon\Carbon::createFromTimeString($dokter->end_time);

                                        $isAvailable = $now->between($start, $end);
                                    @endphp
                                    @if ($isAvailable)
                                        <td class="px-8 py-5 text-right">
                                            <a href="{{ route('queue.create', ['dokter_id' => $dokter->id]) }}"
                                                class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-semibold text-sm transition-all transform active:scale-95 shadow-lg shadow-blue-200">
                                                Ambil Antrian
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </a>
                                        </td>
                                    @else
                                        <td class="px-8 py-5 text-right">
                                            <span
                                                class="inline-flex items-center gap-2 bg-gray-300 text-gray-500 px-5 py-2.5 rounded-xl font-semibold text-sm cursor-not-allowed shadow-none">
                                                Tunggu Jadwal Berikutnya
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <p class="text-gray-400 font-medium">Tidak ada dokter yang bertugas hari ini.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection