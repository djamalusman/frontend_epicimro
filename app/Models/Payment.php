<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments'; // Nama tabel

    protected $fillable = [
        'idtraining',
        'idusers',
        'idaccount_transfer',
        'amount',
        'payment_proof',
        'status',
    ];
    public $incrementing = true;
}
