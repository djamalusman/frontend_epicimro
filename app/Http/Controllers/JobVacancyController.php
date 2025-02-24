<?php

namespace App\Http\Controllers;
use App\Models\JobVacancyDetailModel;
use App\Models\JobFileModel;
use App\Models\User;
use App\Models\ApplyJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu_client;
class JobVacancyController extends Controller
{
    public function JobList(Request $request)
    {
        $filters = $request->all();
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
        $menus = Menu_client::where(function($query) use ($role) {
            if ($role == 'candidate') {
                $query->where('role', $role);
                
            }elseif ($role == 'company') {
                $query->where('role', $role);
            } 
            else {
                $query->where('role', ['guest']);
            }
        })
        ->where('is_active', true)
        ->orderBy('order')
        ->distinct() // Menghindari duplikasi jika ada menu yang berlaku untuk multiple roles
        ->get();
        //dd($filters);
        $valuJobtitle = $filters['jobtitle'] ?? null;
        $valuLokasi = $filters['provinsi'] ?? null;

        $title = 'Jobs';

        $dataCount = JobVacancyDetailModel::where('status', 1)->get();
        $CountJob = $dataCount->count();
        $filter = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
         // Get all courses

       //return view('jobvacancy.joblist', $data);
       return view('jobvacancy.joblist', compact('title','menus', 'CountJob', 'valuJobtitle', 'valuLokasi','filter'));
    }

    public function JobGrid(Request $request)
    {
      
        $title = 'Jobs';
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
        $menus = Menu_client::where(function($query) use ($role) {
            if ($role == 'candidate') {
                $query->where('role', $role);
                
            }elseif ($role == 'company') {
                $query->where('role', $role);
            } 
            else {
                $query->where('role', ['guest']);
            }
        })
        ->where('is_active', true)
        ->orderBy('order')
        ->distinct() // Menghindari duplikasi jika ada menu yang berlaku untuk multiple roles
        ->get();

        $dataCount = JobVacancyDetailModel::where('status', 1)->get();

        $CountJob = $dataCount->count();

        $filter = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();

        return view('jobvacancy.jobgrid', compact('title','menus', 'dataCount', 'CountJob', 'filter'));

    }

    public function detailJob($id,$slug,Request $request)
    {

        $title = 'Details Jobs';
        $user = Auth::user();
        
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
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
        
        $userEmail = session('email');
        $UserCleint = User::where('email', $userEmail)->first();
        $getdtApplyJobs= ApplyJob::where('idjob', base64_decode($id))->first();
        if ($getdtApplyJobs !=null || $getdtApplyJobs !="") {
            $getdtApplyJob = User::where('id', $getdtApplyJobs->idusers)->first();
        }
        else
        {
            $getdtApplyJob=null;
        }
        
        //dd($data['getdtApplyJob']);
        $query = DB::table('djv_job_vacancy_detail')
            ->leftJoin('m_employee_status', 'djv_job_vacancy_detail.id_m_employee_status', '=', 'm_employee_status.id')
            ->leftJoin('m_work_location', 'm_work_location.id', '=', 'djv_job_vacancy_detail.id_m_work_location')
            ->leftJoin('m_salary_date_month', 'm_salary_date_month.id', '=', 'djv_job_vacancy_detail.id_m_salaray_date_mont')
            ->leftJoin('m_salary', 'm_salary.id', '=', 'djv_job_vacancy_detail.id_m_salaray')
            ->leftJoin('m_sector', 'm_sector.id', '=', 'djv_job_vacancy_detail.id_m_sector')
            ->leftJoin('m_education', 'm_education.id', '=', 'djv_job_vacancy_detail.id_m_education')
            ->leftJoin('m_experience_level', 'm_experience_level.id', '=', 'djv_job_vacancy_detail.id_m_experience_level')
            ->leftjoin('m_provinsi', 'm_provinsi.id', '=', 'djv_job_vacancy_detail.id_provinsi')
            ->select(
                'djv_job_vacancy_detail.*',
                'm_employee_status.nama as job_type',
                'm_work_location.nama as work_location',
                'm_salary_date_month.nama as fee',
                'm_salary.nama as salary',
                'm_sector.nama as sector',
                'm_education.nama as education',
                'm_experience_level.nama as name_experience_level',
                'm_provinsi.nama as provinsi'
            );
       
        $getdataDetail=$query->where('djv_job_vacancy_detail.id',base64_decode($id))->first();
        $datadetail = $query->where('djv_job_vacancy_detail.id',base64_decode($id))->first();
        $url = $request->input('url', url()->current());
        $title = $request->input('title', $datadetail->job_title);
        $share_buttons = \Share::page($url)
          ->facebook()
          ->twitter()
          ->linkedin()
          ->whatsapp();
          $share_buttons = $share_buttons;
          $dataIdJob =base64_decode($id);
          return view('jobvacancy.detailjob', compact('title','menus', 'getdtApplyJob', 'getdataDetail', 'share_buttons','dataIdJob','role','UserCleint'));
        
    }

