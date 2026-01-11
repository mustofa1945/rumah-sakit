
@props([
    'message',
    'sign'
])
<div x-data="{ 
        show: false, 
        message: 'Pesanan Anda telah berhasil dikirim!',
        init() {
            // Trigger muncul otomatis untuk demo
            setTimeout(() => this.show = true, 500);
            // Sembunyikan otomatis setelah 5 detik
            setTimeout(() => this.show = false, 5000);
        }
    }" class="relative">

    <template x-teleport="body">
        <div x-show="show" x-transition:enter="transition ease-out duration-500"
            x-transition:enter-start="opacity-0 -translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            class="fixed top-6 left-1/2 -translate-x-1/2 z-[99] w-[90%] max-w-sm">
            <div
                class="bg-white/80 backdrop-blur-md border border-gray-100 shadow-xl rounded-2xl p-4 flex items-center space-x-4">

                <div class="shrink-0">
                    <div class="relative flex items-center justify-center">
                        {{ $slot }}
                    </div>
                </div>

                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-900">{{ $message }}</p>
                    <p class="text-xs text-gray-500">{{ $sign }}</p>
                </div>

                <button @click="show = false" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>

@push("styles")
    <style>
        @keyframes pulse-gentle {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }
        }

        .animate-pulse-gentle {
            animation: pulse-gentle 2s infinite ease-in-out;
        }
    </style>
@endpush