<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MapsModel;

class ContactCotroller extends Controller
{
    public function contact()
    {
        $data['title'] = 'Traning Kerja | Visi Misi';

        // $data['dataTk']  = SideListModel::where('id_menu', 4)->where('id_pages_content_order', '1')->first();
        // $data['dataItem']  = ListItemModel::where('id_menu', 4)->where('id_pages_content_order', '1')->first();
        $data['locations']       = MapsModel::get();
        return view('contact', $data);
    }
}
