<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu_client;
use Illuminate\Support\Facades\Auth;

class MenuManagementController extends Controller
{
    // Ambil menu berdasarkan role
    public function getMenuByRole($role)
    {
        return Menu_client::where('role', $role)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }
    
    public function getDefaultMenu()
    {
        return Menu_client::where('role', 'guest')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}