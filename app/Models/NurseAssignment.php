<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseAssignment extends Model
{
    use HasFactory;

    protected $table = 'nurse_assignments';

    protected $fillable = [
        'nurse_id',
        'patient_id',
        'assigned_at',
        'note',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    /* ================= RELATIONS ================= */

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }

    // pasien (user)
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
