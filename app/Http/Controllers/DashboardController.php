<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil informasi pengguna dari sesi
        $email = session('email');
        
        // $user = User::where('email', $email)->first();
        // dd($user->name);
        // Contoh data tambahan untuk dashboard
        $data = [
            'user_name' => $email,
            'recent_activities' => [
                'Login terakhir pada ' . now()->format('d-m-Y H:i:s'),
                'Mengubah profil',
                'Mengakses laporan keuangan',
            ],
            'statistics' => [
                'total_users' => 100, // Ganti dengan data dari database
                'total_posts' => 50,  // Ganti dengan data dari database
                'active_sessions' => 10, // Ganti dengan data dari database
            ]
        ];

        // Tampilkan view dashboard dengan data
        return view('template2.dashboard.index', compact('data'));
    }
}
