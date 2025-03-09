<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YoutubeTestimonial extends Model
{
    use HasFactory;
    protected $table = 'view_youtube'; // Nama view di database
    public $timestamps = false; // View tidak memiliki timestamps
}
