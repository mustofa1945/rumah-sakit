@extends("layout.mainLayout")

@section("content")
    @if($errors->has('antrian'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-[-20px]"
            x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-[-20px]"
            class="fixed top-15 -right-10 -translate-x-1/2 z-[99] w-[90%] max-w-md">

            <div
                class="bg-white border-l-4 border-red-500 rounded-2xl shadow-2xl shadow-red-200/50 p-4 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="bg-red-50 p-2 rounded-xl">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-gray-900">Pendaftaran Gagal</h4>
                        <p class="text-xs text-gray-500 font-medium">{{ $errors->first('antrian') }}</p>
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
    <div class="min-h-screen bg-[#F8FAFC] py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <a href="{{  session('antrian_prev_url', route('poli.index')) }}"
                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 mb-6 transition-colors">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke halaman sebelumnya
            </a>

            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-blue-900/5 border border-gray-100 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-8 text-white">
                    <p class="text-blue-100 text-sm font-medium uppercase tracking-wider">Konfirmasi Pendaftaran Antrian</p>
                    <h2 class="text-3xl font-bold mt-2">dr. {{ $dokter->name }}</h2>
                    <div class="flex flex-wrap items-center gap-4 mt-4 text-blue-50">
                        <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl backdrop-blur-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-7h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="text-xs font-bold">{{ $dokter->poli->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/10 px-3 py-1.5 rounded-xl backdrop-blur-md">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-xs font-bold">{{ \Carbon\Carbon::parse($dokter->start_time)->format('H:i') }}
                                - {{ \Carbon\Carbon::parse($dokter->end_time)->format('H:i') }}</span>
                        </div>
                    </div>
                </div>

                <form action="{{ route('queue.store') }}" method="POST" class="p-8 md:p-12">
                    @csrf
                    <input type="hidden" name="dokter_id" value="{{ $dokter->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Kunjungan</label>
                            <div class="relative">
                                <input type="date" name="tanggal_kunjungan" value="{{ date('Y-m-d') }}" readonly
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-500 rounded-2xl px-5 py-4 focus:outline-none cursor-not-allowed font-medium">
                                <span
                                    class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md uppercase">Hari
                                    Ini</span>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Keluhan Utama</label>
                            <textarea name="keluhan" rows="4" required
                                placeholder="Ceritakan secara singkat gejala atau keluhan Anda..."
                                class="w-full border border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-blue-100 focus:border-blue-600 transition-all outline-none resize-none placeholder:text-gray-300"></textarea>
                            <p class="text-xs text-gray-400 mt-2 italic">*Informasi ini akan membantu dokter mempersiapkan
                                pemeriksaan Anda.</p>
                        </div>

                        <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100 flex gap-3">
                            <div
                                class="h-5 w-5 rounded-full bg-emerald-500 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <p class="text-sm text-emerald-800 leading-relaxed">
                                Dengan menekan tombol di bawah, Anda akan mendapatkan **nomor antrian otomatis** sesuai
                                urutan pendaftaran terakhir.
                            </p>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-5 rounded-2xl shadow-xl shadow-blue-200 transition-all transform active:scale-[0.98] flex items-center justify-center gap-3">
                            <span>Konfirmasi & Ambil Nomor Antrian</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            <p class="text-center text-gray-400 text-sm mt-8">
                Butuh bantuan mendesak? Hubungi <span class="text-blue-600 font-bold">Layanan Darurat 24 Jam</span>
            </p>
        </div>
    </div>
@endsection