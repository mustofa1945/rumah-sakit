<?php

namespace App\Models;

use App\Models\Dokter;
use App\Models\PatientBiodata;
use App\Models\PatientHistory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = "users";


    protected $fillable = [
        'name',
        'email',
        'password',
        "role_id",
        'is_filled_biodata'
    ];

    protected $casts = [
        'is_filled_biodata' => 'boolean',
    ];

    protected $hidden = [
        'password',
    ];

    // Relasi: User bisa punya banyak antrian
    public function antrian()
    {
        return $this->hasMany(
            Antrian::class
        );
    }
    public function patientBiodata()
    {
        // 1 user → 1 patient biodata
        return $this->hasOne(PatientBiodata::class);
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function patientHistories()
    {
        return $this->hasMany(PatientHistory::class, 'user_id');
    }

    public function bpjs()
    {
        return $this->hasOne(BpjsInformation::class, 'user_id');
    }
}
