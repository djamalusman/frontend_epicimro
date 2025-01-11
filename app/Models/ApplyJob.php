<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;

    protected $table = 'applyjob'; // Nama tabel jika tidak mengikuti konvensi Laravel

    protected $fillable = [
        'name',
        'idjob',
        'email',
        'address',
        'cv_path',
        'app_name',
        'server_type'
    ];
}
