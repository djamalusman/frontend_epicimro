<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accounts_transfer extends Model
{
    use HasFactory;

    protected $table = 'accounts_transfer'; // Nama tabel

    protected $fillable = [
        'idbank',
        'nama',
        'nomor_rekening	',
        'status	',
    ];
}

