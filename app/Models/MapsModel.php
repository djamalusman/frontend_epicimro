<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapsModel extends Model
{
    use HasFactory;
    //table name
    protected $table = 'd_maps';


    protected $fillable = ['id', 'nama','latitude','longitude','status'];
}
