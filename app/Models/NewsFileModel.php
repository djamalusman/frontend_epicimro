<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsFileModel extends Model
{
    use HasFactory;
    //table name
    protected $table = 'm_news_file';


    protected $fillable = ['id_news_dtl', 'nama'];
}
