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
use App\Models\BankAccount;
use App\Models\accounts_transfer;
use Illuminate\Support\Facades\View;
use App\Models\Payment;
use Carbon\Carbon;

class TrainingClientController extends Controller
{
    public function indextrainingclient(Request $request)
    {
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();

        // Pastikan user ditemukan
        if (!$getdtUserClient) {
            abort(404, 'User not found');
        }

        // Query untuk mengambil data pekerjaan yang dilamar
        $getdtTraining = DB::table('tr_applytraining')
            ->leftJoin('dtc_training_course_detail', 'tr_applytraining.idtraining', '=', 'dtc_training_course_detail.id')
            ->leftJoin('m_education', 'm_education.id', '=', 'tr_applytraining.ideducation')
            ->leftJoin('payments', 'payments.idtraining', '=', 'tr_applytraining.id')
            ->select(
                'tr_applytraining.*',
                'payments.status as statuspayment',
                'dtc_training_course_detail.traning_name',
                'dtc_training_course_detail.company_name',
                'm_education.nama as education',
            )
            ->where('tr_applytraining.idusers', $getdtUserClient->id)
            ->get();
            
        // Siapkan data yang akan dikirim ke view
        $data = [
            'user_name' => $userEmail,
            'title' => 'Training',
            'getdtTraining' => $getdtTraining,
        ];

        // Ambil menu client
        $menus = Menu_client::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        // URL saat ini
        $currentUrl = url()->current();

        // Kirim ke view
        $response = response()->view('template2.trainingclient.indextrainingclient', compact('data', 'menus', 'currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;

    }


    public function registerTraining($idtraining)
    {
        
        $data = [
            'user_name' => session('email'),
            'phone'=> session('phone'),
            'title' => 'Training',
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
                'status' => 0,
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

    public function indexPaymentTraining($id) {
        
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();

        // Pastikan user ditemukan
        if (!$getdtUserClient) {
            abort(404, 'User not found');
        }

        // Query untuk mengambil data pekerjaan yang dilamar
        $bankAccount = BankAccount::all();
        $accountsTransfer = accounts_transfer::all();
        $getdtTraining = DB::table('tr_applytraining')
        ->leftJoin('dtc_training_course_detail', 'tr_applytraining.idtraining', '=', 'dtc_training_course_detail.id')
        ->leftJoin('m_education', 'm_education.id', '=', 'tr_applytraining.ideducation')
        ->leftJoin('payments', 'payments.idtraining', '=', 'tr_applytraining.id')
        ->leftJoin('dtc_file_training_course', 'dtc_file_training_course.id_training_course_dtl', '=', 'tr_applytraining.idtraining')
        ->leftJoin('accounts_transfer', 'accounts_transfer.id', '=', 'payments.idaccount_transfer')
        ->leftJoin('bank_accounts', 'bank_accounts.id', '=', 'accounts_transfer.idbank')
        ->select(
            'tr_applytraining.*',
            'dtc_file_training_course.nama as imagetraining',
            'payments.status as statuspayment',
            'payments.payment_proof',
            'dtc_training_course_detail.traning_name',
            'dtc_training_course_detail.company_name',
            'dtc_training_course_detail.abouttraining',
            'dtc_training_course_detail.abouttrainer',
            'dtc_training_course_detail.aboutcareer',
            'dtc_training_course_detail.registrationfee',
            'm_education.nama as education',
            'accounts_transfer.nama as namatransfer',
            'accounts_transfer.nomor_rekening',
            'accounts_transfer.id as idaccount_transfer',
            'bank_accounts.bank_name',
            'bank_accounts.id as selectedBankId', 
        )
        ->where('tr_applytraining.idusers', $getdtUserClient->id)
        ->where('tr_applytraining.id', base64_decode($id))
        ->orderBy('payments.updated_at', 'desc') 
        ->first();
            
        // Siapkan data yang akan dikirim ke view
        $data = [
            'user_name' => $userEmail,
            'title' => 'Training',
            'getdtTraining' => $getdtTraining,
            'bankAccount' =>$bankAccount,
            'idtraining' =>base64_decode($id),
            'idusers'=> $getdtUserClient->id,
            'selectedBankId' => $getdtTraining->selectedBankId ?? null,
            'selectedAccountId'=> $getdtTraining->idaccount_transfer ?? null,
            'accountsTransfer' => $accountsTransfer
        ];

        // Ambil menu client
        $menus = Menu_client::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        // URL saat ini
        $currentUrl = url()->current();

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.trainingclient.indextrainingpayment', compact('data', 'menus','currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
    }


    public function getAccountsTransfer($idbank)
    {
        // Ambil data transfer berdasarkan idbank
        $accountsTransfer = accounts_transfer::where('idbank', $idbank)->get();

        // Kembalikan response dalam bentuk JSON
        return response()->json($accountsTransfer);
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'idtraining' => 'required',
            'idusers' => 'required',
            'amount' => 'required|string',
            'payment_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);
        $amount = str_replace(['Rp', '.', ','], '', $request->amount);
        $cvFileName = time() . '_' . $request->file('payment_proof')->getClientOriginalName();
        $destinationPath = public_path('../public/storage');
        $request->file('payment_proof')->move($destinationPath, $cvFileName);

        Payment::create([
            'idtraining' => $request->idtraining,
            'idusers' => $request->idusers,
            'idaccount_transfer' => $request->accountDetails,
            'amount' => $amount,
            'payment_proof' => $cvFileName,
            'status' => 0,
        ]);
    
        return response()->json(['message' => 'Payment submitted successfully.']);
    
    }

    public function detailTrainingClient($id) {
        
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();

        // Pastikan user ditemukan
        if (!$getdtUserClient) {
            abort(404, 'User not found');
        }

        // Query untuk mengambil data pekerjaan yang dilamar
        $bankAccount = BankAccount::all();
        $accountsTransfer = accounts_transfer::all();
        $getdtTraining = DB::table('tr_applytraining')
        ->leftJoin('dtc_training_course_detail', 'tr_applytraining.idtraining', '=', 'dtc_training_course_detail.id')
        ->leftJoin('m_education', 'm_education.id', '=', 'tr_applytraining.ideducation')
        ->leftJoin('payments', 'payments.idtraining', '=', 'tr_applytraining.id')
        ->leftJoin('dtc_file_training_course', 'dtc_file_training_course.id_training_course_dtl', '=', 'tr_applytraining.idtraining')
        ->leftJoin('accounts_transfer', 'accounts_transfer.id', '=', 'payments.idaccount_transfer')
        ->leftJoin('bank_accounts', 'bank_accounts.id', '=', 'accounts_transfer.idbank')
        ->select(
            'tr_applytraining.*',
            'dtc_file_training_course.nama as imagetraining',
            'payments.status as statuspayment',
            'payments.payment_proof',
            'dtc_training_course_detail.traning_name',
            'dtc_training_course_detail.company_name',
            'dtc_training_course_detail.abouttraining',
            'dtc_training_course_detail.abouttrainer',
            'dtc_training_course_detail.aboutcareer',
            'dtc_training_course_detail.registrationfee',
            'm_education.nama as education',
            'accounts_transfer.nama as namatransfer',
            'accounts_transfer.nomor_rekening',
            'accounts_transfer.id as idaccount_transfer',
            'bank_accounts.bank_name',
            'bank_accounts.id as selectedBankId', 
        )
        ->where('tr_applytraining.idusers', $getdtUserClient->id)
        ->where('tr_applytraining.id', base64_decode($id))
        ->orderBy('payments.updated_at', 'desc') 
        ->first();
            
        // Siapkan data yang akan dikirim ke view
        $data = [
            'user_name' => $userEmail,
            'title' => 'Training',
            'getdtTraining' => $getdtTraining,
            'bankAccount' =>$bankAccount,
            'idtraining' =>base64_decode($id),
            'idusers'=> $getdtUserClient->id,
            'selectedBankId' => $getdtTraining->selectedBankId ?? null,
            'selectedAccountId'=> $getdtTraining->idaccount_transfer ?? null,
            'accountsTransfer' => $accountsTransfer
        ];

        // Ambil menu client
        $menus = Menu_client::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        // URL saat ini
        $currentUrl = url()->current();

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.trainingclient.detailtrainingclinet', compact('data', 'menus','currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
    }


}
