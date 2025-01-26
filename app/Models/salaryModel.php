<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class salaryModel extends Model
{
    use HasFactory;
    protected $table = 'm_salary';
    //primary key
    protected $primaryKey = 'id';
    //set auto incrementing for PK
    public $incrementing = true;

    protected $fillable = [ 'nama','insert_by', 'updated_by','updated_by_ip'];
}
