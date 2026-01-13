<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $table = "polis";
    protected $fillable = [
        'name',
    ];

    // Relasi: Poli punya banyak Dokter
    public function dokters()
    {
        return $this->hasMany(Dokter::class);
    }

    // Poli.php
    public function nurses()
    {
        return $this->hasMany(Nurse::class);
    }

}
