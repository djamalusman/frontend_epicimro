<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations_candidate';
    
    protected $fillable = [
        'user_id',
        'school_name',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'is_current',
        'description'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
