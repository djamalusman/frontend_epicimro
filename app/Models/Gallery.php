<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'view_gallery'; // Nama view di database
    public $timestamps = false; // View tidak memiliki timestamps
}
