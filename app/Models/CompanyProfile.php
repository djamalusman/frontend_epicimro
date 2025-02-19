<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $table = 'company_profiles';

    protected $fillable = [
        'user_id',
        'company_name',
        'company_address',
        'provinsi_id',
        'sector_id',
        'company_email',
        'phone_number',
        'company_overview'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
