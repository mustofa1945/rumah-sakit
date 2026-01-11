<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PatientBiodata extends Model
{
    use HasFactory;

    // Nama tabel, opsional jika sesuai konvensi laravel
    protected $table = 'patient_biodatas';

    // Mass assignment
    protected $fillable = [
        'user_id',
        'no_rm',
        'nik',
        'no_bpjs',
        'full_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'blood_type',
        'religion',
        'marital_status',
        'address',
        'village',
        'district',
        'city',
        'province',
        'postal_code',
        'phone',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relation',
    ];

    // Cast tipe data
    protected $casts = [
        'date_of_birth' => 'date',
        'gender' => 'string',
        'blood_type' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel users (1 patient = 1 user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Optional helper: umur pasien
     */
    public function getAgeAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->age : null;
    }
}
