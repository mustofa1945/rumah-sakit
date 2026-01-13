@extends('layout.adregis-layout')

@section('content')
 @if (session('success'))
        <x-partials.notif-component message="Success" sign="{{ session('success') }}">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
<div class="min-h-screen bg-[#F8FAFC] p-8" x-data="{ editMode: false }">
    
    <div class="max-w-4xl mx-auto flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-semibold text-slate-800 tracking-tight">Data Registrator</h2>
            <p class="text-slate-500 text-sm">Ringkasan profil profesional admin.</p>
        </div>
        
        <a href="{{ route('admin-registration.create') }}" class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-lg shadow-blue-100 group">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="text-sm">Add Account</span>
        </a>
    </div>

    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-10">
            <div class="flex items-center gap-8">
                
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-gradient-to-tr from-teal-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-inner">
                        <svg class="w-10 h-10 text-white/90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>

                <div class="flex-grow grid grid-cols-2 gap-8 items-center">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">Nama Lengkap</label>
                        <p class="text-xl font-medium text-slate-800">{{ $admin->full_name ?? 'Budi Santoso, S.Kom' }}</p>
                    </div>

                    <div class="border-l border-slate-100 pl-8">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-1">Lulusan / Pendidikan</label>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-teal-400"></span>
                            <p class="text-lg font-medium text-slate-700 leading-tight">
                                {{ $admin->education_level ?? 'S1 Administrasi RS' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex-shrink-0">
                    <button @click="editMode = !editMode" 
                            class="p-2 hover:bg-slate-50 rounded-full transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" :class="editMode ? 'text-blue-600' : 'text-slate-300'" class="h-6 w-6 group-hover:text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="editMode" 
                 x-transition 
                 class="mt-8 pt-6 border-t border-dashed border-slate-100">
                <p class="text-xs text-blue-500 italic">* Mode edit aktif. Anda dapat menyesuaikan data di atas melalui sistem integrasi.</p>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto mt-6 flex gap-4 opacity-50">
         <div class="h-1 w-12 bg-blue-400 rounded-full"></div>
         <div class="h-1 w-6 bg-teal-400 rounded-full"></div>
         <div class="h-1 w-3 bg-slate-300 rounded-full"></div>
    </div>
    
</div>


@endsection