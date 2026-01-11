<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .aside-scroll::-webkit-scrollbar { width: 4px; }
        .aside-scroll::-webkit-scrollbar-track { background: transparent; }
        .aside-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    </style>
</head>

<body class="bg-[#F8FAFC]">
    <div class="min-h-screen flex" x-data="{ activeMenu: 'dashboard' }">
        <aside
            class="w-72 bg-[#064E3B] text-white hidden md:flex flex-col sticky top-0 h-screen shadow-2xl shadow-emerald-900/20">

            <div class="p-8 relative overflow-hidden">
                <div class="relative z-10 flex items-center gap-3">
                    <div class="p-2 bg-emerald-400/20 rounded-lg backdrop-blur-sm border border-emerald-400/30">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight italic">Klinik<span
                            class="text-emerald-400 not-italic">Care</span></span>
                </div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl"></div>
            </div>

            <nav class="flex-1 px-4 space-y-1.5 aside-scroll overflow-y-auto mt-4">
                <div class="text-[10px] uppercase tracking-[0.2em] text-emerald-400/60 font-bold px-4 mb-4">Main Menu
                </div>

                <a href="#" @click="activeMenu = 'dashboard'"
                    :class="activeMenu === 'dashboard' ? 'bg-white/10 text-white border-l-4 border-emerald-400 shadow-lg' : 'text-emerald-100/70 hover:bg-white/5 hover:text-white border-l-4 border-transparent'"
                    class="group flex items-center px-4 py-3 rounded-r-xl transition-all duration-300">
                    <svg class="w-5 h-5 mr-3 transition-transform group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                        </path>
                    </svg>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>

                <a href="#" @click="activeMenu = 'dokter'"
                    :class="activeMenu === 'dokter' ? 'bg-white/10 text-white border-l-4 border-emerald-400 shadow-lg' : 'text-emerald-100/70 hover:bg-white/5 hover:text-white border-l-4 border-transparent'"
                    class="group flex items-center px-4 py-3 rounded-r-xl transition-all duration-300">
                    <svg class="w-5 h-5 mr-3 transition-transform group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="text-sm font-medium">Data Dokter</span>
                </a>

                <a href="#" @click="activeMenu = 'antrian'"
                    :class="activeMenu === 'antrian' ? 'bg-white/10 text-white border-l-4 border-emerald-400 shadow-lg' : 'text-emerald-100/70 hover:bg-white/5 hover:text-white border-l-4 border-transparent'"
                    class="group flex items-center px-4 py-3 rounded-r-xl transition-all duration-300">
                    <svg class="w-5 h-5 mr-3 transition-transform group-hover:scale-110" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-medium">Antrian Saya</span>
                </a>
            </nav>

            <div class="p-4 mt-auto border-t border-emerald-800/50 bg-[#043d2f]">
                <button
                    class="flex items-center w-full px-4 py-3 text-emerald-100/60 hover:text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all duration-300 group">
                    <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span class="text-sm font-semibold">Keluar Akun</span>
                </button>
            </div>
        </aside>

        <main class="flex-1">
            <header class="bg-white border-b border-slate-100 p-4 flex justify-between items-center px-8">
                <h2 class="text-xl font-semibold text-slate-800">Manajemen Antrian</h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm font-medium text-slate-600">{{ Auth::user()->name ?? 'User Premium' }}</span>
                    <div class="w-10 h-10 rounded-full bg-indigo-100 border border-indigo-200"></div>
                </div>
            </header>

            <div class="p-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>