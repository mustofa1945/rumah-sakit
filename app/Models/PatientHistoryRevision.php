<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientHistoryRevision extends Model
{
    // Tabel yang digunakan
    protected $table = 'patient_history_revisions';

    // Mass assignable
    protected $fillable = [
        'patient_history_id',
        'field_name',
        'old_value',
        'new_value',
        'edit_reason',
        'edited_by',
        'edited_at',
    ];

    // Cast edited_at ke Carbon instance
    protected $casts = [
        'edited_at' => 'datetime',
    ];

    /**
     * Relasi ke PatientHistory
     */
    public function patientHistory(): BelongsTo
    {
        return $this->belongsTo(PatientHistory::class);
    }

    /**
     * Relasi ke Dokter/Admin yang melakukan revisi
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'edited_by');
    }
}
