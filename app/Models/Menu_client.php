<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_client extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'menus';

    // Field yang bisa diisi
    protected $fillable = [
        'name',         // Nama menu
        'url',          // URL menu
        'icon',         // Icon menu
        'parent_id',    // ID parent menu (untuk submenu)
        'order',        // Urutan tampilan menu
        'role',         // Role yang bisa mengakses (candidate/employee)
        'is_active',    // Status aktif/tidak
        'is_header'     // Apakah menu termasuk header
    ];
    public $incrementing = true;
    // Relasi untuk sub-menu
    public function children()
    {
        return $this->hasMany(menus::class, 'parent_id')->orderBy('order');
    }

    // Relasi ke parent menu
    public function parent()
    {
        return $this->belongsTo(menus::class, 'parent_id');
    }
}