<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McategoryTraining extends Model
{
    use HasFactory;
    protected $table = 'm_category_training_course';
    protected $fillable = ['id','nama'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
