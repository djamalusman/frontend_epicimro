<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu_client;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class WelcomeController extends Controller
{
    // public function welcome()
    // {
    //     $query = DB::table('m_provinsi')
    //         ->select(
    //             'm_provinsi.nama as namaprovinsi',
    //             'm_provinsi.id as idprovinsi',

    //         );
    //     $data['getDtProvinsi']=$query->get();

    //     $sponsor = DB::table('d_cooperation')
    //         ->select(
    //             'd_cooperation.*'

    //         );
    //     $data['sponsor']=$sponsor->get();

    //     $query = DB::table('news_detail')
    //     ->join('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
    //     ->select('news_detail.*', 'm_news.nama as category') ;
    //     $data ['news'] = $query->where('news_detail.status',1)->orderBy('news_detail.updated_at', 'desc')->limit(6)->get();

    //     // $email = session('email');
    //     //  dd($email);

    //     return view('welcome',$data);
    // }
    public function welcome()
    {
        // Ambil role user yang sedang login
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
        //dd($role);
        // Ambil menu berdasarkan role dengan menghindari duplikasi
        $menus = Menu_client::where(function($query) use ($role) {
            if ($role == 'candidate') {
                $query->where('role', $role);
                
            } else {
                $query->where('role', ['guest']);
            }
        })
        ->where('is_active', true)
        ->orderBy('order')
        ->distinct() // Menghindari duplikasi jika ada menu yang berlaku untuk multiple roles
        ->get();

        // Ambil data provinsi
        $getDtProvinsi = DB::table('m_provinsi')
            ->select('m_provinsi.nama as namaprovinsi', 'm_provinsi.id as idprovinsi')
            ->get();

        // Ambil data sponsor
        $sponsor = DB::table('d_cooperation')
            ->select('d_cooperation.*')
            ->get();

        // Ambil data berita
        $news = DB::table('news_detail')
            ->join('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
            ->select('news_detail.*', 'm_news.nama as category')
            ->where('news_detail.status', 1)
            ->orderBy('news_detail.updated_at', 'desc')
            ->limit(6)
            ->get();

        return view('welcome', compact('menus', 'getDtProvinsi', 'sponsor', 'news'));
    }


}
