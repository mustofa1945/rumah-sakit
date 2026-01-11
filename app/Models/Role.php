<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = "roles";
    protected $fillable = [
        'name',
    ];

    // Relasi: Poli punya banyak Dokter
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
