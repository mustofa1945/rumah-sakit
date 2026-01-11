@extends('layout.adminLayout')

@section('content')
<div class="space-y-12">

    <section>
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Master Data Poliklinik</h2>
                <p class="text-sm text-gray-500">Kelola daftar layanan spesialisasi poliklinik.</p>
            </div>
            <a href="{{ route('create.poli') }}" class="px-5 py-2.5 bg-[#064e3b] text-white rounded-lg text-sm font-semibold hover:bg-[#053f30] transition shadow-lg shadow-emerald-100">
                + Tambah Poli
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-xs uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Nama Poli</th>
                        <th class="px-8 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($polis as $poli)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-8 py-4 font-semibold text-gray-700">{{ $poli->name }}</td>
                            <td class="px-8 py-4 text-right space-x-2">
                                <a href="{{ route('edit.poli', $poli->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Update</a>

                                <form action="{{ route('destroy.poli', $poli->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 font-medium text-sm ml-4" onclick="return confirm('Yakin ingin menghapus poli ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-8 py-4 text-center text-gray-400">Belum ada data poli</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

</div>
@endsection
