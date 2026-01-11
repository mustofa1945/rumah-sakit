<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 px-8 flex items-center justify-between shadow-sm">
    <div class="flex items-center space-x-10">
        <a href="{{ route('home.index') }}" class="flex items-center space-x-3 group cursor-pointer">
            <div class="w-10 h-10 bg-gradient-to-tr from-[#064e3b] to-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-100 group-hover:scale-105 transition-transform">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 v5m-4 0h4"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-800 leading-none">MediPakar</h1>
                <p class="text-[10px] text-emerald-600 font-bold uppercase tracking-[0.2em]">Management System</p>
            </div>
        </a>
        <nav class="hidden lg:flex items-center space-x-1">
            <a href="{{ route('poli.index') }}" class="px-4 py-2 text-sm font-semibold text-[#064e3b] hover:bg-emerald-50 rounded-xl transition-all">Layanan Poli</a>
            <a href="{{ route('tenaga-medis.index') }}" class="px-4 py-2 text-sm font-semibold text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-xl transition-all">Tenaga Medis</a>
        </nav>
    </div>

    <div class="flex items-center" x-data="{ open: false }">
        <div class="relative">
            <div @click="open = !open" @click.away="open = false" class="flex items-center pl-6 border-l border-gray-100 group cursor-pointer select-none">
                <div class="text-right mr-3">
                    <p class="text-sm font-bold text-gray-800 group-hover:text-[#064e3b] transition-colors leading-none">
                        {{ Auth::check() ? Auth::user()->name : 'Guest Account' }}
                    </p>
                    <p class="text-[10px] text-gray-400 font-medium tracking-tighter mt-1 uppercase">
                        {{ Auth::check() ? 'Patient' : 'Guest' }}
                    </p>
                </div>
                <div class="w-10 h-10 rounded-full border-2 border-emerald-500/20 p-0.5 group-hover:border-emerald-500 transition-all overflow-hidden bg-gray-50">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::check() ? Auth::user()->name : 'Guest' }}&background=064e3b&color=fff" 
                         class="rounded-full w-full h-full object-cover" alt="User">
                </div>
                <svg class="w-4 h-4 ml-2 text-gray-400 transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>

            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform translate-y-4"
                 class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-2xl shadow-emerald-900/10 border border-gray-100 py-2 z-[60]"
                 style="display: none;">
                
                @auth
                    <div class="px-4 py-3 border-b border-gray-50 mb-1">
                        <p class="text-xs text-gray-400">Signed in as</p>
                        <p class="text-sm font-bold text-[#064e3b] truncate">{{ Auth::user()->email }}</p>
                    </div>

                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2.5 text-sm text-gray-600 hover:bg-emerald-50 hover:text-[#064e3b] transition-all group">
                        <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-[#064e3b]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile Menu
                    </a>

                    <div class="border-t border-gray-50 my-1"></div>

                    <form action="{{ route('auth.logout.process') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition-all group">
                            <svg class="w-4 h-4 mr-3 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Sign Out
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('auth.login.index') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all group">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </div>
                        <span class="font-bold">Masuk Akun</span>
                    </a>
                @endguest
            </div>
        </div>
    </div>
</header>