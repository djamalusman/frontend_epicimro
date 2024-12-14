<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobFileModel extends Model
{
    use HasFactory;
    //table name
    protected $table = 'm_job_vacancy_file';


    protected $fillable = ['id_job_vacancy_dtl', 'nama'];
}
