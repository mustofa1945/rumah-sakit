<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BpjsInformation;
use Illuminate\Support\Facades\Auth;

class BpjsInformationController extends Controller
{
    /**
     * Menampilkan informasi BPJS milik user yang sedang login
     */
    public function index()
    {
        $bpjs = Auth::user()->bpjs;


        return view('pages.profile.bpjs-information', compact('bpjs'));
    }

    public function create()
    {

         $user = Auth::user();
        $bpjs = BpjsInformation::where('user_id', $user->id)->first();
        
        return view('pages.profile.bpjs-form', compact('bpjs'));

    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Validasi sesuai form & standar BPJS
        $validated = $request->validate([
            'nomor_kartu' => 'required|digits_between:13,16|unique:bpjs_informations,nomor_kartu',
            'nik' => 'required|digits:16',
            'nama_peserta' => 'required|string|max:255',

            'kelas' => 'required|in:KELAS_1,KELAS_2,KELAS_3',
            'jenis_peserta' => 'required|in:PBI,MANDIRI,PEKERJA_PENERIMA_UPAH,BUKAN_PENERIMA_UPAH',
            'faskes_tingkat_1' => 'required|string|max:255',

            'status_kepesertaan' => 'required|in:AKTIF,NONAKTIF,MENUNGGAK',
            'tanggal_aktif' => 'required|date',
        ]);

        // Pastikan user belum punya BPJS
        if ($user->bpjs) {
            return redirect()
                ->route('profile.bpjs.index')
                ->with('warning', 'Anda sudah memiliki data BPJS.');
        }

        // Simpan
        BpjsInformation::create([
            'user_id' => $user->id,
            'nomor_kartu' => $validated['nomor_kartu'],
            'nik' => $validated['nik'],
            'nama_peserta' => strtoupper($validated['nama_peserta']),
            'kelas' => $validated['kelas'],
            'jenis_peserta' => $validated['jenis_peserta'],
            'faskes_tingkat_1' => $validated['faskes_tingkat_1'],
            'status_kepesertaan' => $validated['status_kepesertaan'],
            'tanggal_aktif' => $validated['tanggal_aktif'],
        ]);

        return redirect()
            ->route('profile.bpjs.index')
            ->with('success', 'Informasi BPJS berhasil disimpan.');
    }
}
