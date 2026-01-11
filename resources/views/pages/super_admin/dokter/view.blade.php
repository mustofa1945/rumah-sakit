@extends('layout.adminLayout')

@section('content')

<div class="space-y-12">

    <section>
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold  text-blue-900">Data Tenaga Medis (Dokter)</h2>
                <p class="text-sm text-gray-500">Atur jadwal dan penempatan dokter di poliklinik.</p>
            </div>
            <a href="{{ route('create.dokter') }}" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition shadow-lg shadow-blue-100">+ Tambah Dokter</a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50/50 border-b border-gray-100 text-gray-400 text-xs uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-4">ID</th>
                        <th class="px-6 py-4">Nama Dokter</th>
                        <th class="px-6 py-4">Poliklinik</th>
                        <th class="px-6 py-4 text-center">Jadwal Hari</th>
                        <th class="px-6 py-4 text-center">Jam</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($dokters as $dokter)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4 text-gray-400 font-mono text-xs">DOC-{{ str_pad($dokter->id, 3, '0', STR_PAD_LEFT) }}</td>
                        <td class="px-6 py-4 font-bold text-gray-800">{{ $dokter->name }}</td>
                        <td class="px-6 py-4 text-emerald-700 font-medium">{{ $dokter->poli->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-[10px] font-bold">{{ strtoupper($dokter->schedule_day) }}</span>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600 text-sm italic">  {{ \Carbon\Carbon::parse($dokter->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($dokter->end_time)->format('H:i') }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('edit.dokter', $dokter->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">Update</a>
                            <form action="{{ route('destroy.dokter', $dokter->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 font-medium text-sm ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

</div>

@endsection
