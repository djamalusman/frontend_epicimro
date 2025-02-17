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
            $cvFileName = time() . '_' . $request->file('cv')->getClientOriginalName();
            $destinationPath = public_path('../public/storage');
            $request->file('cv')->move($destinationPath, $cvFileName);
            
            // URL file CV
            $cvUrl = 'https://admin.trainingkerja.com/public/storage/' . $cvFileName;

            $UserCleint = User::where('email', $request->emailsession)->first();

            $chekresume = ResumeCandidate::where('user_id', $UserCleint->id)->first();
            
            $idjob=base64_decode($request->jobid);
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
