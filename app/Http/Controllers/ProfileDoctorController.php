<?php

namespace App\Http\Controllers;

use App\Models\DoctorPublicProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProfileDoctorController extends Controller
{
    /**
     * Tampilkan profil dokter berdasarkan dokter_id
     *
     * @param  int  $dokter_id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index($dokter_id)
    {
        // Ambil profil publik dokter yang aktif
        $profile = DoctorPublicProfile::where('dokter_id', $dokter_id)
                    ->active() // scopeActive() di model
                    ->first();

        if (!$profile) {
            // Kalau tidak ada profil atau dokter tidak aktif, redirect ke daftar dokter
            return Redirect::route('tenaga-medis.index')
                ->with('error', 'Profil dokter tidak ditemukan atau tidak aktif.');
        }

        return view('pages.profile-doctor', compact('profile'));
    }
}
