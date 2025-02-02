<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfTrainingModel extends Model
{
    use HasFactory;

    protected $table = 'tr_proftraining'; // Nama tabel dalam database
    


    protected $fillable = [
        'idusers',
        'id_m_bgrnd_deducation',
        'other_bgrnd_education',
        'id_m_education',
        'id_m_country',
        'residence',
        'idage',
        'id_m_experience_l',
        'id_d_sertifikat',
        'other_certification',
        'id_m_bidang',
        'id_m_sofware',
        'other_software',
        'id_m_trainner',
        'expected_fee_hour',
        'cvpath',
        'sertifikatpath',
        'fotopath',
        'status',
        'info',
        'opsion',
        'id_m_jobvacancy',
        'id_m_epc',
        'id_m_salary',
        'tunjangan',
        'portofoliopath',
        'id_m_prof_training',
        'created_at',
        'updated_at',
    ];
  public $incrementing = true;
}
