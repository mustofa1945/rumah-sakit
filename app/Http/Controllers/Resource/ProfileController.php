<?php

namespace App\Http\Controllers\Resource;

use Illuminate\Http\Request;
use App\Models\PatientBiodata;
use App\Models\PatientHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pasien
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil biodata pasien jika ada
        $biodata = PatientBiodata::where('user_id', $user->id)->first();

        return view('pages.profile.main-profile', compact('user', 'biodata'));
    }

/**
     * Update biodata pasien
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'nik' => 'nullable|string|size:16|unique:patient_biodatas,nik,' . optional($user->patientBiodata)->id,
            'no_bpjs' => 'nullable|string|max:20',
            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'blood_type' => 'nullable|in:A,B,AB,O',
            'place_of_birth' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'religion' => 'nullable|string|max:50',
            'marital_status' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'address' => 'nullable|string',
            'village' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:50',
        ]);

        // Cek apakah sudah ada biodata
        $biodata = PatientBiodata::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        // Update flag isFilledBiodata di users
        $user->is_filled_biodata = true;
        $user->save();

        return redirect()->route('profile.index')
            ->with('success', 'Biodata berhasil diperbarui.');
    }

    /**
     * Show form untuk create (tidak dipakai, karena index langsung bisa handle)
     */
    public function create()
    {
        //
    }

    /**
     * Store baru (tidak dipakai, karena updateOrCreate di update)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show detail resource (opsional)
     */
    public function show($id)
    {
        //
    }

    /**
     * Edit form resource (opsional)
     */
    public function edit($id)
    {
        //
    }

    /**
     * Delete resource (opsional)
     */
    public function destroy($id)
    {
        //
    }

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
