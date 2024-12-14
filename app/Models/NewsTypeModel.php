<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTypeModel extends Model
{
    use HasFactory;
    //table name
    protected $table = 'news_type';


    protected $fillable = ['id', 'nama'];
}
