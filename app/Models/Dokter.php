<?php

namespace App\Models;

use App\Models\User;
use App\Models\PatientHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $table = "dokters";

    protected $fillable = [
        'name',
        'poli_id',
        'schedule_day',
        'start_time',
        'end_time',
    ];


    // Relasi: Dokter belongs to Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

     public function user()
    {
        return $this->hasOne(User::class, 'dokter_id');
    }


    // Relasi: Dokter punya banyak Antrian
    public function antrian()
    {
        return $this->hasMany(Antrian::class);
    }

     public function patientHistories()
    {
        return $this->hasMany(PatientHistory::class, 'dokter_id');
    }

     public function revisions()
    {
        return $this->hasMany(PatientHistoryRevision::class, 'edited_by');
    }

    // Enum schedule_day (opsional, untuk validasi / helper)
    public const DAYS = [
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    ];
}
