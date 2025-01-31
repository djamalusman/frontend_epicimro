<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\ApplyTraining;
use App\Models\ApplyJob;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\TraningCourseDetailsModel;
use App\Models\dtc_File_TrainingCourseModel;
use App\Models\BankAccount;
use App\Models\accounts_transfer;
use Illuminate\Support\Facades\View;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'user_name' => session('email'),
            'title' => 'Dashboard',
        ];

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.dashboard.index', compact('data', 'menus','currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    }

    public function ActivitiesJob(Request $request) {
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();
    
        $jobActivities = DB::table('tr_applyjob')
            ->join('djv_job_vacancy_detail', 'tr_applyjob.idjob', '=', 'djv_job_vacancy_detail.id') 
            ->where('tr_applyjob.idusers', $getdtUserClient->id)
            ->where('tr_applyjob.status', 1)
            ->select(
                'tr_applyjob.id',
                'djv_job_vacancy_detail.job_title as title',
                'tr_applyjob.created_at',
                DB::raw("CONCAT('http://admin.trainingkerja.com/public/storage/', COALESCE(djv_job_vacancy_detail.file, 'default.jpg')) as image")
            )
            ->orderBy('tr_applyjob.created_at', 'desc') // Urutkan berdasarkan created_at desc
            ->limit(2) // Ambil hanya 2 data terakhir
        ->get();
    
        return response()->json($jobActivities->sortByDesc('created_at')->values());
    }

    public function ActivitiesTraining(Request $request) {
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();
    
        $trainingActivities = DB::table('tr_applytraining')
            ->join('dtc_training_course_detail', 'tr_applytraining.idtraining', '=', 'dtc_training_course_detail.id') 
            ->join('dtc_file_training_course', 'dtc_training_course_detail.id', '=', 'dtc_file_training_course.id_training_course_dtl') 
            ->where('tr_applytraining.idusers', $getdtUserClient->id)
            ->where('tr_applytraining.status', 1)
            ->select(
                'tr_applytraining.id',
                'dtc_training_course_detail.traning_name as title',
                'tr_applytraining.created_at',
                DB::raw("CONCAT('http://admin.trainingkerja.com/public/storage/', COALESCE(dtc_file_training_course.nama, 'default.jpg')) as image")
            ) ->orderBy('tr_applytraining.created_at', 'desc') // Urutkan berdasarkan created_at desc
            ->limit(2) 
            ->get();
    
        return response()->json($trainingActivities->sortByDesc('created_at')->values());
    }
    
    public function getChartData(Request $request)
    {
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();
        
        $dateRange = $request->query('dateRange');
        $filter = $request->query('filter', 'all'); 

        \Log::info("Received filter data:", ['dateRange' => $dateRange, 'filter' => $filter]);

        // Query data pekerjaan dengan kategori
        $queryJob = DB::table('tr_applyjob')
            ->join('djv_job_vacancy_detail', 'tr_applyjob.idjob', '=', 'djv_job_vacancy_detail.id')
            ->join('m_sector', 'djv_job_vacancy_detail.id_m_sector', '=', 'm_sector.id')
            ->where('tr_applyjob.idusers', $getdtUserClient->id)
            ->where('tr_applyjob.status', 1)
            ->select('m_sector.nama as category', DB::raw('COUNT(*) as total'))
            ->groupBy('m_sector.nama');

        // Query data pelatihan dengan kategori
        $queryTraining = DB::table('tr_applytraining')
            ->join('dtc_training_course_detail', 'tr_applytraining.idtraining', '=', 'dtc_training_course_detail.id')
            ->join('m_category_training_course', 'dtc_training_course_detail.id_m_category_training_course', '=', 'm_category_training_course.id')
            ->where('tr_applytraining.idusers', $getdtUserClient->id)
            ->where('tr_applytraining.status', 1)
            ->select('m_category_training_course.nama as category', DB::raw('COUNT(*) as total'))
            ->groupBy('m_category_training_course.nama');
        

        // Jika ada date range, filter berdasarkan tanggal
        if (!empty($dateRange)) {
            $dates = explode(' - ', $dateRange);

            if (count($dates) == 2) {
                try {
                    $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
                    $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();
                    $queryJob->whereBetween('tr_applyjob.created_at', [$startDate, $endDate]);
                    $queryTraining->whereBetween('tr_applytraining.created_at', [$startDate, $endDate]);
                } catch (\Exception $e) {
                    return response()->json(['error' => 'Invalid date format.'], 400);
                }
            } else {
                return response()->json(['error' => 'Date range is missing or incorrect.'], 400);
            }
        }

        // Jika filter tidak 'all', hanya jalankan salah satu query
        if ($filter === 'job') {
            $jobData = $queryJob->get();
            $trainingData = collect([]);
        } elseif ($filter === 'training') {
            $jobData = collect([]);
            $trainingData = $queryTraining->get();
        } else {
            $jobData = $queryJob->get();
            $trainingData = $queryTraining->get();
        }

        return response()->json([
            'job' => [
                'labels' => $jobData->pluck('category'),
                'values' => $jobData->pluck('total')
            ],
            'training' => [
                'labels' => $trainingData->pluck('category'),
                'values' => $trainingData->pluck('total')
            ]
        ]);
    }



    // public function getChartData(Request $request)
    // {
    //     $userEmail = session('email');
    //     $getdtUserClient = User::where('email', $userEmail)->first();
        
    //     $dateRange = $request->query('dateRange');
    //     $filter = $request->query('filter', 'all'); // Default ke 'all' jika tidak ada filter
    
    //     \Log::info("Received filter data:", ['dateRange' => $dateRange, 'filter' => $filter]);
    
    //     // Query default hanya untuk data dengan status = 1
    //     $queryJob = DB::table('tr_applyjob')->where('idusers', $getdtUserClient->id)->where('status', 1);
    //     $queryTraining = DB::table('tr_applytraining')->where('idusers', $getdtUserClient->id)->where('status', 1);
        
    //     // Jika ada date range, filter berdasarkan tanggal
    //     if (!empty($dateRange)) {
    //         $dates = explode(' - ', $dateRange);
    
    //         if (count($dates) == 2) {
    //             try {
    //                 $startDate = Carbon::createFromFormat('Y-m-d', trim($dates[0]))->startOfDay();
    //                 $endDate = Carbon::createFromFormat('Y-m-d', trim($dates[1]))->endOfDay();
    //                 $queryJob->whereBetween('created_at', [$startDate, $endDate]);
    //                 $queryTraining->whereBetween('created_at', [$startDate, $endDate]);
    //             } catch (\Exception $e) {
    //                 return response()->json(['error' => 'Invalid date format.'], 400);
    //             }
    //         } else {
    //             return response()->json(['error' => 'Date range is missing or incorrect.'], 400);
    //         }
    //     }
    
    //     // Jika filter tidak 'all', hanya jalankan salah satu query
    //     if ($filter === 'job') {
    //         $queryTraining->whereRaw('1 = 0'); // Kosongkan training
    //         $jobData = $queryJob->count();
    //         $trainingData = 0;
    //     } elseif ($filter === 'training') {
    //         $queryJob->whereRaw('1 = 0'); // Kosongkan job
    //         $jobData = 0;
    //         $trainingData = $queryTraining->count();
    //     } else {
    //         $jobData = $queryJob->count();
    //         $trainingData = $queryTraining->count();
    //     }
    
    //     return response()->json([
    //         'job' => ['labels' => ['Job'], 'values' => [$jobData]],
    //         'training' => ['labels' => ['Training'], 'values' => [$trainingData]]
    //     ]);
    // }
}
