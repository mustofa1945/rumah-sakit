<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientHistory extends Model
{
    use HasFactory;

    protected $table = 'patient_histories';

    protected $fillable = [
        'user_id',
        'dokter_id',
        'tanggal_kunjungan',
        'nomor_antrian',
        'keluhan',
        'diagnosa',
        'tindakan',
        'resep',
        'status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    /**
     * =====================
     * CONSTANTS
     * =====================
     */
    public const STATUS_DONE      = 'DONE';
    public const STATUS_CANCELED  = 'CANCELED';
    public const STATUS_EMERGENCY = 'EMERGENCY';

    /**
     * =====================
     * RELATIONS
     * =====================
     */

    // Pasien
    public function patient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Dokter yang menangani
    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * =====================
     * SCOPES (optional tapi berguna)
     * =====================
     */

    public function scopeToday($query)
    {
        return $query->whereDate('tanggal_kunjungan', now()->toDateString());
    }

    public function scopeByDokter($query, int $dokterId)
    {
        return $query->where('dokter_id', $dokterId);
    }

    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }
}
