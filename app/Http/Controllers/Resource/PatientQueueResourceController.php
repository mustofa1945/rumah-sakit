<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Dokter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class PatientQueueResourceController extends Controller
{
    /**
     * Menampilkan halaman konfirmasi antrian
     */
    public function create(Request $request)
    {
        $request->session()->put('antrian_prev_url', url()->previous());
        if (!Auth::user()->is_filled_biodata) {
            return redirect()->route('profile.index')->with('message', 'Tolong isi biodata terlebih dahulu');
        }
        $dokter = Dokter::with('poli')
            ->findOrFail($request->dokter_id);

        return view('pages.queue-form', compact('dokter'));
    }

    /**
     * Menyimpan antrian baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => ['required', 'exists:dokters,id'],
            'keluhan' => ['nullable', 'string'],
        ]);

        $userId = Auth::id();
        $dokterId = $request->dokter_id;
        $tanggal = Carbon::today()->toDateString();

        // Cegah user ambil antrian ganda di hari yang sama
        $sudahAda = Antrian::where('user_id', $userId)
            ->where('dokter_id', operator: $dokterId)
            ->where('tanggal_kunjungan', $tanggal)
            ->exists();

        if ($sudahAda) {
            return back()->withErrors([
                'antrian' => 'Anda sudah mengambil antrian untuk dokter ini hari ini.'
            ]);
        }

        DB::transaction(function () use ($userId, $dokterId, $tanggal, $request) {

            // Ambil nomor antrian terakhir hari ini
            $lastNumber = Antrian::where('dokter_id', $dokterId)
                ->where('tanggal_kunjungan', $tanggal)
                ->max('nomor_antrian');

            Antrian::create([
                'user_id' => $userId,
                'dokter_id' => $dokterId,
                'tanggal_kunjungan' => $tanggal,
                'nomor_antrian' => ($lastNumber ?? 0) + 1,
                'keluhan' => $request->keluhan,
                'status' => 'WAITING',
            ]);
        });

        return redirect()
            ->route('poli.index')
            ->with('success', 'Antrian berhasil diambil. Silakan menunggu panggilan.');
    }

    /**
     * (Opsional) Daftar antrian user
     */
    public function index()
    {
        $userId = Auth::id();
        // Ambil antrian user hari ini yang statusnya masih WAITING atau CALLED
        $antrians = Antrian::with(['dokter.poli'])
            ->where('user_id', $userId)
            ->where('tanggal_kunjungan', Carbon::today()->toDateString())
            ->whereIn('status', ['WAITING', 'CALLED'])
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        return view('pages.active-queue', compact('antrians'));
    }

    public function nextStatus(Request $request, Antrian $id)
    {
        $request->validate([
            'status' => 'required|in:CALLED,DONE,CANCELED',
        ]);

        $current = $id->status;
        $next = $request->status;

        // Matrix transisi status yang diizinkan
        $allowedTransitions = [
            'WAITING' => ['CALLED', 'CANCELED'],
            'CALLED' => ['DONE', 'CANCELED'],
        ];

        if (
            !isset($allowedTransitions[$current]) ||
            !in_array($next, $allowedTransitions[$current])
        ) {
            return back()->with('error', 'Perubahan status tidak valid');
        }

        $id->update([
            'status' => $next,
        ]);

        return back()->with('success', 'Status antrian berhasil diperbarui');
    }



}
