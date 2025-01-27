<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;

    protected $table = 'applyjob'; // Nama tabel jika tidak mengikuti konvensi Laravel

    protected $fillable = [
        'id',
        'idusers',
        'idexpectedsalary',
        'ideducation',
        'idworkexperience',
        'idjob',
        'cover_letter',
        'cv_path',
        'positionWork',
        'companyName',
        'startDateWork',
        'endDateWork',
        'stillWork',
        'writeskill',
        'status',
        'app_name',
        'server_type'
    ];
}
