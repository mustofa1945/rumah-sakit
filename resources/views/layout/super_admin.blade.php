<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Medical System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    @stack('styles')
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC]">

    <div class="flex h-screen overflow-hidden">
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col shadow-sm">
            <div class="p-6 border-b border-gray-50">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-[#064e3b] rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200">
                        <span class="text-white font-bold text-xl">M</span>
                    </div>
                    <span class="text-xl font-bold text-gray-800 tracking-tight">Admin<span class="text-[#064e3b]">Med</span></span>
                </div>
            </div>
            
            <nav class="flex-1 px-4 py-6 space-y-1">
                @php
                     $isPoli = request()->routeIs('view.poli');
                     $isPoliCreate = request()->routeIs('create.poli');
                     $isPoliEdit = request()->routeIs('edit.poli');
                     $isDokter = request()->routeIs('view.dokter');
                     $isDokterCreate = request()->routeIs('create.dokter');
                     $isDokterEdit = request()->routeIs('edit.dokter');
                @endphp
                <p class="px-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Manajemen Data</p>
                
                <a href="{{ route("view.poli") }}" class="flex nav-poli items-center px-4 py-3 {{ $isPoli || $isPoliCreate ||  $isPoliEdit ? 'text-white bg-[#064e3b]' : 'text-gray-500 hover:bg-emerald-50 hover:text-[#064e3b]' }}  rounded-xl shadow-md shadow-emerald-100 transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="font-semibold">Data Poli</span>
                </a>

                <a href="{{ route("view.dokter") }}" class="flex nav-dokter items-center px-4 py-3 {{ $isDokter || $isDokterCreate || $isDokterEdit ? 'text-white bg-[#064e3b]' : 'text-gray-500 hover:bg-emerald-50 hover:text-[#064e3b]' }}  rounded-xl transition duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span>Data Dokter</span>
                </a>
            </nav>

            <div class="p-4 mt-auto border-t border-gray-50 text-center">
                <span class="text-[10px] text-gray-400 font-medium">v1.0.2 Premium Admin</span>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            <header class="h-20 bg-white/80 backdrop-blur-md flex items-center justify-between px-10 border-b border-gray-100">
                <h1 class="text-xl font-bold text-gray-800">Sistem Manajemen Rumah Sakit</h1>
                <div class="flex items-center space-x-4">
                    <div class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 font-bold">
                        AD
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-10">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>