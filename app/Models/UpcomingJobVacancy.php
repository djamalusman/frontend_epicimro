<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingJobVacancy extends Model
{
    use HasFactory;
    protected $table = 'view_upcoming_job_vacancy'; // Nama view di database
    public $timestamps = false; // View tidak memiliki timestamps
}
