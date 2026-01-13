<?php

namespace  App\Http\Controllers\AdminRegis;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PatientBiodata;
use App\Models\AdminRegistration;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRegisController extends Controller
{
    /**
     * Tampilkan form buat pasien baru
     */
    public function create()
    {
        return view('pages.admin-registration.insert-biodata-patient');
    }

     public function index()
    {
        // Ambil data admin berdasarkan user login
        $admin = AdminRegistration::where('user_id', Auth::id())->first();

        return view('pages.admin-registration.adregis-dashboard', compact('admin' ));
    }

    /**
     * Simpan pasien baru
     */
  public function store(Request $request)
{
    // 1. Validasi dasar (ringkas & relevan)
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string',
        
        'no_rm' => 'required|unique:patient_biodatas,no_rm',
        'nik'   => 'required|digits:16|unique:patient_biodatas,nik',
        
        'full_name' => 'required|string|max:255',
        'gender' => 'required|in:L,P',
        ]);
        

    DB::transaction(function () use ($request) {

        // 2. Insert ke tabel users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,

            'role_id' => 3, // asumsi role pasien (ubah sesuai tabel roles)
            'dokter_id' => null,

            'is_filled_biodata' => true,
            'registered_by_admin' => true,
        ]);


        // 3. Insert ke tabel patient_biodatas
        PatientBiodata::create([
            'user_id' => $user->id,

            'no_rm' => $request->no_rm,
            'nik' => $request->nik,
            'no_bpjs' => $request->no_bpjs,

            'full_name' => $request->full_name,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'blood_type' => $request->blood_type,
            'religion' => $request->religion,
            'marital_status' => $request->marital_status,

            'address' => $request->address,
            'village' => $request->village,
            'district' => $request->district,
            'city' => $request->city,
            'province' => $request->province,
            'postal_code' => $request->postal_code,

            'phone' => $request->phone,
            'emergency_contact_name' => $request->emergency_contact_name,
            'emergency_contact_relation' => $request->emergency_contact_relation,
            'emergency_contact_phone' => $request->emergency_contact_phone,
        ]);
    });

    return redirect()
        ->route('admin-registration.index')
        ->with('success', 'Pasien berhasil didaftarkan dan diaktifkan.');
}
}
