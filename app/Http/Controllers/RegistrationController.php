<?php

namespace App\Http\Controllers;

use App\Models\RegistrationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public function Index(Request $request)
    {
        $filters = $request->all();
        //dd($filters);


        $data['title'] = 'Registration';

        // $dataCount = RegistrationModel::where('status', 1)->get();
        // $data['Count'] = $dataCount->count();
        // $data['listRegistration'] = $dataCount;

       return view('registration.index', $data);

    }
}
