<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\ApplyTraining;
use App\Models\TraningCourseDetailsModel;
use App\Models\dtc_File_TrainingCourseModel;
use App\Models\BankAccount;
use App\Models\accounts_transfer;
use App\Models\Payment;
use App\Models\ResumeCandidate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
class TrainingClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function courseList()
    {
        $title= 'Training';
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
        // $dataCount = TraningCourseDetailsModel::where('status', 1)->get();
        // $Counttraining = $dataCount->count();
        $Counttraining = DB::table('tr_applytraining')
            ->Join('dtc_training_course_detail', 'dtc_training_course_detail.id', '=', 'tr_applytraining.idtraining')
            ->where('tr_applytraining.idusers', $user->id)
            ->count();
        $filter = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
       //return view('candidate.courselist', $data);
       return view('candidate.traininglist', compact('title','menus', 'Counttraining', 'filter'));       
    }

    
    
    public function getContentTrainingList(Request $request)
    {
        $filters = $request->all();
        $userId = session('id');
        
        $query = DB::table('dtc_training_course_detail')
            ->leftJoin('tr_applytraining', 'dtc_training_course_detail.id', '=', 'tr_applytraining.idtraining')
            ->leftjoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course') // Bergabung dengan tabel tipe_master
            ->leftjoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course') // Bergabung dengan tabel ifg_master_tipe
            ->leftjoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
            ->leftjoin('m_provinsi', 'm_provinsi.id', '=', 'dtc_training_course_detail.id_provinsi')
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
                'm_type_training_course.nama as typeonlineofline',
                'm_provinsi.nama as nama_provinsi',
                'dtc_file_training_course.nama as image_path'
            );
        $whereData=$query->where('tr_applytraining.idusers',$userId);
       
        // Filter training name
        if (!empty($filters['trainingname']) && is_array($filters['trainingname'])) {
            $whereData->whereIn('dtc_training_course_detail.traning_name', $filters['trainingname']);

        } elseif (!empty($filters['trainingname']) && is_string($filters['trainingname'])) {
            $whereData->where('dtc_training_course_detail.traning_name', 'LIKE', '%' . $filters['trainingname'] . '%');
        }


        // Filter category
        if (!empty($filters['category']) && is_array($filters['category'])) {
            $whereData->whereIn('m_category_training_course.id', $filters['category']);
        } elseif (!empty($filters['category']) && is_string($filters['category'])) {
            $whereData->where('m_category_training_course.id', 'LIKE', '%' . $filters['category'] . '%');
        }

        if (!empty($filters['categoryTop']) && is_array($filters['categoryTop'])) {
            $whereData->whereIn('m_category_training_course.id', $filters['categoryTop']);
        } elseif (!empty($filters['categoryTop']) && is_string($filters['categoryTop'])) {
            $whereData->where('m_category_training_course.id', 'LIKE', '%' . $filters['categoryTop'] . '%');
        }

        // Filter Certificate
        if (!empty($filters['cetificatetype']) && is_array($filters['cetificatetype'])) {
            $whereData->whereIn('m_jenis_sertifikasi_training_course.id', $filters['cetificatetype']);
        } elseif (!empty($filters['cetificatetype']) && is_string($filters['cetificatetype'])) {
            $whereData->where('m_jenis_sertifikasi_training_course.id', 'LIKE', '%' . $filters['cetificatetype'] . '%');
        }



        // Filter provinsi
        if (!empty($filters['provinsi']) && is_array($filters['provinsi'])) {
            $whereData->whereIn('m_provinsi.id', $filters['provinsi']);
        } elseif (!empty($filters['provinsi']) && is_string($filters['provinsi'])) {
            $whereData->where('m_provinsi.id', 'LIKE', '%' . $filters['provinsi'] . '%');
        }
        if (!empty($filters['provinsiTop']) && is_array($filters['provinsiTop'])) {
            $whereData->whereIn('m_provinsi.id', $filters['provinsiTop']);
        } elseif (!empty($filters['provinsiTop']) && is_string($filters['provinsiTop'])) {
            $whereData->where('m_provinsi.id', 'LIKE', '%' . $filters['provinsiTop'] . '%');
        }

        // Filter status
        if (!empty($filters['status']) && is_array($filters['status'])) {
            $whereData->whereIn('dtc_training_course_detail.status', $filters['status']);
        } elseif (!empty($filters['status']) && is_string($filters['status'])) {
            $statusValue = intval($filters['status']);
            $whereData->where('dtc_training_course_detail.status', $statusValue);
        }

        if (!empty($filters['statusTop']) && is_array($filters['statusTop'])) {
            $whereData->whereIn('dtc_training_course_detail.status', $filters['statusTop']);
        } elseif (!empty($filters['statusTop']) && is_string($filters['statusTop'])) {
            $whereData->where('dtc_training_course_detail.status', 'LIKE', '%' . $filters['statusTop'] . '%');
        }
        // Filter Type Course
        if (!empty($filters['type']) && is_array($filters['type'])) {
            $whereData->whereIn('m_type_training_course.id', $filters['type']);
        } elseif (!empty($filters['type']) && is_string($filters['type'])) {
            $whereData->where('m_type_training_course.id', 'LIKE', '%' . $filters['type'] . '%');
        }
        if (!empty($filters['typeTop']) && is_array($filters['typeTop'])) {
            $whereData->whereIn('m_type_training_course.id', $filters['typeTop']);
        } elseif (!empty($filters['typeTop']) && is_string($filters['typeTop'])) {
            $whereData->where('m_type_training_course.id', 'LIKE', '%' . $filters['typeTop'] . '%');
        }

        // Apply filters and sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'newest':
                    $whereData->orderBy('dtc_training_course_detail.updated_at', 'desc');
                    break;
                case 'oldest':
                    $whereData->orderBy('dtc_training_course_detail.updated_at', 'asc');
                    break;
                //case 'rating':
                //    $query->orderBy('djv_job_vacancy_detail.rating', 'desc'); // Assuming there's a rating column
                //    break;
            }
        } else {
            $whereData->orderBy('dtc_training_course_detail.updated_at', 'desc'); // Default sort
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
            'content' => view('partials.candidate.content_training_list', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);
    }

    // public function StoreTrainingClient(Request $request)
    // {
        
    //     // Validasi input
    //     $request->validate([

    //         'idtraining' => 'required',
    //         'emailsession' => 'required',
    //         'education' => 'required',
    //         'writeskill' => 'required',
    //     ]);
        
       
    //      //$appUrl = config('app.url');
    //      $appUrl = request()->url();
    //     try {
           

    //         $getdataUserCleint = User::where('email', $request->emailsession)->first();
    //         $idtraining=base64_decode($request->idtraining);
    //         ApplyTraining::create([
    //             'idusers' => $getdataUserCleint->id,
    //             'ideducation' => $request->education,
    //             'idtraining' => $idtraining,
    //             'positionWork' => $request->positionWork,
    //             'companyName' => $request->companyName,
    //             'writeskill' => $request->writeskill,
    //             'trainingcourse'=> $request->trainingcourse,
    //             'status' => 0,
    //             'app_name' => "ApplyJob",
    //             'server_type' => $appUrl,
    //         ]);

    //         // Kirim respons sukses
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data submitted successfully!'
    //         ]);

    //     } catch (\Exception $e) {
    //         // Jika terjadi kesalahan, kirim pesan error
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'An error occurred while submitting the data: ' . $e->getMessage()
    //         ], 500); // Mengirimkan kode status 500 (Internal Server Error)
    //     }
    // }


    public function StoreTrainingClient(Request $request)
    {
        
        // Validasi input
        $request->validate([

            'idcompany' => 'required',
            'idtraining' => 'required',
        ]); 
        
        
       
         //$appUrl = config('app.url');
        $appUrl = request()->url();
        try {
           
            $userEmail = session('email');
            $UserCleint = User::where('email', $userEmail)->first();
            //dd($UserCleint);
            $chekresume = ResumeCandidate::where('user_id', $UserCleint->id)->first();
            
            $idtraining=base64_decode($request->idtraining);
           
            $idcompany=base64_decode($request->idcompany);
            if($chekresume){
                ApplyTraining::create([
                    'idusers' => $UserCleint->id,
                    'idtraining' => $idtraining,
                    'idcompany' => $idcompany,
                    
                    'status' => 3,
                    'app_name' => "ApplyTraining",
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

}
