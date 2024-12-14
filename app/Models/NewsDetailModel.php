<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsDetailModel extends Model
{
    use HasFactory;
    //table name
    protected $table = 'news_detail';


    protected $fillable = ['id_m_news', 'title','implementation_date','description'];
}
