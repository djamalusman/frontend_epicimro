<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\ApplyTraining;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\TraningCourseDetailsModel;
use App\Models\dtc_File_TrainingCourseModel;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class TrainingClientController extends Controller
{
    public function indextrainingclient(Request $request)
    {
        $data = [
            'user_name' => session('email'),
            'title' => 'Training',
        ];

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.trainingclient.indextrainingclient', compact('data', 'menus','currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    }


    public function registerTraining($idtraining)
    {
        
        $data = [
            'user_name' => session('email'),
            'title' => 'Job',
        ];
        $expectedsalary = DB::table('m_salary')->get();
        $education = DB::table('m_education')->get();
        $experiencelevel = DB::table('m_experience_level')->get();
        
        $idtraining=$idtraining;
        $getdataDetail = TraningCourseDetailsModel::where('id', base64_decode($idtraining))->first();
        $imagetraining = dtc_File_TrainingCourseModel::where('id_training_course_dtl', base64_decode($idtraining))->first();
        
        $currentUrl = url()->current();
        $response = response()->view('template2.apply.trainingapply', compact('data','currentUrl','getdataDetail','idtraining','imagetraining','expectedsalary','education','experiencelevel'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php trainingapply

    }

    public function StoreTrainingClient(Request $request)
    {
        
        // Validasi input
        $request->validate([

            'idtraining' => 'required',
            'emailsession' => 'required',
            'education' => 'required',
            'writeskill' => 'required',
        ]);
        
       
         //$appUrl = config('app.url');
         $appUrl = request()->url();
        try {
           

            $getdataUserCleint = User::where('email', $request->emailsession)->first();
            $idtraining=base64_decode($request->idtraining);
            ApplyTraining::create([
                'idusers' => $getdataUserCleint->id,
                'ideducation' => $request->education,
                'idtraining' => $idtraining,
                'positionWork' => $request->positionWork,
                'companyName' => $request->companyName,
                'writeskill' => $request->writeskill,
                'trainingcourse'=> $request->trainingcourse,
                'status' => 1,
                'app_name' => "ApplyJob",
                'server_type' => $appUrl,
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


    public function storePayment(Request $request)
    {
        $request->validate([
            'idtraining' => 'required|exists:trainings,id',
            'idusers' => 'required|exists:users,id',
            'amount' => 'required|string',
            'payment_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);
    
        // Hapus format Rupiah dan simpan sebagai angka
        $amount = str_replace(['Rp', '.', ','], '', $request->amount);
    
        $filePath = $request->file('payment_proof')->store('payment_proofs', 'public');
    
        Payment::create([
            'idtraining' => $request->idtraining,
            'idusers' => $request->idusers,
            'amount' => $amount,
            'payment_proof' => $filePath,
            'status' => 'pending',
        ]);
    
        return response()->json(['message' => 'Payment submitted successfully.']);
    
    }


}
