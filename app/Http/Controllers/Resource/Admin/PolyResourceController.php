<?php

namespace App\Http\Controllers\Resource\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poli;
use Illuminate\Http\Request;

class PolyResourceController extends Controller
{
    // Tampilkan daftar semua poli
    public function index()
    {
        $polis = Poli::all(); // ambil semua data poli
        return view('pages.super_admin.poli.view', compact('polis'));
    }

    // Tampilkan form create poli
    public function create()
    {
        return view('pages.super_admin.poli.create');
    }

    // Simpan data poli baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:polis,name|max:255',
        ]);

        Poli::create($request->only('name'));

        return redirect()->route('view.poli')->with('success', 'Poli berhasil ditambahkan');
    }

    // Tampilkan form edit
    public function edit(Poli $poli)
    {
        return view('pages.super_admin.poli.post', compact('poli'));
    }

    // Update data poli
    public function update(Request $request, Poli $poli)
    {
        $request->validate([
            'name' => 'required|unique:polis,name,' . $poli->id . '|max:255',
        ]);

        $poli->update($request->only('name'));

        return redirect()->route('view.poli')->with('success', 'Poli berhasil diupdate');
    }

    // Hapus data poli
    public function destroy(Poli $poli)
    {
        $poli->delete();
        return redirect()->route('view.poli')->with('success', 'Poli berhasil dihapus');
    }
}
