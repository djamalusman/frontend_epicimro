<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SideListModel;
use App\Models\ListItemModel;
use App\Models\ListItemDetail;
use App\Models\UpcomingTraining;
use App\Models\UpcomingJobVacancy;
use App\Models\UpcomingNews;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class GeneralController extends Controller
{
    public function fetchUpcomingTrainings()
    {
        $trainings = UpcomingTraining::orderBy('updated_at', 'desc')->limit(3)->get();
        return view('partials.upcoming_trainings', compact('trainings'))->render();
    }

    public function fetchUpcomingJobvacancy()
    {
        $job_vacancy = UpcomingJobVacancy::orderBy('updated_at', 'desc')->limit(4)->get();
        return view('partials.upcoming_job_vacancy', compact('job_vacancy'))->render();
    }

    public function fetcUpcominghNews()
    {
        $news = UpcomingNews::orderBy('updated_at', 'desc')->limit(6)->get();
        return view('partials.upcoming_news', compact('news'))->render();
    }

    public function privieProvinsiTop(Request $request)
    {
        $provinsi = DB::table('m_provinsi')->get();

        return response()->json($provinsi);
    }

    public function statusCourse(Request $request)
    {
        $Status = DB::table('m_status')->get();

        return response()->json($Status);
    }
}