    public function previewFilter(Request $request)
    {


        $filteredData = DB::table('m_employee_status')
            ->Join('djv_job_vacancy_detail', 'djv_job_vacancy_detail.id_m_employee_status', '=', 'm_employee_status.id')
            ->select('m_employee_status.nama')
            ->selectRaw('count(*) as count')
            ->groupBy('m_employee_status.nama')
            ->get();

        return view('partials.filter_preview', ['filteredData' => $filteredData]);
    }

    public function previewFilterPlacement(Request $request)
    {

        $filter_Data_work_location = DB::table('m_work_location')
            ->Join('djv_job_vacancy_detail', 'djv_job_vacancy_detail.id_m_work_location', '=', 'm_work_location.id')
            ->select('m_work_location.nama')
            ->selectRaw('count(*) as count')
            ->groupBy('m_work_location.nama')
            ->get();
        return view('partials.filter_placement_preview', ['filter_data_work_location' => $filter_Data_work_location]);
    }

    public function previewFilterExperienceLevel(Request $request)
    {
        $filters = $request->all();
        $filter_Data_experience_level = DB::table('m_experience_level');

        $filter_Data_experience_level = $filter_Data_experience_level->get();

        return view('partials.filter_experience_level_preview', ['filter_data_experience_level' => $filter_Data_experience_level]);
    }


    public function previewFilterEducation(Request $request)
    {
        $filters = $request->all();
        $filter_Data_education = DB::table('m_education');

        $filter_Data_education = $filter_Data_education->get();

        return view('partials.filter_education_preview', ['filter_Data_education' => $filter_Data_education]);
    }

    public function previewFilterSalarayRange(Request $request)
    {
        $filters = $request->all();
        $filtersalaray = DB::table('m_salary')->get();

        return response()->json($filtersalaray);
    }


    public function priviewEmployeeStatusTop(Request $request)
    {
        $filtemployeeStatus = DB::table('m_employee_status')->get();

        return response()->json($filtemployeeStatus);
    }

