<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;

    protected $table = 'nurses';

    protected $fillable = [
        'user_id',
        'nip',
        'full_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'religion',
        'phone',
        'address',
        'education_level',
        'license_number',
        'license_expired_at',
        'position',
        'poli_id',
        'shift',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'license_expired_at' => 'date',
    ];

    /* ================= RELATIONS ================= */

    // akun user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // poli / ruangan
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    // jadwal perawat
    public function schedules()
    {
        return $this->hasMany(NurseSchedule::class);
    }

    // penugasan ke pasien
    public function assignments()
    {
        return $this->hasMany(NurseAssignment::class);
    }

    public function nurseRecords()
    {
        return $this->hasMany(NurseRecord::class, 'nurse_id');
    }

  
}
