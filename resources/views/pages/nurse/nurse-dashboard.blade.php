@extends('layout.nurse-layout')

@section('content')
    @if (session('success'))
        <x-partials.notif-component message="Success" sign="{{ session('success') }}">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
    <div class="p-6 space-y-6" x-data="{ activeTab: 'assignments', openModal: false, selectedPatient: {} }">

        <div
            class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white p-6 rounded-xl border border-slate-100 shadow-sm">
            <div>
                <h1 class="text-2xl font-semibold text-slate-800">Selamat Tugas, Ns. {{ $nurse->full_name }}</h1>
                <p class="text-slate-500 text-sm">NIP: {{ $nurse->nip }} | {{ $nurse->position }} •
                    {{ $nurse->poli->name ?? 'Poli Belum Ditentukan' }}</p>
            </div>
            <div class="flex items-center gap-3">
                <span
                    class="px-3 py-1 rounded-full text-xs font-medium {{ $nurse->status == 'aktif' ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-red-50 text-red-600 border border-red-200' }}">
                    Status: {{ ucfirst($nurse->status) }}
                </span>
                <div class="text-right border-l pl-4 border-slate-200">
                    <p class="text-xs text-slate-400 uppercase tracking-wider">Shift Hari Ini</p>
                    <p class="font-bold text-slate-700 uppercase">{{ $nurse->shift }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Pasien Anda</p>
                    <p class="text-xl font-bold text-slate-800">{{ $nurse->assignments_count ?? 0 }} <span
                            class="text-xs font-normal text-slate-400 ml-1 text-nowrap">Orang</span></p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Masa Berlaku STR</p>
                    <p class="text-xl font-bold text-slate-800">
                        {{ \Carbon\Carbon::parse($nurse->license_expired_at)->format('d M Y') }}</p>
                </div>
            </div>

            <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center gap-4">
                <div class="p-3 bg-amber-50 text-amber-600 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Jadwal Esok</p>
                    <p class="text-xl font-bold text-slate-800">{{ $tomorrow_schedule->shift ?? 'Tidak Ada Shift' }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="flex items-center justify-between p-5 border-b border-slate-50">
                    <h3 class="font-semibold text-slate-700 text-lg text-nowrap">Daftar Penugasan Pasien</h3>
                    <div class="flex bg-slate-100 p-1 rounded-lg text-xs">
                        <button @click="activeTab = 'assignments'"
                            :class="activeTab === 'assignments' ? 'bg-white shadow-sm text-emerald-600' : 'text-slate-500'"
                            class="px-3 py-1.5 rounded-md transition-all">Hari Ini</button>
                        <button @click="activeTab = 'history'"
                            :class="activeTab === 'history' ? 'bg-white shadow-sm text-emerald-600' : 'text-slate-500'"
                            class="px-3 py-1.5 rounded-md transition-all ml-1 text-nowrap">Riwayat</button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead class="bg-slate-50/50 text-slate-400 uppercase text-[10px] tracking-widest font-bold">
                            <tr>
                                <th class="px-6 py-4">Pasien</th>
                                <th class="px-6 py-4">Waktu Penugasan</th>
                                <th class="px-6 py-4">Catatan Medis</th>
                                <th class="px-6 py-4 text-right text-nowrap">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($nurse_assignments as $assignment)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-slate-700 text-nowrap">
                                            {{ $assignment->patient->full_name }}</div>
                                        <div class="text-[11px] text-slate-400">ID: #{{ $assignment->patient_id }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-500">
                                        {{ \Carbon\Carbon::parse($assignment->assigned_at)->format('H:i') }} WIB
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="line-clamp-1 text-slate-500 max-w-[200px]">{{ $assignment->note ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                                        <button 
                    @click="openModal = true; selectedPatient = { 
                        name: '{{ $assignment->patient->full_name }}', 
                        id: '{{ $assignment->patient_id }}',
                        time: '{{ \Carbon\Carbon::parse($assignment->assigned_at)->format('H:i') }}',
                        note: '{{ $assignment->note }}'
                    }"
                    class="text-emerald-600 hover:text-emerald-700 font-medium text-xs border border-emerald-100 px-3 py-1 rounded-md hover:bg-emerald-50 transition-all text-nowrap">
                    Lihat Detail
                            </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">Tidak ada penugasan
                                        untuk hari ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-xl border border-slate-100 shadow-sm">
                    <h3 class="font-semibold text-slate-700 mb-4 border-b pb-2 text-nowrap">Informasi Profesional</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pendidikan</label>
                            <p class="text-sm text-slate-700 font-medium">{{ $nurse->education_level }}</p>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest text-nowrap">Nomor
                                STR (License)</label>
                            <p class="text-sm font-mono text-slate-600 tracking-tighter">{{ $nurse->license_number }}</p>
                        </div>
                        <div>
                            <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kontak</label>
                            <p class="text-sm text-slate-700">{{ $nurse->phone }}</p>
                        </div>
                    </div>
                </div>

               <div class="bg-slate-800 p-6 rounded-xl shadow-lg text-white">
    <h3 class="font-semibold mb-4 flex items-center gap-2 text-white">
        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
        Jadwal Mendatang
    </h3>
    <div class="space-y-4">
        @forelse($upcoming_schedules as $schedule)
        <div 
            class="flex items-center justify-between border-b border-slate-700 pb-3 last:border-0 last:pb-0"
            x-data="{ 
                status: '{{ $schedule->status ?? 'pending' }}', 
                loading: false,
                scheduleId: {{ $schedule->id }}
            }"
        >
            <div>
                <p class="text-xs text-slate-400">
                    {{ \Carbon\Carbon::parse($schedule->date)->translatedFormat('D, d M') }}
                </p>
                <p class="text-sm font-medium uppercase tracking-wide text-white">
                    {{ $schedule->shift }}
                </p>
            </div>

            <div 
    class="flex items-center justify-between border-b border-slate-700 pb-3 last:border-0 last:pb-0"
    x-data="{ 
        status: '{{ strtoupper($schedule->status ?? 'PENDING') }}', 
        loading: false 
    }"
>
    <div class="flex items-center">
        <div x-show="status === 'PENDING'" class="flex gap-1.5">
            
            <form x-ref="formConfirm" action="{{ route('nurse.schedule.updateStatus') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="id" value="{{ $schedule->id }}">
                <input type="hidden" name="status" value="CONFIRMED">
            </form>

            <form x-ref="formReject" action="{{ route('nurse.schedule.updateStatus') }}" method="POST" class="hidden">
                @csrf
                <input type="hidden" name="id" value="{{ $schedule->id }}">
                <input type="hidden" name="status" value="REJECTED"> </form>

            <button 
                @click="loading = true; $refs.formConfirm.submit()" 
                :disabled="loading"
                class="bg-emerald-600 hover:bg-emerald-700 text-white text-[9px] px-2 py-1 rounded font-bold uppercase tracking-tighter transition-all disabled:opacity-50"
            >
                <span x-text="loading ? '...' : 'Confirm'"></span>
            </button>

            <button 
                @click="loading = true; $refs.formReject.submit()" 
                :disabled="loading"
                class="bg-slate-700 hover:bg-rose-600 text-slate-300 hover:text-white text-[9px] px-2 py-1 rounded font-bold uppercase tracking-tighter transition-all disabled:opacity-50"
            >
                <span x-text="loading ? '...' : 'Reject'"></span>
            </button>
        </div>

        <div x-show="status === 'CONFIRMED'" class="flex items-center gap-1 text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded border border-emerald-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
            <span class="text-[9px] font-bold uppercase tracking-wider">Confirmed</span>
        </div>

        <div x-show="status === 'CANCELED'" class="flex items-center gap-1 text-rose-400 bg-rose-500/10 px-2 py-1 rounded border border-rose-500/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
            </svg>
            <span class="text-[9px] font-bold uppercase tracking-wider">Canceled</span>
        </div>
    </div>
</div>
        </div>
        @empty
        <p class="text-xs text-slate-500 italic">Belum ada jadwal untuk minggu ini.</p>
        @endforelse
    </div>
</div>
            </div>
            <div 
    x-show="openModal" 
    class="fixed inset-0 z-50 flex items-start justify-center pt-10 sm:pt-24 px-4 overflow-hidden" 
    style="display: none;"
>
    <div 
        x-show="openModal" 
        x-transition:enter="ease-out duration-300" 
        x-transition:enter-start="opacity-0" 
        x-transition:enter-end="opacity-100" 
        x-transition:leave="ease-in duration-200" 
        x-transition:leave-start="opacity-100" 
        x-transition:leave-end="opacity-0" 
        @click="openModal = false"
        class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm">
    </div>

    <div 
        x-show="openModal" 
        x-transition:enter="transition ease-out duration-300" 
        x-transition:enter-start="opacity-0 -translate-y-8 scale-95" 
        x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
        x-transition:leave="transition ease-in duration-200" 
        x-transition:leave-start="opacity-100 translate-y-0 scale-100" 
        x-transition:leave-end="opacity-0 -translate-y-8 scale-95" 
        class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl border border-slate-100 overflow-hidden"
    >
        <div class="px-6 py-4 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
            <h3 class="text-lg font-bold text-slate-800 uppercase tracking-tight">Detail Penugasan Pasien</h3>
            <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6 space-y-5">
            <div class="flex items-center gap-4">
                <div class="h-12 w-12 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-xl">
                    <span x-text="selectedPatient.name ? selectedPatient.name.charAt(0) : ''"></span>
                </div>
                <div>
                    <h4 class="text-lg font-semibold text-slate-800" x-text="selectedPatient.name"></h4>
                    <p class="text-sm text-slate-500 italic">ID Pasien: <span x-text="selectedPatient.id"></span></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 pt-2">
                <div class="bg-slate-50 p-3 rounded-lg">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Waktu Tugas</p>
                    <p class="text-sm font-medium text-slate-700" x-text="selectedPatient.time + ' WIB'"></p>
                </div>
                <div class="bg-slate-50 p-3 rounded-lg">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Poli</p>
                    <p class="text-sm font-medium text-slate-700">{{ $nurse->poli->name ?? '-' }}</p>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Catatan Perawat</p>
                <div class="bg-emerald-50/50 border border-emerald-100 p-4 rounded-xl text-slate-700 text-sm leading-relaxed">
                    <p x-text="selectedPatient.note || 'Tidak ada catatan tambahan untuk pasien ini.'"></p>
                </div>
            </div>
        </div>

        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-50 flex justify-end gap-3">
            <button @click="openModal = false" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800 transition-colors">
                Tutup
            </button>
            <button class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-md shadow-emerald-200 transition-all">
                Update Catatan
            </button>
        </div>
    </div>
</div>
        </div>
    </div>


@endsection