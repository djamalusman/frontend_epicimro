<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class WelcomeController extends Controller
{
    public function welcome()
    {
        $query = DB::table('m_provinsi')
            ->select(
                'm_provinsi.nama as namaprovinsi',
                'm_provinsi.id as idprovinsi',

            );
        $data['getDtProvinsi']=$query->get();

        $sponsor = DB::table('d_cooperation')
            ->select(
                'd_cooperation.*'

            );
        $data['sponsor']=$sponsor->get();

        $query = DB::table('news_detail')
        ->join('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
        ->select('news_detail.*', 'm_news.nama as category') ;
        $data ['news'] = $query->where('news_detail.status',1)->orderBy('news_detail.updated_at', 'desc')->limit(6)->get();




        return view('template1.welcome',$data);
    }
}
