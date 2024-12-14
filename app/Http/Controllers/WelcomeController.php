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

        // $data['dataTk']  = DB::table('ifg_pages_content')
        // ->leftjoin('ifg_pages_side_list', 'ifg_pages_side_list.id_pages_content', '=', 'ifg_pages_content.id')
        // ->select('ifg_pages_content.id', 'ifg_pages_side_list.id as id_side', 'ifg_pages_content.item_file', 'ifg_pages_content.item_body','ifg_pages_content.item_link', 'ifg_pages_content.item_body_en', 'ifg_pages_side_list.side_list', 'ifg_pages_side_list.side_list_en', 'ifg_pages_content.item_title', 'ifg_pages_content.item_title_en')
        // ->where('ifg_pages_content.id', '2480')
        // ->where('ifg_pages_content.id_pages_content_order', '1')
        // ->first();

        // $data['galerry']  = DB::table('d_gallery')
        // ->leftjoin('d_gallery_detail', 'd_gallery_detail.id_gallery', '=', 'd_gallery.id')
        // ->select('d_gallery_detail.file')
        // ->where('d_gallery.id_category', '31')->orderBy('d_gallery.updated_at', 'desc')->limit(6)
        // ->get();

        

        return view('welcome',$data);
    }
}
