<?php
namespace App\Http\Controllers\Resource\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poli;
use Illuminate\Http\Request;

class DoctorResourceController extends Controller
{
    // Tampilkan daftar dokter
    public function index()
    {
        $dokters = Dokter::with('poli')->get(); // ambil dokter + relasi poli
        return view('pages.super_admin.dokter.view', compact('dokters'));
    }

    // Tampilkan form create dokter
    public function create()
    {
        $polis = Poli::all(); // untuk dropdown pilih poli
        return view('pages.super_admin.dokter.create', compact('polis'));
    }

    // Simpan dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'poli_id' => 'required|exists:polis,id',
            'schedule_day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        Dokter::create($request->only('name', 'poli_id', 'schedule_day', 'start_time', 'end_time'));

        return redirect()->route('view.dokter')->with('success', 'Dokter berhasil ditambahkan');
    }

    // Tampilkan form edit dokter
    public function edit(Dokter $dokter)
    {
        $polis = Poli::all();
        return view('pages.super_admin.dokter.post', compact('dokter', 'polis'));
    }

    // Update dokter
    public function update(Request $request, Dokter $dokter)
    {
        $request->validate([
            'name' => 'required|max:255',
            'poli_id' => 'required|exists:polis,id',
            'schedule_day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        $dokter->update($request->only('name', 'poli_id', 'schedule_day', 'start_time', 'end_time'));

        return redirect()->route('view.dokter')->with('success', 'Dokter berhasil diupdate');
    }

    // Hapus dokter
    public function destroy(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->route('view.dokter')->with('success', 'Dokter berhasil dihapus');
    }
}
