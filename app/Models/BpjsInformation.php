<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BpjsInformation extends Model
{
    protected $table = 'bpjs_informations';

    protected $fillable = [
        'user_id',
        'nomor_kartu',
        'nik',
        'nama_peserta',
        'kelas',
        'jenis_peserta',
        'faskes_tingkat_1',
        'status_kepesertaan',
        'tanggal_aktif',
        'tanggal_nonaktif',
    ];

    /**
     * Relasi ke User
     * 1 BPJS dimiliki oleh 1 User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
