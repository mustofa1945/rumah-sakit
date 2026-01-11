@extends('layout.mainLayout')

@section('content')
<div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-sm border border-gray-100 mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Login Akun</h1>
        <p class="text-gray-400 text-sm">Masuk untuk mengelola poliklinik Anda.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-red-800 font-bold">Error Login</h3>
            </div>
            <ul class="text-sm text-red-600 space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="flex items-start">
                        <span class="mr-2">•</span>
                        <span>{{ $error }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-green-800">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('status'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <span class="text-blue-800">{{ session('status') }}</span>
            </div>
        </div>
    @endif

    <form action="{{ route('auth.login.process') }}" method="POST" class="space-y-6">
        @csrf
        
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Email</label>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}"
                placeholder="Email" 
                required
                class="w-full px-4 py-3 bg-gray-50 rounded-xl border-transparent focus:bg-white focus:border-blue-600 focus:ring-0 outline-none transition-all
                @error('email') border-red-300 bg-red-50 @enderror">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Password</label>
            <input 
                type="password" 
                name="password" 
                placeholder="••••••••" 
                required
                class="w-full px-4 py-3 bg-gray-50 rounded-xl border-transparent focus:bg-white focus:border-blue-600 focus:ring-0 outline-none transition-all
                @error('password') border-red-300 bg-red-50 @enderror">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>
            
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                Lupa password?
            </a>
        </div>

        <button type="submit"
            class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-[#064e3b] transition-all shadow-lg shadow-blue-100">
            Masuk
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-50 text-center">
        <span class="text-sm text-gray-400">Belum punya akun? 
            <a href="{{ route('auth.register.index') }}" class="text-[#064e3b] font-bold">Daftar Sekarang</a>
        </span>
    </div>
</div>
@endsection