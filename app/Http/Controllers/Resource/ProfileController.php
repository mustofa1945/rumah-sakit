<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Models\PatientBiodata;
use App\Models\PatientHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

     public function historyPovPatient()
    {
        $user = Auth::user();

        $histories = PatientHistory::with('dokter')
            ->where('user_id', $user->id)
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        return view('pages.profile.patient-riwayat-medis', compact('histories'));
    }
}
