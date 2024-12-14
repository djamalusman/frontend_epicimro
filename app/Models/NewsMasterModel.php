<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsMasterModel extends Model
{
    use HasFactory;
    //table name
    protected $table = 'm_news';


    protected $fillable = ['id', 'nama'];
}