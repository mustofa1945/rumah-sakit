<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorPublicProfile extends Model
{
    // Tabel yang digunakan
    protected $table = 'doctor_public_profiles';

    // Primary key
    protected $primaryKey = 'id';

    // Mass assignment (kolom yang bisa diisi lewat create/update)
    protected $fillable = [
        'dokter_id',
        'full_name',
        'title_prefix',
        'title_suffix',
        'specialization',
        'sub_specialization',
        'education',
        'practice_experience_years',
        'str_number',
        'str_valid_until',
        'sip_number',
        'practice_schedule',
        'practice_location',
        'profile_photo',
        'biography',
        'is_active',
    ];

    // Casting kolom tertentu
    protected $casts = [
        'str_valid_until' => 'date',
        'is_active' => 'boolean',
        'practice_experience_years' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke tabel dokters (internal RS)
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
    
    // Scope untuk publik aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
