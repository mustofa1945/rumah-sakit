<?php

namespace App\Http\Controllers\Nurse;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Nurse;
use Illuminate\Http\Request;
use App\Models\NurseSchedule;
use App\Models\PatientBiodata;
use App\Models\NurseAssignment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NurseController extends Controller
{
    /**
     * Form input pasien offline
     */
    public function index()
    {
        return view('pages.nurse.create-biodata-user');
    }

    public function dashboardIndex()
    {
        $user = Auth::user();

        // Ambil data perawat + relasi poli
        $nurse = Nurse::with('poli')
            ->withCount('assignments')
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Penugasan pasien hari ini
        $nurse_assignments = NurseAssignment::with('patient')
            ->where('nurse_id', $nurse->id)
            ->whereDate('assigned_at', Carbon::today())
            ->orderBy('assigned_at', 'desc')
            ->get();

        // Jadwal besok
        $tomorrow_schedule = NurseSchedule::where('nurse_id', $nurse->id)
            ->whereDate('date', Carbon::tomorrow())
            ->first();

        // Jadwal mendatang (selain hari ini)
        $upcoming_schedules = NurseSchedule::where('nurse_id', $nurse->id)
            ->whereDate('date', '>', Carbon::today())
            ->orderBy('date')
            ->limit(5)
            ->get();

        return view('pages.nurse.nurse-dashboard', compact(
            'nurse',
            'nurse_assignments',
            'tomorrow_schedule',
            'upcoming_schedules'
        ));

    }

    public function updateStatus(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:nurse_schedules,id',
            'status' => 'required|in:PENDING,CONFIRMED,CANCELED'
        ]);

        // Ambil schedule
        $schedule = NurseSchedule::findOrFail($request->id);

        // Update status
        $schedule->status = $request->status;
        
        $schedule->save();

        // Redirect ke dashboard dengan flash message
        return redirect()->route('nurse.dashboard.index')
            ->with('success', 'Status schedule berhasil diubah menjadi ' . $request->status);
    }

    /**
     * Simpan pasien offline (buat user + biodata)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // USER (akun pasien)
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',

            // BIODATA
            'no_rm' => 'required|string|max:20|unique:patient_biodatas,no_rm',
            'nik' => 'required|string|size:16|unique:patient_biodatas,nik',
            'no_bpjs' => 'nullable|string|max:20',

            'full_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'place_of_birth' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date',
            'blood_type' => 'nullable|in:A,B,AB,O',
            'religion' => 'nullable|string|max:50',
            'marital_status' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',

            'address' => 'nullable|string',
            'village' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',

            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relation' => 'nullable|string|max:50',
            'emergency_contact_phone' => 'nullable|string|max:20',
        ]);

        DB::transaction(function () use ($validated) {

            /**
             * 1️⃣ BUAT USER PASIEN
             * Password default (bisa diubah saat aktivasi)
             */
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => '123', // default RS
                'role_id' => 3, // contoh: ROLE_PATIENT
                'is_filled_biodata' => true,
            ]);

            /**
             * 2️⃣ BUAT BIODATA PASIEN
             */
            PatientBiodata::create([
                'user_id' => $user->id,

                'no_rm' => $validated['no_rm'],
                'nik' => $validated['nik'],
                'no_bpjs' => $validated['no_bpjs'] ?? null,

                'full_name' => $validated['full_name'],
                'gender' => $validated['gender'],
                'place_of_birth' => $validated['place_of_birth'] ?? null,
                'date_of_birth' => $validated['date_of_birth'] ?? null,
                'blood_type' => $validated['blood_type'] ?? null,
                'religion' => $validated['religion'] ?? null,
                'marital_status' => $validated['marital_status'] ?? null,

                'address' => $validated['address'] ?? null,
                'village' => $validated['village'] ?? null,
                'district' => $validated['district'] ?? null,
                'city' => $validated['city'] ?? null,
                'province' => $validated['province'] ?? null,

                'emergency_contact_name' => $validated['emergency_contact_name'] ?? null,
                'emergency_contact_relation' => $validated['emergency_contact_relation'] ?? null,
                'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
            ]);
        });

        return redirect()
            ->route('nurse.dashboard.index')
            ->with('success', 'Pasien berhasil diregistrasi oleh perawat.');
    }
}
