<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Poli;
use App\Models\Dokter;


class HomeController extends Controller
{
    /**
     * Menampilkan halaman Home
     */
    public function index()
    {
        // Ambil semua poli
        $polis = Poli::orderBy('name')->get();

        // Hari ini (misal: Monday, Tuesday, dll)
        $today = Carbon::now()->translatedFormat('l');

        // Ambil dokter yang praktik hari ini
        $dokters = Dokter::with('poli')
            ->where('schedule_day', $today)
            ->orderBy('start_time')
            ->get();

        return view('pages.home', compact(
            'polis',
            'dokters'
        ));
    }
}
