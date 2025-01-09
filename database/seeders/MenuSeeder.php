<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Menu_client;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Header Dashboard
         Menu_client::create(['name' => 'Dashboard', 'is_header' => true]);

         // Menu Dashboard
         Menu_client::create(['name' => 'Dashboard', 'url' => '#', 'icon' => 'fas fa-fire']);

         // Header Data
         Menu_client::create(['name' => 'Data', 'is_header' => true]);

         // Menu Apply
         $apply = Menu_client::create(['name' => 'Apply', 'url' => '#', 'icon' => 'fas fa-columns']);

         // Sub-menu Apply
         Menu_client::create(['name' => 'Job', 'url' => 'layout-default.html', 'parent_id' => $apply->id]);
         Menu_client::create(['name' => 'Training', 'url' => 'layout-transparent.html', 'parent_id' => $apply->id]);
         Menu_client::create(['name' => 'Training Profesional', 'url' => 'layout-top-navigation.html', 'parent_id' => $apply->id]);
    }
}
