@extends('layout.profile-layout')

@section('content')
    @if (session('message'))
        <x-partials.notif-component message="Warninf" sign="Tolong isi biodata">
            <x-partials.icon-alert />
        </x-partials.notif-component>
    @endif
     @if (session('success'))
        <x-partials.notif-component message="Success" sign="Perubahan Telah Disimpan">
            <x-partials.icon-correct />
        </x-partials.notif-component>
    @endif
    <div
        class="flex mt-10 flex-col md:flex-row justify-between items-start md:items-center bg-[#064e3b] rounded-[2.5rem] p-8 text-white shadow-xl shadow-emerald-900/10">
        <div>
            <h2 class="text-2xl font-bold">Informasi Pasien</h2>
            <p class="text-emerald-100/70 text-sm mt-1">Lengkapi data diri Anda untuk kemudahan pelayanan rekam
                medis.</p>
        </div>
        @if($biodata)
            <div class="mt-4 md:mt-0 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20">
                <span class="text-xs font-medium text-emerald-100 uppercase block">No. Rekam Medis</span>
                <span class="text-lg font-mono font-bold">{{ $biodata->no_rm }}</span>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6">

                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2 border-b border-gray-50 pb-3">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Data Identitas Utama
                        </h3>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">NIK
                                Pasien (Sesuai KTP)</label>
                            <input type="text" name="nik" value="{{ $biodata->nik ?? '' }}"
                                class="w-full px-5 py-3.5 bg-gray-50 border border-transparent focus:border-blue-500 focus:bg-white rounded-2xl transition-all outline-none text-gray-700 font-medium"
                                placeholder="16 Digit NIK">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nama
                                Lengkap</label>
                            <input type="text" name="full_name" value="{{ $biodata->full_name ?? Auth::user()->name }}"
                                class="w-full px-5 py-3.5 bg-gray-50 border border-transparent focus:border-blue-500 focus:bg-white rounded-2xl transition-all outline-none text-gray-700 font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Golongan
                                    Darah</label>
                                <select name="blood_type"
                                    class="w-full px-5 py-3.5 bg-gray-50 border border-transparent focus:border-blue-500 focus:bg-white rounded-2xl transition-all outline-none text-gray-700 font-medium">
                                    <option value="A" {{ ($biodata->blood_type ?? '') == 'A' ? 'selected' : '' }}>
                                        A</option>
                                    <option value="B" {{ ($biodata->blood_type ?? '') == 'B' ? 'selected' : '' }}>
                                        B</option>
                                    <option value="AB" {{ ($biodata->blood_type ?? '') == 'AB' ? 'selected' : '' }}>AB
                                    </option>
                                    <option value="O" {{ ($biodata->blood_type ?? '') == 'O' ? 'selected' : '' }}>
                                        O</option>
                                </select>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Gender</label>
                                <div class="flex gap-2">
                                    <label class="flex-1">
                                        <input type="radio" name="gender" value="L" class="hidden peer" {{ ($biodata->gender ?? '') == 'L' ? 'checked' : '' }}>
                                        <div
                                            class="text-center py-3 bg-gray-50 border border-transparent peer-checked:border-emerald-500 peer-checked:bg-emerald-50 rounded-xl cursor-pointer transition-all text-sm font-bold text-gray-500 peer-checked:text-[#064e3b]">
                                            L</div>
                                    </label>
                                    <label class="flex-1">
                                        <input type="radio" name="gender" value="P" class="hidden peer" {{ ($biodata->gender ?? '') == 'P' ? 'checked' : '' }}>
                                        <div
                                            class="text-center py-3 bg-gray-50 border border-transparent peer-checked:border-emerald-500 peer-checked:bg-emerald-50 rounded-xl cursor-pointer transition-all text-sm font-bold text-gray-500 peer-checked:text-[#064e3b]">
                                            P</div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2 border-b border-gray-50 pb-3">
                            <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                            Kontak & Domisili
                        </h3>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Nomor
                                WhatsApp/HP</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 font-bold">+62</span>
                                <input type="text" name="phone" value="{{ $biodata->phone ?? '' }}"
                                    class="w-full pl-14 pr-5 py-3.5 bg-gray-50 border border-transparent focus:border-blue-500 focus:bg-white rounded-2xl transition-all outline-none text-gray-700 font-medium"
                                    placeholder="8123xxx">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Alamat
                                Lengkap</label>
                            <textarea name="address" rows="3"
                                class="w-full px-5 py-3.5 bg-gray-50 border border-transparent focus:border-blue-500 focus:bg-white rounded-2xl transition-all outline-none text-gray-700 font-medium"
                                placeholder="Nama Jalan, Blok, No Rumah">{{ $biodata->address ?? '' }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kota/Kab</label>
                                <input type="text" name="city" value="{{ $biodata->city ?? '' }}"
                                    class="w-full px-5 py-3.5 bg-gray-50 border border-transparent focus:border-blue-500 focus:bg-white rounded-2xl transition-all outline-none text-gray-700 font-medium">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kode
                                    Pos</label>
                                <input type="text" name="postal_code" value="{{ $biodata->postal_code ?? '' }}"
                                    class="w-full px-5 py-3.5 bg-gray-50 border border-transparent focus:border-blue-500 focus:bg-white rounded-2xl transition-all outline-none text-gray-700 font-medium">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="mt-12 flex justify-end gap-4 border-t border-gray-50 pt-8">
                    <button type="reset"
                        class="px-8 py-3.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition-all">Batal</button>
                    <button type="submit"
                        class="px-10 py-3.5 bg-[#064e3b] text-white rounded-2xl font-bold shadow-lg shadow-emerald-900/20 hover:scale-[1.02] transition-all">Simpan
                        Perubahan</button>
                </div>
            </form>
        </div>


@endsection

    @push('styles')
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            :root {
                --emerald-dark: #064e3b;
                --emerald-light: #ecfdf5;
                --gray-500: #6B7280;
                --gray-50: #F9FAFB;
                --blue-600: #2563EB;
            }

            .antrian,
            .riwayat,
            .informasi-bpjs {
                color: var(--gray-500);
                transition: all 0.2s ease;
                cursor: pointer;
            }

            .antrian:hover,
            .riwayat:hover,
            .informasi-bpjs:hover {
                background-color: var(--gray-50);
                color: var(--blue-600);
            }

            .biodata-asli {
                color: var(--emerald-dark);
                background-color: var(--emerald-light);
                cursor: pointer;
            }
        </style>
    @endpush