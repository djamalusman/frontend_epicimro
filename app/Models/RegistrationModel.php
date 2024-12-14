<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationModel extends Model
{
    use HasFactory;
    //table name
    protected $table = 'd_registration';
    //primary key
    protected $primaryKey = 'id';
    //set auto incrementing for PK
    public $incrementing = true;

    protected $fillable = [ 'file','url','nama_registration','status','insert_by', 'updated_by','updated_by_ip','status'];
}

