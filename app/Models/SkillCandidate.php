<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillCandidate extends Model
{
    use HasFactory;
    protected $table = 'skills_candidate';
    protected $fillable = ['user_id', 'skill_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

