<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseRecord extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'nurse_records';

    // Mass assignable
    protected $fillable = [
        'nurse_id',
        'patient_id',
        'record_date',
        'shift',
        'vital_signs',
        'medications_given',
        'observations',
        'notes',
    ];

    // Casts
    protected $casts = [
        'vital_signs' => 'array', // JSON otomatis diubah ke array
        'record_date' => 'date',
    ];

    /**
     * Relasi ke Nurse
     */
    public function nurse()
    {
        return $this->belongsTo(Nurse::class, 'nurse_id');
    }

    /**
     * Relasi ke Patient (User)
     */
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
