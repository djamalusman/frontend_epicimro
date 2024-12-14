<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class LoadGlobalData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $dataTk = DB::table('ifg_pages_content')
        ->leftJoin('ifg_pages_side_list', 'ifg_pages_side_list.id_pages_content', '=', 'ifg_pages_content.id')
        ->select('ifg_pages_content.id', 'ifg_pages_side_list.id as id_side', 'ifg_pages_content.item_file', 'ifg_pages_content.item_file_2','ifg_pages_content.item_body', 'ifg_pages_content.item_link', 'ifg_pages_content.item_body_en', 'ifg_pages_side_list.side_list', 'ifg_pages_side_list.side_list_en', 'ifg_pages_content.item_title', 'ifg_pages_content.item_title_en')
        ->where('ifg_pages_content.id', '2480')
        ->where('ifg_pages_content.id_pages_content_order', '1')
        ->first();

        $datasosialmedia  = DB::table('d_socialmedia')
        ->join('m_category_sosialmedia', 'm_category_sosialmedia.id', '=', 'd_socialmedia.id_category')
        ->select('d_socialmedia.*','m_category_sosialmedia.nama as nama','m_category_sosialmedia.id as idsosialmedia')->orderBy('m_category_sosialmedia.id', 'asc')->limit(6)
        ->get();
        // dd($datasosialmedia);

        $home  = DB::table('d_banner')
        ->join('d_banner_detail', 'd_banner_detail.id_banner', '=', 'd_banner.id')
        ->select('d_banner_detail.file','d_banner.id_category','d_banner.id_menu')->orderBy('d_banner.updated_at', 'desc')->limit(6)
        ->where('d_banner.id_category', '33')
        ->get();

        $register = DB::table('ifg_pages_content')
        ->leftJoin('ifg_pages_side_list', 'ifg_pages_side_list.id_pages_content', '=', 'ifg_pages_content.id')
        ->select('ifg_pages_content.id', 'ifg_pages_side_list.id as id_side', 'ifg_pages_content.item_file', 'ifg_pages_content.item_file_2','ifg_pages_content.item_body', 'ifg_pages_content.item_link', 'ifg_pages_content.item_body_en', 'ifg_pages_side_list.side_list', 'ifg_pages_side_list.side_list_en', 'ifg_pages_content.item_title', 'ifg_pages_content.item_title_en')
        ->where('ifg_pages_content.id', '2483')
        ->where('ifg_pages_content.id_pages_content_order', '1')
        ->first();


        view()->share('home',$home);

        view()->share('register',$register);

        view()->share('socialmediafooter',$datasosialmedia);

        view()->share('dataTk', $dataTk);

            return $next($request);
    }
}

class LoadGlobalDatagalery
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $datagalerry  = DB::table('d_gallery')
        ->join('d_gallery_detail', 'd_gallery_detail.id_gallery', '=', 'd_gallery.id')
        ->select('d_gallery_detail.file','d_gallery.id_category','d_gallery.id_menu')->orderBy('d_gallery.updated_at', 'desc')->limit(6)
        // ->where('d_gallery.id_category', '31')
        // ->where('d_gallery.id_menu', '1')->orderBy('d_gallery.created_at', 'desc')->limit(6)
        ->get();


        view()->share('galerry',$datagalerry);

            return $next($request);
    }
}

class LoadGlobalDatayotube
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $datayotube  = DB::table('d_testimonials')
        ->join('d_testimonials_video', 'd_testimonials_video.id_testimoni', '=', 'd_testimonials.id')
        ->select('d_testimonials_video.url','d_testimonials.description','d_testimonials.id_category','d_testimonials.id_menu')->orderBy('d_testimonials.updated_at', 'desc')
        // ->where('d_testimonials.id_category', '30')
        // ->where('d_testimonials.id_menu', '1')->orderBy('d_testimonials.created_at', 'desc')->limit(6)
        ->get();

        $datayotubeDtNew  = DB::table('d_testimonials')
        ->join('d_testimonials_video', 'd_testimonials_video.id_testimoni', '=', 'd_testimonials.id')
        ->select('d_testimonials_video.url','d_testimonials.description','d_testimonials.id_category','d_testimonials.id_menu')->orderBy('d_testimonials.updated_at', 'desc')->limit(1)
        // ->where('d_testimonials.id_category', '30')
        // ->where('d_testimonials.id_menu', '1')->orderBy('d_testimonials.created_at', 'desc')->limit(6)
        ->get();

        view()->share('yotube',$datayotube);
        view()->share('datayotubeDtNew',$datayotubeDtNew);
            return $next($request);
    }
}
