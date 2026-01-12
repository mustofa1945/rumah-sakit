<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Antrian;
use App\Models\PatientHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as HttpRequest;

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

        $isHasCalledStatus = Antrian::where('status', 'CALLED', )
            ->whereDate('tanggal_kunjungan', $today)
            ->exists();


        return view('pages.admin.dashboard', compact('antrians', 'isHasCalledStatus'));
    }

    public function callNextPatient()
    {
        $dokterId = Auth::user()->dokter_id;

        $today = Carbon::today();

        // Ambil antrian paling awal (nomor_antrian terkecil)
        $antrian = Antrian::where('dokter_id', $dokterId)
            ->whereDate('tanggal_kunjungan', $today)
            ->where('status', 'WAITING')
            ->orderBy('nomor_antrian', 'asc')
            ->first();

        if (!$antrian) {
            return redirect()
                ->route('admin.dashboard')
                ->with('message', 'Tidak ada antrian pasien yang menunggu hari ini.');
        }

        // Update status menjadi CALLED
        $antrian->update([
            'status' => 'CALLED'
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('message', 'Pasien nomor antrian ' . $antrian->nomor_antrian . ' berhasil dipanggil.');
    }

    public function rekapMedis(HttpRequest $request)
    {
        $dokterId = Auth::user()->dokter_id;

        $query = PatientHistory::with('user')
            ->where('dokter_id', $dokterId);

        /**
         * 🔍 SEARCH: nama pasien
         */
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        /**
         * 🕒 TIME FILTER
         */
        switch ($request->timeFilter) {
            case 'today':
                $query->whereDate('tanggal_kunjungan', Carbon::today());
                break;

            case 'week':
                $query->whereBetween('tanggal_kunjungan', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
                break;

            case 'month':
                $query->whereMonth('tanggal_kunjungan', Carbon::now()->month)
                    ->whereYear('tanggal_kunjungan', Carbon::now()->year);
                break;

            case 'year':
                $query->whereYear('tanggal_kunjungan', Carbon::now()->year);
                break;
        }

        /**
         * 📊 ORDERING
         */
        $histories = $query
            ->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        return view('pages.admin.hasil-rekap-dokter', compact('histories'));
    }

    public function rekapMedisDefault()
    {
        $dokterId = Auth::user()->dokter_id;

        $histories = PatientHistory::with('user')
            ->where('dokter_id', $dokterId)
            ->orderBy('tanggal_kunjungan', 'desc')
            ->orderBy('nomor_antrian', 'asc')
            ->get();

        return view('pages.admin.hasil-rekap-dokter', compact('histories'));
    }
}
