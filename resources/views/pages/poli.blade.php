@extends('layout.mainLayout') {{-- Gunakan layout dengan header yang sudah kita buat --}}
{{-- Nanti Buat compontent notif jangan lupa --}}
@section('content')
    @if (session("success"))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
            x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-[-20px]"
            class="fixed singentot top-15 right-[-150px] z-20 -translate-x-1/2 z-[99] w-[90%] max-w-md">

            <div
                class="bg-white border-l-4 border-green-500 rounded-2xl shadow-2xl shadow-green-200/50 p-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-sky-50 p-2 rounded-xl">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900">Pendaftaran Berhasil</h4>
                        <p class="text-xs text-gray-500 font-medium">{{ session('success') }}</p>
                    </div>
                </div>

                <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    @endif
    @auth
        @if (!Auth::user()->is_filled_biodata)
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-4"
                x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0"
                x-transition:leave-end="opacity-0 transform -translate-y-4" {{-- Perbaikan class posisi di bawah ini --}}
                class="fixed top-15 right-10 z-[99] w-[90%] max-w-md">

                <div class="bg-white border-l-4 border-green-500 rounded-2xl shadow-2xl p-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="bg-sky-50 p-2 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">Notification</h4>
                            <p class="text-xs text-gray-500 font-medium">Tolong isi form biodata di profile menu sebelum mengambil tiker antrian</p>
                        </div>
                    </div>

                    {{-- Pastikan button tidak terhalang elemen lain --}}
                    <button @click="show = false" type="button" class="cursor-pointer text-gray-400 hover:text-gray-600 p-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        @endif
    @endauth
    <div class="max-w-7xl mx-auto px-6 py-10">

        <div class="mb-12">
            <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Layanan <span
                    class="text-[#064e3b]">Poliklinik</span></h1>
            <p class="text-gray-500 mt-2 text-lg">Pilih spesialisasi medis yang Anda butuhkan untuk membuat janji temu.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div
                class="bg-gradient-to-br from-[#064e3b] to-[#0a6d53] p-6 rounded-3xl text-white shadow-xl shadow-emerald-100">
                <p class="opacity-80 text-sm font-medium">Total Poliklinik</p>
                <a href="#" class="text-3xl font-bold mt-1 flex items-center justify-between group">
                    <span>{{ $totalPoli }} Unit</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 opacity-0 group-hover:opacity-100 group-hover:text-white-600  group-hover:translate-x-1 transition-all"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <p class="text-gray-400 text-sm font-medium">Dokter Siaga Hari Ini</p>
                <a href="{{ route("dokter-siaga.index") }}"
                    class="text-3xl font-bold text-gray-800 mt-1 flex items-center justify-between group">
                    <span>{{ $dokterHariIni }} Ahli</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-gray-300 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <p class="text-gray-400 text-sm font-medium">Antrian Anda</p>
                <a href="{{ route("queue.index") }}"
                    class="text-3xl font-bold text-gray-800 mt-1 flex items-center justify-between group">
                    <span>{{ $antrianAktif }} Aktif</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6 text-gray-300 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Loop ini nantinya akan mengambil data dari $polikliniks --}}
            @foreach($polis as $poli)
                <div
                    class="group bg-white rounded-[2rem] border border-gray-100 p-8 hover:shadow-2xl hover:shadow-emerald-900/5 transition-all duration-300 transform hover:-translate-y-2 relative overflow-hidden">
                    <div
                        class="w-14 h-14 bg-emerald-50 text-[#064e3b] rounded-2xl flex items-center justify-center mb-6 group-hover:bg-[#064e3b] group-hover:text-white transition-colors duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $poli->name }}</h3>
                    <p class="text-sm text-gray-400 leading-relaxed mb-6">Tersedia dokter spesialis terbaik untuk menangani
                        keluhan Anda secara profesional.</p>

                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-xs font-bold text-blue-600 uppercase tracking-wider">Tersedia</span>
                        <a href="{{ route('doctor.poli.index', ['id' => $poli->id]) }}"
                            class="w-10 h-10 bg-gray-50 rounded-full flex items-center justify-center text-gray-400 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div
            class="mt-20 bg-blue-50/50 rounded-[3rem] p-12 flex flex-col md:flex-row items-center justify-between border border-blue-100">
            <div class="md:w-1/2 mb-8 md:mb-0">
                <h2 class="text-2xl font-bold text-blue-900 mb-4">Sistem Antrian Terintegrasi</h2>
                <p class="text-blue-800/70 leading-relaxed">Daftar dari rumah, pantau nomor antrian secara real-time, dan
                    datang tepat waktu. Efisiensi waktu Anda adalah prioritas kami.</p>
            </div>
            <div class="flex space-x-4">
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-blue-600 mb-2 font-bold italic">
                        1</div>
                    <span class="text-xs font-bold text-blue-900">Pilih Poli</span>
                </div>
                <div class="w-8 h-[2px] bg-blue-200 mt-6"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-blue-600 mb-2 font-bold italic">
                        2</div>
                    <span class="text-xs font-bold text-blue-900">Pilih Dokter</span>
                </div>
                <div class="w-8 h-[2px] bg-blue-200 mt-6"></div>
                <div class="flex flex-col items-center">
                    <div
                        class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm text-blue-600 mb-2 font-bold italic">
                        3</div>
                    <span class="text-xs font-bold text-blue-900">Dapat Nomor</span>
                </div>
            </div>
        </div>
    </div>
@endsection