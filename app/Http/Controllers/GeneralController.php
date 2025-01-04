<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SideListModel;
use App\Models\ListItemModel;
use App\Models\ListItemDetail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
class GeneralController extends Controller
{
    public function fetchUpcomingTrainings()
    {
        $query = DB::table('dtc_training_course_detail')
        ->leftJoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course')
        ->leftJoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course')
        ->leftJoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
        ->leftJoin('m_provinsi', 'm_provinsi.id', '=', 'dtc_training_course_detail.id_provinsi')
        ->leftJoin(DB::raw('(
            SELECT *
            FROM dtc_file_training_course
            WHERE id IN (
                SELECT MIN(id)
                FROM dtc_file_training_course
                GROUP BY id_training_course_dtl
            )
        ) AS dtc_file_training_course'), 'dtc_file_training_course.id_training_course_dtl', '=', 'dtc_training_course_detail.id')
        ->select(
            'dtc_training_course_detail.*',
            'm_category_training_course.nama as category',
            'm_jenis_sertifikasi_training_course.nama as cetificate_type',
            'm_provinsi.nama as nama_provinsi',
            'm_type_training_course.nama as namaonlineofline',
            'dtc_file_training_course.nama as image_path'
        );

        $trainings = $query->orderBy('dtc_training_course_detail.updated_at', 'desc')->limit(3)->get();

        return view('template1/partials.upcoming_trainings', compact('trainings'))->render();
    }

    public function fetchUpcomingJobvacancy()
    {
        $query = DB::table('djv_job_vacancy_detail')
            ->leftJoin('m_employee_status', 'djv_job_vacancy_detail.id_m_employee_status', '=', 'm_employee_status.id')
            ->leftJoin('m_work_location', 'm_work_location.id', '=', 'djv_job_vacancy_detail.id_m_work_location')
            ->leftJoin('m_salary_date_month', 'm_salary_date_month.id', '=', 'djv_job_vacancy_detail.id_m_salaray_date_mont')
            ->leftJoin('m_salary', 'm_salary.id', '=', 'djv_job_vacancy_detail.id_m_salaray')
            ->leftJoin('m_sector', 'm_sector.id', '=', 'djv_job_vacancy_detail.id_m_sector')
            ->leftJoin('m_education', 'm_education.id', '=', 'djv_job_vacancy_detail.id_m_education')
            ->leftJoin('m_experience_level', 'm_experience_level.id', '=', 'djv_job_vacancy_detail.id_m_experience_level')
            ->leftJoin('m_provinsi', 'm_provinsi.id', '=', 'djv_job_vacancy_detail.id_provinsi')
            ->select(
                'djv_job_vacancy_detail.*',
                'm_employee_status.nama as nama_status',
                'm_work_location.nama as work_location',
                'm_salary_date_month.nama as fee',
                'm_salary.nama as salary',
                'm_sector.nama as sector',
                'm_education.nama as education',
                'm_experience_level.nama as name_experience_level',
                'm_provinsi.nama as namaprovinsi'
            );
        $job_vacancy = $query->orderBy('djv_job_vacancy_detail.updated_at', 'desc')->limit(4)->get();

        return view('template1/partials.upcoming_job_vacancy', compact('job_vacancy'))->render();
    }

    public function fetcUpcominghNews()
    {

        $query = DB::table('news_detail')
            ->join('m_news', 'm_news.id', '=', 'news_detail.id_m_news')
            ->select('news_detail.*', 'm_news.nama as category') ;
        $news = $query->where('news_detail.status',1)->orderBy('news_detail.updated_at', 'desc')->limit(6)->get();
        return view('template1/partials.upcoming_news', compact('news'))->render();
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
