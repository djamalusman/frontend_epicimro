<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;

    protected $table = 'tr_applyjob'; // Nama tabel jika tidak mengikuti konvensi Laravel

    // Menghilangkan 'id' dari $fillable karena auto-increment
    protected $fillable = [
        'id_employee',
        'idusers',
        'idjob',
        'status',
        'app_name',
        'server_type'
    ];

    // Jika kamu ingin memastikan Laravel mengenali kolom id sebagai auto-increment,
    // kamu bisa menggunakan $incrementing
    public $incrementing = true;
}
