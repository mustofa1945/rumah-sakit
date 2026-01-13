<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminRegistration extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'admin_registrations';

    // Mass assignable
    protected $fillable = [
        'user_id',
        'full_name',
        'nik',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'religion',
        'phone',
        'address',
        'position',
        'education_level',
        'shift',
        'status',
    ];

    // Casts
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Relasi ke akun User (login Laravel)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Helper: tampilkan nama lengkap + shift
     */
    public function displayNameWithShift()
    {
        return $this->full_name . ' (' . ucfirst($this->shift) . ')';
    }
}
