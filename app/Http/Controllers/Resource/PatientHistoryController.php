<?php

namespace App\Http\Controllers\Resource;

use App\Models\Dokter;
use App\Models\User;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Models\PatientBiodata;
use App\Models\PatientHistory;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PatientHistoryController extends Controller
{
    /**
     * Menampilkan detail pasien + timeline riwayat medis
     * URL: /admin/patients/{patient}/histories
     */
    public function index(User $patient)
    {
        // Ambil user pasien
        $user = User::where('id', $patient->id)
            ->whereHas('role', function ($q) {
                $q->where('name', 'patient');
            })
            ->firstOrFail();

        // Ambil biodata pasien (UNTUK HEADER)
        $biodata = PatientBiodata::where('user_id', $user->id)
            ->firstOrFail();

        // Ambil semua riwayat medis pasien
        $histories = PatientHistory::with([
            'dokter'
        ])
            ->where('user_id', $user->id)
            ->orderBy('tanggal_kunjungan', 'desc')
            ->get();

        // Cek apakah dokter sudah mencatat riwayat hari ini
        $today = Carbon::today()->toDateString();

        $dokterSudahMencatat = PatientHistory::where('user_id', $user->id) // pasien
            ->where('dokter_id', Auth::user()->dokter_id) // dokter saat ini
            ->whereDate('created_at', $today) // hanya hari ini
            ->first(); // true jika ada record

        return view('pages.admin.patient-medical-history', compact(
            'user',
            'biodata',
            'histories',
            'dokterSudahMencatat'
        ));
    }

    public function create($userId)
    {
        // Pastikan user adalah pasien
        $user = User::where('id', $userId)
            ->whereHas('role', fn($q) => $q->where('name', 'patient'))
            ->firstOrFail();


        /**
         * Ambil antrian AKTIF pasien
         * (menyesuaikan blade kamu: $antrian->user, dokter, nomor_antrian)
         */
        $antrian = Antrian::with(['user', 'dokter'])
            ->where('user_id', $user->id)
            ->where('status', 'CALLED')
            ->orderBy('created_at', 'asc')
            ->firstOrFail();

        $today = Carbon::today()->toDateString();

        $history = PatientHistory::where('user_id', $userId)
            ->where('dokter_id', Auth::user()->dokter_id)
            ->whereDate('tanggal_kunjungan', $today)
            ->first();

        // Jika sudah ada → redirect ke edit
        if ($history) {
            return redirect()->route(
                'admin.patients.histories.edit',
                ['history' => $history->id]
            );
        }


        return view('pages.admin.new-visit', compact('antrian'));
    }

    public function edit(PatientHistory $history)
    {
        //
        $antrian = Antrian::with(['user', 'dokter'])
            ->where('user_id', $history->user_id)
            ->where('dokter_id' , Auth::user()->dokter_id)
            ->where('status', 'DONE') 
            ->orderBy('created_at', 'asc')
            ->firstOrFail();

        // keamanan: dokter hanya boleh edit miliknya
        abort_if(
            $history->dokter_id !== Auth::user()->dokter_id,
            403
        );

        return view('pages.admin.new-visit', compact('history' , 'antrian'));
    }


    /**
     * Menyimpan kunjungan baru (button "Kunjungan Baru")
     */
    public function store(Request $request, $user)
    {

        // Pastikan user valid (pasien)
        $user = User::where('id', $user)
            ->whereHas('role', fn($q) => $q->where('name', 'patient'))
            ->firstOrFail();

        // Validasi sesuai field di form
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'dokter_id' => 'required|exists:dokters,id',
            'tanggal_kunjungan' => 'required|date',
            'nomor_antrian' => 'required|integer',
            'keluhan' => 'required|string',
            'diagnosa' => 'nullable|string',
            'tindakan' => 'nullable|string',
            'resep' => 'nullable|string',
            'status' => 'required|in:DONE,EMERGENCY,CANCELED',
        ]);


        // Keamanan: pastikan user_id dari form == user di URL
        if ((int) $validated['user_id'] !== (int) $user->id) {
            abort(403, 'Akses tidak valid');
        }

        // Simpan rekam medis
        PatientHistory::create([
            'user_id' => $validated['user_id'],
            'dokter_id' => $validated['dokter_id'],
            'tanggal_kunjungan' => $validated['tanggal_kunjungan'],
            'nomor_antrian' => $validated['nomor_antrian'],
            'keluhan' => $validated['keluhan'],
            'diagnosa' => $validated['diagnosa'],
            'tindakan' => $validated['tindakan'],
            'resep' => $validated['resep'],
            'status' => $validated['status'],
        ]);

        // (OPSIONAL tapi sangat disarankan)
        // Update status antrian → DONE
        Antrian::where('user_id', $user->id)
            ->where('nomor_antrian', $validated['nomor_antrian'])
            ->update(['status' => 'DONE']);

        return redirect()
            ->route('patients.histories.index', $user->id)
            ->with('success', 'Rekam medis berhasil disimpan');
    }

    /**
     * Tandai emergency (aksi cepat)
     */
    public function emergency(PatientHistory $history)
    {
        $history->update([
            'status' => PatientHistory::STATUS_EMERGENCY,
        ]);

        return back()->with('warning', 'Pasien ditandai sebagai EMERGENCY');
    }
}