    public function SidebarJobvacancy()
    {
        $query = DB::table('dtc_training_course_detail')
            ->leftjoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course')
            ->leftjoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course')
            ->leftjoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
            ->leftJoin(DB::raw('(
                SELECT *
                FROM dtc_file_training_course
                WHERE id IN (
                    SELECT MIN(id)
                    FROM dtc_file_training_course
                    GROUP BY id_training_course_dtl
                )
            ) AS dtc_file_training_course'), 'dtc_file_training_course.id_training_course_dtl', '=', 'dtc_training_course_detail.id')
            ->select('dtc_training_course_detail.*',
                'm_category_training_course.nama as category',
                'm_jenis_sertifikasi_training_course.nama as cetificate_type',
                'dtc_file_training_course.nama as image_path',
                'm_type_training_course.nama as typeonlineofline');
        $trainings = $query->where('dtc_training_course_detail.status',1)->orderBy('dtc_training_course_detail.updated_at', 'desc')->limit(3)->get();

        return view('partials.jobs.sidebar_jobs', compact('trainings'))->render();
    }

    public function getContentJobList(Request $request)
    {
        $filters = $request->all();
        //dd($filters);
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
        $whereData=$query->where('djv_job_vacancy_detail.status',1);

       // dd($filters);

        // filter job title
        if (!empty($filters['jobtitle']) && is_array($filters['jobtitle'])) {
            $whereData->whereIn('djv_job_vacancy_detail.job_title', $filters['jobtitle']);
        } elseif (!empty($filters['jobtitle']) && is_string($filters['jobtitle'])) {
            $whereData->where('djv_job_vacancy_detail.job_title', 'LIKE', '%' . $filters['jobtitle'] . '%');
        }

        // filter Provinsi
        if (!empty($filters['provinsi']) && is_array($filters['provinsi'])) {
            $whereData->whereIn('m_provinsi.id', $filters['provinsi']);
        } elseif (!empty($filters['provinsi']) && is_string($filters['provinsi'])) {
            $whereData->where('m_provinsi.id', 'LIKE', '%' . $filters['provinsi'] . '%');
        }

        // filter lokasi
        if (!empty($filters['location']) && is_array($filters['location'])) {
            $whereData->whereIn('djv_job_vacancy_detail.lokasi', $filters['location']);
        } elseif (!empty($filters['location']) && is_string($filters['location'])) {
            $whereData->where('djv_job_vacancy_detail.lokasi', 'LIKE', '%' . $filters['location'] . '%');
        }
        // Filter Job type
        if (!empty($filters['employeeStatusSelect']) && is_array($filters['employeeStatusSelect'])) {
            $whereData->whereIn('m_employee_status.id', $filters['employeeStatusSelect']);
        } elseif (!empty($filters['employeeStatusSelect']) && is_string($filters['employeeStatusSelect'])) {
            $whereData->where('m_employee_status.id', 'LIKE', '%' . $filters['employeeStatusSelect'] . '%');
        }

        if (!empty($filters['employestatus']) && is_array($filters['employestatus'])) {
            $whereData->whereIn('m_employee_status.id', $filters['employestatus']);
        } elseif (!empty($filters['employestatus']) && is_string($filters['employestatus'])) {
            $whereData->where('m_employee_status.id', 'LIKE', '%' . $filters['employestatus'] . '%');
        }

        // Filter salary range
        if (!empty($filters['salaryRange']) && is_array($filters['salaryRange'])) {
            $whereData->whereIn('m_salary.id', $filters['salaryRange']);
        } elseif (!empty($filters['salaryRange']) && is_string($filters['salaryRange'])) {
            $whereData->where('m_salary.id', 'LIKE', '%' . $filters['salaryRange'] . '%');
        }

        // Filter salary range Top
        if (!empty($filters['salaryRangeTop']) && is_array($filters['salaryRangeTop'])) {
            $whereData->whereIn('m_salary.id', $filters['salaryRangeTop']);
        } elseif (!empty($filters['salaryRangeTop']) && is_string($filters['salaryRangeTop'])) {
            $whereData->where('m_salary.id', 'LIKE', '%' . $filters['salaryRangeTop'] . '%');
        }

        // Filter worklocation
        if (!empty($filters['placement']) && is_array($filters['placement'])) {
            $whereData->whereIn('m_work_location.nama', $filters['placement']);
        } elseif (!empty($filters['placement']) && is_string($filters['placement'])) {
            $whereData->where('m_work_location.nama', 'LIKE', '%' . $filters['placement'] . '%');
        }

        // Filter experience level
        if (!empty($filters['experiencelevel']) && is_array($filters['experiencelevel'])) {
            $whereData->whereIn('m_experience_level.nama', $filters['experiencelevel']);
        } elseif (!empty($filters['experiencelevel']) && is_string($filters['experiencelevel'])) {
            $whereData->where('m_experience_level.nama', 'LIKE', '%' . $filters['experiencelevel'] . '%');
        }



        // Apply filters and sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'newest':
                    $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'desc');
                    break;
                case 'oldest':
                    $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'asc');
                    break;
                //case 'rating':
                //    $query->orderBy('djv_job_vacancy_detail.rating', 'desc'); // Assuming there's a rating column
                //    break;
            }
        } else {
            $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'desc'); // Default sort
        }

        $perPage = 3;
        $page = $request->input('page', 1);
        $data = $whereData->paginate($perPage, ['*'], 'page', $page);

        // Calculate the range of the items shown
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());

        // Render the 'showing' view with the calculated range
        $showing = view('partials.showing', [
            'from' => $from,
            'to' => $to,
            'total' => $data->total()
        ])->render();

        $sortAndView = view('partials.sort_and_view', [
            'sortBy' => $filters['sortBy'] ?? 'Newest Post'
        ])->render();

        return response()->json([
            'content' => view('partials.jobs.content_job_list', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);
    }

    public function getContentJobGrid(Request $request)
    {
        $filters = $request->all();
        //dd($filters);
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
        $whereData=$query->where('djv_job_vacancy_detail.status',1);

        // dd($filters);
        // filter job title
        if (!empty($filters['jobtitle']) && is_array($filters['jobtitle'])) {
            $whereData->whereIn('djv_job_vacancy_detail.job_title', $filters['jobtitle']);
        } elseif (!empty($filters['jobtitle']) && is_string($filters['jobtitle'])) {
            $whereData->where('djv_job_vacancy_detail.job_title', 'LIKE', '%' . $filters['jobtitle'] . '%');
        }

        //date
        if (!empty($filters['datesearchJob'])) {
            // Periksa apakah $filters['datesearch'] adalah string yang berisi ' to '
            if (is_string($filters['datesearchJob']) && strpos($filters['datesearchJob'], ' to ') !== false) {
                // Pisahkan tanggal dengan ' to '
                $dates = explode(' to ', $filters['datesearchJob']);

                if (count($dates) == 2) {
                    // Filter berdasarkan rentang antara startdate dan enddate
                    $whereData->where(function ($query) use ($dates) {
                        $query->whereBetween('djv_job_vacancy_detail.posted_date', [$dates[0], $dates[1]])
                              ->orWhereBetween('djv_job_vacancy_detail.close_date', [$dates[0], $dates[1]]);
                    });
                } elseif (count($dates) == 1) {
                    // Jika hanya ada satu tanggal, gunakan whereDate untuk mencari tanggal tertentu
                    $whereData->whereDate('djv_job_vacancy_detail.posted_date', '=', $dates[0]);
                }
            } elseif (is_string($filters['datesearchJob'])) {
                // Jika 'datesearch' berisi string tanggal tunggal, gunakan whereDate untuk mencari tanggal tertentu
                $whereData->whereDate('djv_job_vacancy_detail.posted_date', '=', $filters['datesearchJob']);
            }
        }

        // filter lokasi
        if (!empty($filters['location']) && is_array($filters['location'])) {
            $whereData->whereIn('djv_job_vacancy_detail.lokasi', $filters['location']);
        } elseif (!empty($filters['location']) && is_string($filters['location'])) {
            $whereData->where('djv_job_vacancy_detail.lokasi', 'LIKE', '%' . $filters['location'] . '%');
        }
        // Filter Job type
        if (!empty($filters['employeeStatusSelect']) && is_array($filters['employeeStatusSelect'])) {
            $whereData->whereIn('m_employee_status.nama', $filters['employeeStatusSelect']);
        } elseif (!empty($filters['employeeStatusSelect']) && is_string($filters['employeeStatusSelect'])) {
            $whereData->where('m_employee_status.nama', 'LIKE', '%' . $filters['employeeStatusSelect'] . '%');
        }

        if (!empty($filters['employeeStatus']) && is_array($filters['employeeStatus'])) {
            $whereData->whereIn('m_employee_status.nama', $filters['employeeStatus']);
        } elseif (!empty($filters['employeeStatus']) && is_string($filters['employeeStatus'])) {
            $whereData->where('m_employee_status.nama', 'LIKE', '%' . $filters['employeeStatus'] . '%');
        }

        // Filter salary range
        if (!empty($filters['salaryRange']) && is_array($filters['salaryRange'])) {
            $whereData->whereIn('m_salary.nama', $filters['salaryRange']);
        } elseif (!empty($filters['salaryRange']) && is_string($filters['salaryRange'])) {
            $whereData->where('m_salary.nama', 'LIKE', '%' . $filters['salaryRange'] . '%');
        }

        // Filter salary range Top
        if (!empty($filters['salaryRangeTop']) && is_array($filters['salaryRangeTop'])) {
            $whereData->whereIn('m_salary.nama', $filters['salaryRangeTop']);
        } elseif (!empty($filters['salaryRangeTop']) && is_string($filters['salaryRangeTop'])) {
            $whereData->where('m_salary.nama', 'LIKE', '%' . $filters['salaryRangeTop'] . '%');
        }

        // Filter worklocation
        if (!empty($filters['placement']) && is_array($filters['placement'])) {
            $whereData->whereIn('m_work_location.nama', $filters['placement']);
        } elseif (!empty($filters['placement']) && is_string($filters['placement'])) {
            $whereData->where('m_work_location.nama', 'LIKE', '%' . $filters['placement'] . '%');
        }

        // Filter experience level
        if (!empty($filters['experiencelevel']) && is_array($filters['experiencelevel'])) {
            $whereData->whereIn('m_experience_level.nama', $filters['experiencelevel']);
        } elseif (!empty($filters['experiencelevel']) && is_string($filters['experiencelevel'])) {
            $whereData->where('m_experience_level.nama', 'LIKE', '%' . $filters['experiencelevel'] . '%');
        }



        // Apply filters and sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'newest':
                    $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'desc');
                    break;
                case 'oldest':
                    $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'asc');
                    break;
                //case 'rating':
                //    $query->orderBy('djv_job_vacancy_detail.rating', 'desc'); // Assuming there's a rating column
                //    break;
            }
        } else {
            $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'desc'); // Default sort
        }

        $perPage = 3;
        $page = $request->input('page', 1);
        $data = $whereData->paginate($perPage, ['*'], 'page', $page);

        // Calculate the range of the items shown
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());

        // Render the 'showing' view with the calculated range
        $showing = view('partials.showing', [
            'from' => $from,
            'to' => $to,
            'total' => $data->total()
        ])->render();

        $sortAndView = view('partials.sort_and_view', [
            'sortBy' => $filters['sortBy'] ?? 'Newest Post'
        ])->render();

        //$listfiles = JobFileModel::orderBy('nama', 'asc')->get();

        return response()->json([
            'content' => view('partials.jobs.content_job_grid', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);

        // return response()->json([
        //     'content' => view('partials.content_job_grid', [
        //         'data' => $data,
        //         'listfiles' => $listfiles
        //     ])->render(),
        //     'pagination' => view('partials.pagination', [
        //         'data' => $data
        //     ])->render(),
        //     'showing' => $showing,
        //     'sort_and_view' => $sortAndView
        // ]);
    }


}
