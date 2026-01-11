<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Halaman dashboard dokter
     */
    public function index()
    {
        $today = Carbon::today();

        $user = Auth::user();

        // Pastikan user punya relasi dokter
        if (!$user->dokter) {
            abort(403, 'Akun ini tidak terhubung dengan dokter.');
        }

        // Ambil antrian HARI INI khusus dokter yang login
        $antrians = Antrian::with([
                'user',
                'dokter.poli'
            ])
            ->where('dokter_id', $user->dokter->id)
            ->whereDate('tanggal_kunjungan', $today)
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        

        return view('pages.admin.dashboard', compact('antrians'));
    }
}
