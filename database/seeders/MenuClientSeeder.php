<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu_client;

class MenuClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            // Menu default untuk guest (tanpa login)
        Menu_client::create([
            'name' => 'Home',
            'url' => '/',
            'icon' => 'fas fa-home',
            'role' => 'guest',
            'order' => 1,
            'is_active' => true
        ]);

        Menu_client::create([
            'name' => 'Training',
            'url' => '/training',
            'icon' => 'fas fa-book',
            'role' => 'guest',
            'order' => 2,
            'is_active' => true
        ]);

        Menu_client::create([
            'name' => 'Jobs',
            'url' => '/job-grid',
            'icon' => 'fas fa-briefcase',
            'role' => 'guest',
            'order' => 3,
            'is_active' => true
        ]);

        Menu_client::create([
            'name' => 'News',
            'url' => '/news',
            'icon' => 'fas fa-newspaper',
            'role' => 'guest',
            'order' => 4,
            'is_active' => true
        ]);

        Menu_client::create([
            'name' => 'Certificate',
            'url' => '/certificate',
            'icon' => 'fas fa-certificate',
            'role' => 'guest',
            'order' => 5,
            'is_active' => true
        ]);

        Menu_client::create([
            'name' => 'Sign in',
            'url' => '/login',
            'icon' => 'fas fa-sign-in-alt',
            'role' => 'guest',
            'order' => 6,
            'is_active' => true,
            'button_class' => 'btn btn-default ml-50'
        ]);

        // Menu khusus untuk candidate
        Menu_client::create([
            'name' => 'Profile',
            'url' => '/profile',
            'icon' => 'fas fa-user',
            'role' => 'candidate',
            'order' => 1,
            'is_active' => true
        ]);

        // Menu khusus untuk employee
        Menu_client::create([
            'name' => 'Apply Data',
            'url' => '/apply-data',
            'icon' => 'fas fa-file-alt',
            'role' => 'employee',
            'order' => 1,
            'is_active' => true
        ]);
    }
}
