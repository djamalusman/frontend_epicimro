<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'certifications_candidate';
    
    protected $fillable = [
        'user_id',
        'namesertifikat',
        'issuing_organization',
        'credential_id',
        'issue_date',
        'expiration_date',
        'has_expiration',
        'descriptioncertifications'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiration_date' => 'date',
        'has_expiration' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
