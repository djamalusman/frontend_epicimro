<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu_client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UpcomingNews;
use App\Models\YoutubeTestimonial;
use App\Models\Gallery;

class WelcomeController extends Controller
{
   
    public function welcome()
    {
        $user = Auth::user();
        $role = $user ? $user->role : 'guest';

        $menus = Menu_client::where(function ($query) use ($role) {
            if (in_array($role, ['candidate', 'company'])) {
                $query->where('role', $role);
            } else {
                $query->where('role', 'guest');
            }
        })->where('is_active', true)->orderBy('order')->distinct()->get();

        $getDtProvinsi = DB::table('m_provinsi')->select('nama as namaprovinsi', 'id as idprovinsi')->get();
        $sponsor = DB::table('d_cooperation')->select('d_cooperation.*')->get();
        $news = UpcomingNews::orderBy('updated_at', 'desc')->limit(6)->get();

        // Jangan ambil Gallery & YouTube di sini!
        return view('welcome', compact('menus', 'getDtProvinsi', 'sponsor', 'news'));
    }

}
