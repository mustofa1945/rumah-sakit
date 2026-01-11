@extends('layout.mainLayout')

@section('content')
<div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-sm border border-gray-100 mx-auto">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Akun</h1>
        <p class="text-gray-400 text-sm">Mulai kelola poliklinik Anda hari ini.</p>
    </div>

    <!-- Error Container -->
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <h3 class="text-red-800 font-bold">Terdapat Kesalahan</h3>
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

    <!-- Success Message -->
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

    <form action="{{ route('auth.register.create') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Username Field -->
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Username</label>
            <input 
                type="text" 
                name="username" 
                value="{{ old('username') }}"
                placeholder="Username" 
                required
                class="w-full px-4 py-3 bg-gray-50 rounded-xl border-transparent focus:bg-white focus:border-blue-600 focus:ring-0 outline-none transition-all
                @error('username') border-red-300 bg-red-50 @enderror">
            @error('username')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
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

        <!-- Password Field -->
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
            
            <!-- Password Requirements -->
            <div class="mt-2 p-3 bg-blue-50 rounded-lg">
                <p class="text-xs font-medium text-blue-800 mb-1">Persyaratan Password:</p>
                <ul class="text-xs text-blue-600 space-y-1">
                    <li class="flex items-center">
                        <svg class="w-3 h-3 mr-1 @if(strlen(old('password') ?? '') >= 6) text-green-500 @else text-gray-400 @endif" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Minimal 6 karakter
                    </li>
                </ul>
            </div>
        </div>

        <!-- Confirm Password Field -->
        <div>
            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Konfirmasi Password</label>
            <input 
                type="password" 
                name="password_confirmation" 
                placeholder="••••••••" 
                required
                class="w-full px-4 py-3 bg-gray-50 rounded-xl border-transparent focus:bg-white focus:border-blue-600 focus:ring-0 outline-none transition-all
                @error('password_confirmation') border-red-300 bg-red-50 @enderror">
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input 
                    type="checkbox" 
                    name="terms" 
                    id="terms"
                    value="1"
                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                    @if(old('terms')) checked @endif
                    required>
            </div>
            <label for="terms" class="ml-2 text-sm text-gray-600">
                Saya menyetujui 
                <a href="#" class="text-blue-600 hover:underline font-medium">Syarat & Ketentuan</a> 
                dan 
                <a href="#" class="text-blue-600 hover:underline font-medium">Kebijakan Privasi</a>
            </label>
        </div>
        @error('terms')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror

        <button type="submit"
            class="w-full py-4 bg-blue-600 text-white rounded-xl font-bold hover:bg-[#064e3b] transition-all shadow-lg shadow-blue-100">
            Buat Akun
        </button>
    </form>

    <div class="mt-8 pt-6 border-t border-gray-50 text-center">
        <span class="text-sm text-gray-400">Sudah punya akses? 
            <a href="{{ route('auth.login.index') }}" class="text-[#064e3b] font-bold">Login</a>
        </span>
    </div>
</div>

<!-- JavaScript for Real-time Password Validation -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.querySelector('input[name="password"]');
    const confirmPasswordInput = document.querySelector('input[name="password_confirmation"]');
    const passwordRequirements = document.querySelectorAll('.password-requirement');
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            
            // Update password requirements indicators
            const lengthRequirement = document.querySelector('#length-requirement');
            if (lengthRequirement) {
                const icon = lengthRequirement.querySelector('svg');
                const text = lengthRequirement.querySelector('span');
                if (password.length >= 6) {
                    icon.classList.remove('text-gray-400');
                    icon.classList.add('text-green-500');
                    text.classList.remove('text-gray-500');
                    text.classList.add('text-green-600');
                } else {
                    icon.classList.remove('text-green-500');
                    icon.classList.add('text-gray-400');
                    text.classList.remove('text-green-600');
                    text.classList.add('text-gray-500');
                }
            }
            
            // Check password match
            if (confirmPasswordInput && confirmPasswordInput.value) {
                validatePasswordMatch();
            }
        });
    }
    
    if (confirmPasswordInput && passwordInput) {
        confirmPasswordInput.addEventListener('input', validatePasswordMatch);
    }
    
    function validatePasswordMatch() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;
        
        if (confirmPassword && password !== confirmPassword) {
            confirmPasswordInput.classList.add('border-red-300', 'bg-red-50');
            confirmPasswordInput.classList.remove('border-transparent');
        } else {
            confirmPasswordInput.classList.remove('border-red-300', 'bg-red-50');
            confirmPasswordInput.classList.add('border-transparent');
        }
    }
});
</script>
@endpush
@endsection