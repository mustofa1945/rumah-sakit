<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Poli;
use App\Models\Dokter;

class TenagaMedisController extends Controller
{
    /**
     * Menampilkan halaman Tenaga Medis
     */
    public function index()
    {
        // Ambil semua poli untuk dropdown filter
              $hariMap = [
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
            'Sunday'    => 'Minggu',
        ];

        $hariIni = $hariMap[Carbon::now()->format('l')];

          $polis = Poli::orderBy('name')->get();

        // Ambil dokter yang praktik hari ini
        $dokters = Dokter::with('poli')
            ->where('schedule_day', $hariIni)
            ->orderBy('name')
            ->get();

        return view('pages.medical-personnel', compact('polis', 'dokters'));
    }
}
