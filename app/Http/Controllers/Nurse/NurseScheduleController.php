<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use App\Models\NurseSchedule;
use Illuminate\Http\Request;

class NurseScheduleController extends Controller
{
    /**
     * Ubah status schedule berdasarkan ID dan status baru
     */
    public function updateStatus(Request $request)
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:nurse_schedules,id',
            'status' => 'required|in:PENDING,CONFIRMED,REJECTED'
        ]);

        // Ambil schedule
        $schedule = NurseSchedule::findOrFail($request->id);
   
        // Update status
        $schedule->status = $request->status ;
        $schedule->save();

        // Redirect ke dashboard dengan flash message
        return redirect()->route('nurse.dashboard.index')
            ->with('success', 'Status schedule berhasil diubah menjadi ' . $request->status);
    }
}
