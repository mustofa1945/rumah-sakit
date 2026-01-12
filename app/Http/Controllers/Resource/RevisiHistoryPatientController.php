<?php

namespace App\Http\Controllers\Resource;

use App\Models\PatientHistory;
use App\Models\PatientHistoryRevision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RevisiHistoryPatientController extends Controller
{
    /**
     * Tampilkan form revisi untuk satu patient history
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        // Ambil patient history beserta data user
        $history = PatientHistory::with('user')->findOrFail($id);

        return view('pages.admin.revisi-rekap', compact('history'));
    }

    /**
     * Simpan revisi baru
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {


        // Validasi input
        $request->validate([
            'patient_history_id' => 'required|exists:patient_histories,id',
            'field_name'         => 'required|string|in:diagnosa,tindakan,resep',
            'old_value'          => 'nullable|string',
            'new_value'          => 'required|string',
            'edit_reason'        => 'required|string',
            'edited_by'          => 'required|exists:dokters,id',
        ]);

        // Buat revisi baru
        PatientHistoryRevision::create([
            'patient_history_id' => $request->patient_history_id,
            'field_name'         => $request->field_name,
            'old_value'          => $request->old_value,
            'new_value'          => $request->new_value,
            'edit_reason'        => $request->edit_reason,
            'edited_by'          => $request->edited_by,
            'edited_at'          => Carbon::now(),
        ]);

          // Ambil history berdasarkan ID
        $history = PatientHistory::findOrFail($request->patient_history_id);

        // Ubah status menjadi pending NONE
        $history->update([
            'status_revision' => 'NONE',
             $request->field_name => $request->new_value,
             'status_rekap' => 'COMPLETE-REVISI'
        ]);
        // Redirect ke rekap medis dengan session message
        return redirect()->route('admin.rekap-medis')
                         ->with('success', 'Revisi data medis berhasil disimpan.');
    }

    
}
