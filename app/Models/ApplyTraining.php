<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyTraining extends Model
{
    use HasFactory;

    protected $table = 'tr_applytraining'; // Nama tabel jika tidak mengikuti konvensi Laravel

    // Menghilangkan 'id' dari $fillable karena auto-increment
    protected $fillable = [
       
        'idcompany',
        'idusers',
        'idtraining',
        'status',
        'app_name',
        'server_type'
    ];

    // Jika kamu ingin memastikan Laravel mengenali kolom id sebagai auto-increment,
    // kamu bisa menggunakan $incrementing
    public $incrementing = true;
}
