<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $table = 'bank_accounts'; // Nama tabel

    protected $fillable = [
        'name',
        'account_number',
        'bank_name',
        'status',
        'notes',
    ];
}