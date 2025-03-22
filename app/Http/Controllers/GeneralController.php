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
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Menu_client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Jobs\SendPasswordResetEmail;
use Illuminate\Support\Facades\Queue;

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

    // public function sendPasswordResetLink(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email'
    //     ]);
    
    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'error' => $validator->errors()->first()], 422);
    //     }
    
    //     $user = User::where('email', $request->email)->first();
    
    //     if (!$user) {
    //         return response()->json(['success' => false, 'error' => 'Email tidak ditemukan'], 404);
    //     }
    
    //     try {
    //         $token = Str::random(60);
    //         $user->remember_token = $token;
    //         $user->save();
    
    //         Mail::to($user->email)->send(new ForgotPasswordMail($user, $token));
    
    //         return response()->json(['success' => true, 'message' => 'Link reset password telah dikirim ke email Anda']);
    //     } catch (\Exception $e) {
    //         Log::error('Email error: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'error' => 'Gagal mengirim email. Silakan coba lagi nanti.'], 500);
    //     }
    // }

    // public function sendPasswordResetLink(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'error' => $validator->errors()->first()], 422);
    //     }

    //     $user = User::where('email', $request->email)->first();
    //     if ($user->comfir_email !=0 || $user->comfir_email != null) {
    //         return response()->json(['success' => false, 'error' => 'Sialahkan konfirmasi email and terlebih dahulu'], 404);
    //     }
    //     if (!$user) {
    //         return response()->json(['success' => false, 'error' => 'Email tidak ditemukan'], 404);
    //     }

    //     try {
    //         $token = Str::random(60);
    //         $user->remember_token = $token;
    //         $user->save();

    //         dispatch(new SendPasswordResetEmail($user, $token));

    //         return response()->json(['success' => true, 'message' => 'Link reset password telah dikirim ke email Anda']);
    //     } catch (\Exception $e) {
    //         Log::error('Email error: ' . $e->getMessage());
    //         return response()->json(['success' => false, 'error' => 'Gagal mengirim email. Silakan coba lagi nanti.'], 500);
    //     }
    // }

    public function sendRegistrationEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->first()], 422);
        }

        $user = User::where('email', $request->email)->first();
        //dd($user);
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Email tidak ditemukan'], 404);
        }

        try {
            dispatch(new SendRegistrationEmail($user, $request->password));
            return response()->json(['success' => true, 'message' => 'Email pendaftaran akan segera dikirim']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Gagal mengirim email.'], 500);
        }
    }

    public function sendPasswordResetEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->first()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Email tidak ditemukan'], 404);
        }

        try {
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            dispatch(new SendPasswordResetEmail($user, $token));
            return response()->json(['success' => true, 'message' => 'Link reset password telah dikirim ke email Anda']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Gagal mengirim email.'], 500);
        }
    }

    public function viewcresetPassword($token,$email)
    {
       if (Auth::check()) {
           // Pengguna sudah login
           $user = Auth::user();
           
           // Redirect berdasarkan role
           switch($user->role) {
               case 'candidate':
                   return redirect()->route('welcome');
               case 'company':
                   return redirect()->route('welcome');
               default:
                   return redirect()->route('welcome'); // Redirect ke welcome page
           }
       }

       // Ambil menu untuk guest
       $menus = Menu_client::where(function($query) {
           $query->where('role', 'guest');
       })
       ->where('is_active', true)
       ->orderBy('order')
       ->get();

       $token = $token;
       $email = $email;
       return view('reset-password', compact('menus','token','email'));
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->token, $user->remember_token)) {
            return response()->json(['errors' => ['token' => ['Token tidak valid']]], 422);
        }
        
        $user->update(['password' => Hash::make($request->password)]);
        $user->update(['comfir_email' => 1]);
        $user->update(['status_email' => 1]);

        return response()->json(['success' => true, 'message' => 'Password berhasil direset']);
    }


    public function viewconfirmEmail($token,$email)
    {
       if (Auth::check()) {
           // Pengguna sudah login
           $user = Auth::user();
           
           // Redirect berdasarkan role
           switch($user->role) {
               case 'candidate':
                   return redirect()->route('welcome');
               case 'company':
                   return redirect()->route('welcome');
               default:
                   return redirect()->route('welcome'); // Redirect ke welcome page
           }
       }

       // Ambil menu untuk guest
       $menus = Menu_client::where(function($query) {
           $query->where('role', 'guest');
       })
       ->where('is_active', true)
       ->orderBy('order')
       ->get();

       $token = $token;
       $email = $email;
       return view('confirm-email', compact('menus','token','email'));
    }

    public function confirmEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->token, $user->token)) {
            return response()->json(['errors' => ['token' => ['Token tidak valid']]], 422);
        }

        $user->update(['comfir_email' => 1]);
        $user->update(['status_email' => 1]);
       
        $user->save();
        return response()->json(['success' => true, 'message' => 'Password berhasil direset']);
    }
}
