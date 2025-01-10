<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Menu_client;
class Menu_client extends Model
{
    use HasFactory;
     protected $table = 'menus';


     protected $fillable = ['name', 'url', 'icon', 'parent_id', 'order', 'is_header'];

     // Relasi untuk sub-menu
     public function children()
     {
         return $this->hasMany(Menu_client::class, 'parent_id')->orderBy('order');
     }
}
