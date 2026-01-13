<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseSchedule extends Model
{
    use HasFactory;

    protected $table = 'nurse_schedules';

    protected $fillable = [
        'nurse_id',
        'shift',
        'date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /* ================= RELATIONS ================= */

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
