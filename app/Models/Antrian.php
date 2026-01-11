<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = "antrians";

    protected $fillable = [
        'user_id',
        'dokter_id',
        'tanggal_kunjungan',
        'nomor_antrian',
        'keluhan',
        'status',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
    ];

    // Enum status
    public const STATUS_WAITING = 'WAITING';
    public const STATUS_CALLED = 'CALLED';
    public const STATUS_DONE = 'DONE';
    public const STATUS_CANCELED = 'CANCELED';

    public static function statuses(): array
    {
        return [
            self::STATUS_WAITING,
            self::STATUS_CALLED,
            self::STATUS_DONE,
            self::STATUS_CANCELED,
        ];
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Dokter
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
