<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users_client';  // Tentukan nama tabel jika berbeda
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];
}
