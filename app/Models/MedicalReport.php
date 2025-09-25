<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalReport extends Model
{
    protected $fillable = [
        // Optional fields
        'tgl_periksa',
        'pasien',
        'dokter_pengirim',
        'jenis_pemeriksaan',
        'no_foto',
        'no_rm',
        'no_reg',
        'kel',
        'kamar_klinik',
        
        // Required fields
        'hasil_pemeriksaan',
        'dokter_pemeriksa',
        'nama_terang',
        'signature_path',
    ];

    protected $casts = [
        'tgl_periksa' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
