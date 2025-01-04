<?php

namespace App\Http\Controllers;
use App\Models\SideListModel;
use App\Models\ListItemModel;
use App\Models\ListItemDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class AboutController extends Controller
{
    public function visiMisi()
    {
        $data['title_parent'] = 'Work training';
        $data['title_child'] = 'Vision and mission';

        $data['dataVisi']  = SideListModel::where('id_menu', 4)->where('id_pages_content_order', '1')->first();
        $data['datalistVisimisi']  = ListItemDetail::where('id_side_list', 4)->get();
        return view('template1/about.visimisi', $data);
    }

    public function companyBrief()
    {
        $data['title_parent'] = 'Work training';
        $data['title_child'] = 'Company Brief';

        $data['dataItem']  = DB::table('ifg_pages_content')
        ->leftjoin('ifg_pages_side_list', 'ifg_pages_side_list.id_pages_content', '=', 'ifg_pages_content.id')
        ->select('ifg_pages_content.id', 'ifg_pages_side_list.id as id_side', 'ifg_pages_content.item_file', 'ifg_pages_content.item_body', 'ifg_pages_content.item_body_en', 'ifg_pages_side_list.side_list', 'ifg_pages_side_list.side_list_en', 'ifg_pages_content.item_title', 'ifg_pages_content.item_title_en')
        ->where('ifg_pages_content.id_menu', '3')
        ->where('ifg_pages_content.id_pages_content_order', '1')
        ->first();
        return view('template1/about.company-brief', $data);
    }
}
