<?php

namespace App\Http\Controllers\AdminRegis;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Nurse;
use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminRegisAntrianController extends Controller
{
    public function index()
    {
        $patientsToday = User::query()
            ->where('registered_by_admin', true)
            ->whereDate('created_at', now()->toDateString())
            ->whereHas('patientBiodata')
            ->with('patientBiodata')
            ->limit(10)
            ->get();

        return view('pages.admin-registration.added-user', compact('patientsToday'));
    }

    public function shiftActive(User $patient)
    {
    
        $todayDay = Carbon::today()->locale('id')->isoFormat('dddd'); // "Senin", "Selasa", ...

    

        // Ambil Dokter yang aktif hari ini
        $dokters = Dokter::where('schedule_day', $todayDay)
            ->get();

        // Ambil Nurse yang statusnya aktif hari ini
        $nurses = Nurse::where('status', 'aktif')
            ->get();
        return view('pages.admin-registration.get-antrean-user-by-admin', compact('dokters', 'nurses', "patient"));
    }
}
