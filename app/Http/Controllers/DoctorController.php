<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function index()
    {
        // Mapping hari Inggris -> Indonesia (AMAN & STABIL)
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

        // Ambil dokter siaga hari ini + jam aktif
        $dokters = Dokter::with('poli')
            ->where('schedule_day', $hariIni)
            ->orderBy('start_time', 'asc')
            ->get();
    

        return view('pages.doctor-schedule', compact('dokters'));
    }
}
