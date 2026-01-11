<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Medis - Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @stack('styles')
</head>

<body class="">
    <x-ui.header-component />
    <div class="flex h-screen ">
        <div class="flex-1 flex flex-col">
            <div class="min-h-screen bg-[#f8fafc]  px-4 sm:px-6 lg:px-8">
                <div class="relative max-w-7xl mx-auto flex flex-col md:flex-row gap-8">
                    <div class="w-[20rem]">

                    </div>
                    <aside class="w-full fixed left-0 top-[7.5rem] md:w-80 space-y-4 ">
                        <div
                            class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100 flex items-center gap-4">
                            <div
                                class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[#064e3b] to-blue-600 p-0.5 shadow-lg shadow-emerald-100">
                                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=064e3b&color=fff"
                                    class="w-full h-full rounded-2xl object-cover" alt="">
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 truncate w-40">{{ Auth::user()->name }}</h3>
                                <p class="text-xs font-medium text-emerald-600 uppercase tracking-widest">Pasien</p>
                            </div>
                        </div>

                        <nav class="bg-white  rounded-[2rem] p-4 shadow-sm border border-gray-100 flex flex-col gap-1">
                            <a href="{{ route('profile.index') }}"
                                class="flex items-center biodata-asli  gap-3 px-4 py-3 rounded-2xl font-bold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Biodata Profil
                            </a>
                            <a href="{{ route("profile.medical.histories") }}"
                                class="flex items-center riwayat  gap-3 px-4 py-3  rounded-2xl font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Riwayat Medis
                            </a>
                            <a href="{{ route("queue.index") }}"
                                class="flex items-center gap-3 antrian px-4 py-3  rounded-2xl font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Antrian Aktif
                            </a>
                            <a href="{{ route('profile.bpjs.index') }}"
                                class="flex items-center informasi-bpjs gap-3 px-4 py-3  rounded-2xl font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                Informasi BPJS
                            </a>
                            <div class="h-[1px] bg-gray-50 my-2"></div>
                            <a href="{{ route('auth.logout.process') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="flex items-center gap-3 px-4 py-3 text-red-400 hover:bg-red-50 rounded-2xl font-semibold transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Keluar Sistem
                            </a>
                        </nav>
                    </aside>

                    <main class="flex-1 space-y-4">
                        @yield('content')
                    </main>
                </div>
            </div>

        </div>
    </div>

</body>

</html>