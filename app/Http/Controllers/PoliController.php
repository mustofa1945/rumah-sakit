<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Poli;
use App\Models\Dokter;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{

    public function index()
    {
        // Ambil semua poli
        $polis = Poli::orderBy('name', 'asc')->get();

        // Statistik (opsional, tapi cocok dengan UI kamu)
        $totalPoli = $polis->count();

        $hariMap = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu',
        ];

        $hariIni = $hariMap[Carbon::now()->format('l')];

        $tanggalIni = Carbon::today(); // 2026-01-12

        $dokterHariIni = Dokter::where('schedule_day', $hariIni)
            ->count();

        $antrianAktif = Auth::check()
            ? Antrian::where('user_id', Auth::id())
                ->whereIn('status', ['WAITING', 'CALLED'])
                ->whereDate('tanggal_kunjungan' , $tanggalIni)
                ->count()
            : 0;

        return view('pages.poli', compact(
            'polis',
            'totalPoli',
            'dokterHariIni',
            'antrianAktif'
        ));
    }
    /**
     * Tampilkan detail poli beserta jadwal dokter
     */
    public function doctorByPoly($poliId)
    {
        // Ambil poli beserta dokter
        $poli = Poli::with('dokters')->findOrFail($poliId);


        return view('pages.poly-doctor', compact('poli'));
    }
}
