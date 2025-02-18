<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\ApplyJob;
use App\Models\ResumeCandidate;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\JobVacancyDetailModel;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class JobClientController extends Controller
{

    // public function indexJoblient(Request $request)
    // {
    //     $userEmail = session('email');
    //     $getdtApplyJobs = User::where('email', $userEmail)->first();

    //     // Pastikan user ditemukan
    //     if (!$getdtApplyJobs) {
    //         abort(404, 'User not found');
    //     }

    //     // Query untuk mengambil data pekerjaan yang dilamar
    //     $getdtApplyJob = DB::table('tr_applyjob')
    //         ->leftJoin('djv_job_vacancy_detail', 'tr_applyjob.idjob', '=', 'djv_job_vacancy_detail.id')
    //         ->leftJoin('m_salary', 'm_salary.id', '=', 'tr_applyjob.idexpectedsalary')
    //         ->leftJoin('m_education', 'm_education.id', '=', 'tr_applyjob.ideducation')
    //         ->leftJoin('m_experience_level', 'm_experience_level.id', '=', 'tr_applyjob.idworkexperience')
    //         ->select(
    //             'tr_applyjob.*',
    //             'djv_job_vacancy_detail.job_title',
    //             'djv_job_vacancy_detail.companyName',
    //             'm_salary.nama as salary',
    //             'm_education.nama as education',
    //             'm_experience_level.nama as name_experience_level',
    //         )
    //         ->where('tr_applyjob.idusers', $getdtApplyJobs->id)
    //         ->get();

    //     // Siapkan data yang akan dikirim ke view
    //     $data = [
    //         'user_name' => $userEmail,
    //         'title' => 'Job',
    //         'getdtApplyJob' => $getdtApplyJob,
    //     ];

    //     // Ambil menu client
    //     $menus = Menu_client::whereNull('parent_id')
    //         ->with('children')
    //         ->orderBy('order')
    //         ->get();

    //     // URL saat ini
    //     $currentUrl = url()->current();

    //     // Kirim ke view
    //     $response = response()->view('template2.jobclient.indexJoblient', compact('data', 'menus', 'currentUrl'));
    //     $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
    //     $response->headers->set('Pragma', 'no-cache');
    //     $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

    //     return $response;
    // }


    // public function ViewApplyJob($idjob)
    // {
        
    //     $data = [
    //         'user_name' => session('email'),
    //         'title' => 'Job',
    //     ];
    //     $expectedsalary = DB::table('m_salary')->get();
    //     $education = DB::table('m_education')->get();
    //     $experiencelevel = DB::table('m_experience_level')->get();
        
    //     $jobid=$idjob;
    //     $getdataDetail = JobVacancyDetailModel::where('id', base64_decode($idjob))->first();
    //     //dd($getdataDetail);
    //     $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
    //     $currentUrl = url()->current();
    //     $response = response()->view('template2.apply.jobapply', compact('data', 'menus','currentUrl','getdataDetail','jobid','expectedsalary','education','experiencelevel'));
    //     $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
    //     $response->headers->set('Pragma', 'no-cache');
    //     $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

    //     return $response;
    //     // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    // }

    public function StoreJobClient(Request $request)
    {
        
        // Validasi input
        $request->validate([

            'idjob' => 'required',
            'idemployee' => 'required',
        ]); 
        
        
       
         //$appUrl = config('app.url');
        $appUrl = request()->url();
        try {
            // Proses upload file CV
            //$cvFileName = time() . '_' . $request->file('cv')->getClientOriginalName();
            //$destinationPath = public_path('../public/storage');
            //$request->file('cv')->move($destinationPath, $cvFileName);
            
            // URL file CV
            //$cvUrl = 'https://admin.trainingkerja.com/public/storage/' . $cvFileName;
            $userEmail = session('email');
            $UserCleint = User::where('email', $userEmail)->first();
            //dd($UserCleint);
            $chekresume = ResumeCandidate::where('user_id', $UserCleint->id)->first();
            
            $idjob=base64_decode($request->idjob);
           
            $id_employee=base64_decode($request->idemployee);
            if($chekresume){
                ApplyJob::create([
                    'idusers' => $UserCleint->id,
                    'idjob' => $idjob,
                    'id_employee' => $id_employee,
                    
                    'status' => 3,
                    'app_name' => "ApplyJob",
                    'server_type' => $appUrl,
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Data submitted successfully!'
                ]);
            }
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'CV tidak ditemukan, silakan upload terlebih dahulu.'
                ], 400);
            }
            
            // Kirim respons sukses
            

        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kirim pesan error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the data: ' . $e->getMessage()
            ], 500); // Mengirimkan kode status 500 (Internal Server Error)
        }
    }


    public function JobList(Request $request)
    {
        $filters = $request->all();
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
        $menus = Menu_client::where(function($query) use ($role) {
            if ($role == 'candidate') {
                $query->where('role', $role);
                
            }elseif ($role == 'employee') {
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
        $CountJob = DB::table('tr_applyjob')
            ->Join('djv_job_vacancy_detail', 'djv_job_vacancy_detail.id', '=', 'tr_applyjob.idjob')
            ->where('tr_applyjob.idusers', $user->id)
            ->count();
        //$CountJob = $dataCount->count();
        $filter = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
         // Get all courses

       //return view('jobvacancy.joblist', $data);
       return view('candidate.joblist', compact('title','menus', 'CountJob', 'valuJobtitle', 'valuLokasi','filter'));
    }

    public function getContentJobList(Request $request)
    {
        $filters = $request->all();
        $userId = session('id');
        //dd($filters);
        $query = DB::table('djv_job_vacancy_detail')
            ->leftJoin('tr_applyjob', 'djv_job_vacancy_detail.id', '=', 'tr_applyjob.idjob')
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
                'tr_applyjob.status as status_applyjob',
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
        $whereData=$query->where('tr_applyjob.idusers',$userId);
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
            'content' => view('partials.candidate.content_job_list', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);
    }

    // public function detailJobClient($id)
    // {
    //     $userEmail = session('email');
    //     $getdtApplyJobs = User::where('email', $userEmail)->first();

    //     // Pastikan user ditemukan
    //     if (!$getdtApplyJobs) {
    //         abort(404, 'User not found');
    //     }

    //     // Query untuk mengambil data pekerjaan yang dilamar
    //     $getdtApplyJob = DB::table('tr_applyjob')
    //         ->leftJoin('djv_job_vacancy_detail', 'tr_applyjob.idjob', '=', 'djv_job_vacancy_detail.id')
    //         ->leftJoin('m_salary', 'm_salary.id', '=', 'tr_applyjob.idexpectedsalary')
    //         ->leftJoin('m_education', 'm_education.id', '=', 'tr_applyjob.ideducation')
    //         ->leftJoin('m_experience_level', 'm_experience_level.id', '=', 'tr_applyjob.idworkexperience')
    //         ->select(
    //             'tr_applyjob.*',
    //             'djv_job_vacancy_detail.job_title',
    //             'djv_job_vacancy_detail.file',
    //             'djv_job_vacancy_detail.job_description',
    //             'djv_job_vacancy_detail.skill_requirment',
    //             'djv_job_vacancy_detail.companyName',
    //             'm_salary.nama as salary',
    //             'm_education.nama as education',
    //             'm_experience_level.nama as name_experience_level',
    //         )
    //         ->where('tr_applyjob.id', base64_decode($id))
    //         ->first();

    //     // Siapkan data yang akan dikirim ke view
    //     $data = [
    //         'user_name' => $userEmail,
    //         'title' => 'Job',
    //         'getdtApplyJob' => $getdtApplyJob,
    //     ];

    //     // Ambil menu client
    //     $menus = Menu_client::whereNull('parent_id')
    //         ->with('children')
    //         ->orderBy('order')
    //         ->get();

    //     // URL saat ini
    //     $currentUrl = url()->current();

    //     // Kirim ke view
    //     $response = response()->view('template2.jobclient.detailJobClient', compact('data', 'menus', 'currentUrl'));
    //     $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
    //     $response->headers->set('Pragma', 'no-cache');
    //     $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

    //     return $response;
    // }

}
