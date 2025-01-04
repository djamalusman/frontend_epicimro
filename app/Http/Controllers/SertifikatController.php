<?php

namespace App\Http\Controllers;

use App\Models\SertifikatModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class SertifikatController extends Controller
{
    public function Index(Request $request)
    {
        $filters = $request->all();
        //dd($filters);


        $data['title'] = 'Certificate';

        $dataCount = SertifikatModel::where('status', 1)->get();
        $data['Count'] = $dataCount->count();
        $data['listSertifikat']=$dataCount;

       return view('template1/sertifikat.index', $data);

    }
    public function getData(Request $request)
    {
        $filters = $request->all();
        //dd($filters);
        $query = DB::table('d_sertifikat')
            ->where('no_sertifikat',$filters['jobtitle'])
            ->select(
                'd_sertifikat.*'

            );
        $whereData=$query->where('d_sertifikat.status',1);
        $perPage = 3;
        $page = $request->input('page', 1);
        $data = $whereData->paginate($perPage, ['*'], 'page', $page);

        // Calculate the range of the items shown
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());

        // Render the 'showing' view with the calculated range


        //$listfiles = JobFileModel::orderBy('nama', 'asc')->get();

        return response()->json([
            'content' => view('sertifikat.viewdata', ['data' => $data])->render(),
            'pagination' => view('template1/partials.pagination', ['data' => $data])->render(),

        ]);

    }
}
