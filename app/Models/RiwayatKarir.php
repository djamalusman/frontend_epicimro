<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKarir extends Model
{
    use HasFactory;

    protected $table = 'riwayat_karir';

    protected $fillable = [
        'posisi_pekerjaan',
        'nama_perusahaan',
        'mulai_bekerja',
        'berakhir_bekerja',
        'masih_bekerja',
        'deskripsi',
    ];
}
