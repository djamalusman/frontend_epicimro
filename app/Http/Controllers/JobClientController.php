<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\ApplyJob;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\JobVacancyDetailModel;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class JobClientController extends Controller
{
    public function indexJoblient(Request $request)
    {
        $data = [
            'user_name' => session('email'),
            'title' => 'Job',
        ];

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.jobclient.indexJoblient', compact('data', 'menus','currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    }

    public function ViewApplyJob($idjob)
    {
        
        $data = [
            'user_name' => session('email'),
            'title' => 'Job',
        ];
        $expectedsalary = DB::table('m_salary')->get();
        $education = DB::table('m_education')->get();
        $experiencelevel = DB::table('m_experience_level')->get();
        
        $jobid=$idjob;
        $getdataDetail = JobVacancyDetailModel::where('id', base64_decode($idjob))->first();
        //dd($getdataDetail);
        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.apply.jobapply', compact('data', 'menus','currentUrl','getdataDetail','jobid','expectedsalary','education','experiencelevel'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    }

    public function StoreJobClient(Request $request)
    {
        
        // Validasi input
        $request->validate([

            'idjob' => 'required',
            'emailsession' => 'required',
            'coverletter' => 'required',
            // 'cv' => 'required|mimes:pdf,doc,docx|max:2048',
            'expectedsalary' => 'required',
            'education' => 'required',
            'workexperience' => 'required',
            'positionWork' => 'required',
            'companyName' => 'required',
            'startDateWork' => 'required',
            'writeskill' => 'required',
        ]);
        
        // $startDateTime = Carbon::createFromFormat('Y-m-d', $request->startDateWork)->startOfDay();
        // if ($request->writeskill === "" || $request->writeskill === null) {
        //     $endDateTime = Carbon::createFromFormat('Y-m-d', $request->endDateWork)->startOfDay();
        //     $endDateWork = $endDateTime;
        //     $stillWork = null;
        // } else {
        //     $endDateWork = null;
        //     $stillWork = $request->stillWork;
        // }

       
        //$appUrl = config('app.url');
        
        $no = User::count() + 1;
        try {
            // Proses upload file CV
            // $cvFileName = time() . '_' . $request->file('cv')->getClientOriginalName();
            // $destinationPath = public_path('../storage');
            // $request->file('cv')->move($destinationPath, $cvFileName);
            
            
            // $cvUrl = 'https://admin.trainingkerja.com/storage/' . $cvFileName;

            // $getdataUserCleint = UserClientModel::where('email', $request->emailsession)->first();
            
            // Simpan data ke database
            ApplyJob::create([
                'id'=>$no,
                // 'idusers' => $getdataUserCleint->id,
                // 'idexpectedsalary' => $request->expectedsalary,
                // 'ideducation' => $request->education,
                // 'idworkexperience' => $request->workexperience,
                // 'idjob' => $request->idjob,
                // 'cv_path' => $cvFileName,
                // 'positionWork' => $request->positionWork,
                // 'companyName' => $request->companyName,
                // 'startDateWork' => $startDateTime,
                // 'endDateWork' => $endDateWork,
                // 'stillWork' => $stillWork,
                // 'writeskill' => $request->writeskill,
                // 'status' => 1,
                // 'app_name' => "ApplyJob",
                // 'server_type' => $appUrl,
            ]);

            // Kirim respons sukses
            return response()->json([
                'success' => true,
                'message' => 'Data submitted successfully!'
            ]);

        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kirim pesan error
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while submitting the data: ' . $e->getMessage()
            ], 500); // Mengirimkan kode status 500 (Internal Server Error)
        }
    }


}
