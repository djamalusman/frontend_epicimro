<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessMail;
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
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;

class UserCandidateController extends Controller
{
     // Menampilkan halaman login
     public function showLoginForm()
     {
        if (Auth::check()) {
            // Pengguna sudah login
            $user = Auth::user(); // Mengambil data pengguna yang sedang login
            $ApplyJobCount = ApplyJob::count(); 
            $ApplyTrainingCount = ApplyTraining::count(); 
            $data = [
              
                'title' => 'Dashboard',
                'applyJobCount' =>$ApplyJobCount,
                'applyTrainingCount' => $ApplyTrainingCount,
            ];
            // Ambil menu client
                $menus = Menu_client::whereNull('parent_id')
                ->with('children')
                ->orderBy('order')
                ->get();    

            // URL saat ini
            $currentUrl = url()->current();
            $response = response()->view('template2.login', compact('data', 'menus', 'currentUrl'));
            return redirect()->route('dashboardindex');
        } else {
            return view('template1.formlogin');
        }

     }

     // Handle Login
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required|min:6',
         ]);

         $credentials = $request->only('email', 'password');
         $user = User::where('email', $request->email)->first();
         if (Auth::attempt($credentials)) {
            $user = Auth::user();

             // Login sukses
             session(['email' => $user->email, 'name' => $user->name,'lastname' => $user->lastname,'phone' => $user->phone,'photouser' => $user->photo],);
             return response()->json(['message' => 'Login successful']);
         } else {
             // Login gagal
             return response()->json(['error' => 'Invalid credentials']);
         }
     }

     // Handle Signup
    public function signUp(Request $request)
     {
         // Validasi data form registrasi
         $validator = Validator::make($request->all(), [
             'username' => 'required',
             'email' => 'required|email',
             'password' => 'required', // Validasi password minimal 6 karakter
         ]);

         // Jika validasi gagal
         if ($validator->fails()) {
             return response()->json([
                 'error' => $validator->errors()->first(),
             ]);
         }

         // Periksa apakah email sudah terdaftar
         if (User::whereRaw('LOWER(email) = ?', [strtolower($request->email)])->exists()) {
             return response()->json([
                 'error' => 'Email sudah terdaftar!',
             ]);
         }

         // Generate ID user
         $no = User::count() + 1;

         // Buat user baru
         User::create([
             'name' => $request->username,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
         $user = User::where('email', $request->email)->first();
         //dd($user);
         if ($user) {
            try {
                Mail::to($user->email)->send(new RegistrationSuccessMail($user,$request->password));
    
                return response()->json([
                    'message' => 'Registration successful! Email sent.',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Registration successful! But failed to send email.',
                    'error' => $e->getMessage(),
                ]);
            }
        }

         // Berikan respons sukses
         return response()->json([
             'message' => 'Registration successful!',
         ]);
     }

     // Logout
    public function logout()
    {
        // Menghapus session email jika ada
        Session::flush();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login');
    }

    public function redirectToLogin()
    {
        session()->flash('session_expired', 'Your session has expired. Please log in again.');
        return redirect()->route('login');
    }


    public function profleclientindex(Request $request)
    {
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();
        $ApplyJobCount = ApplyJob::count(); 
        $ApplyTrainingCount = ApplyTraining::count(); 
        $totalTransaksi= $ApplyJobCount + $ApplyTrainingCount;
        // Siapkan data yang akan dikirim ke view
        $data = [
            'user_name' => $userEmail,
            'title' => 'Profile',
            'getdtUserClient' => $getdtUserClient,
            'applyJobCount' =>$ApplyJobCount,
            'applyTrainingCount' => $ApplyTrainingCount,
            'totalTransaksi' => $totalTransaksi
        ];
        
        // Ambil menu client
        $menus = Menu_client::whereNull('parent_id')
            ->with('children')
            ->orderBy('order')
            ->get();

        // URL saat ini
        $currentUrl = url()->current();

        // Kirim ke view
        $response = response()->view('template2.users.profleclientindex', compact('data', 'menus', 'currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;

    }

    public function updtaeUserClient(Request $request)
    {
            
            // Cari user berdasarkan email yang dikirim dari form
            $userEmail = session('email');
            $user = User::where('email', $userEmail)->first();
           
            // Jika user tidak ditemukan, kirim error
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found!']);
            }

            // Simpan data lama untuk perbandingan
            $oldData = [
                'name' => $user->name,
                'lastname' => $user->lastname,
                'phone' => $user->phone,
                'bio' => $user->bio,
            ];

            // Simpan data baru dari request
            $newData = [
                'name' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'bio' => $request->bio,
            ];

            // Cek apakah ada perubahan data
            if ($oldData == $newData && !$request->hasFile('photo') && empty($request->password)) {
                return response()->json(['success' => false, 'message' => 'No changes detected']);
            }

            // Update data jika ada perubahan
            $user->name = $request->firstname;
            $user->lastname = $request->lastname;
            $user->phone = $request->phone;
            $user->bio = $request->bio;

            // Update password hanya jika diisi
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            // Jika ada file foto baru diunggah, update foto
            if ($request->hasFile('photo')) {
                $FileName = time() . '_' . $request->file('photo')->getClientOriginalName();
                $destinationPath = public_path('../public/storage');
                $request->file('photo')->move($destinationPath, $FileName);
                
               
                $user->photo = $FileName;
            }

            // Simpan perubahan ke database
            $user->save();

            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
    }

    

    public function getdtUserclient()
    {
        $userEmail = session('email');
        $user = User::where('email', $userEmail)->first(); 
        
        return response()->json([
            'firstname' => $user->name,
            'lastname' => $user->lastname,
            'email' => $user->email,
            'phone' => $user->phone,
            'bio' => $user->bio,
            'password' => $user->password, 
            'photo' => $user->photo ? asset('storage/' . $user->photo) : asset('assets2/img/avatar/avatar-1.png'),
           
        ]);
    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        try {
            $token = Str::random(60);
            $user->remember_token = $token;
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user, $token));

            return back()->with('success', 'Link reset password telah dikirim ke email Anda');
        } catch (\Exception $e) {
            Log::error('Email error: '.$e->getMessage());
            return back()->with('error', 'Gagal mengirim email. Silakan coba lagi nanti.');
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $user = User::where('remember_token', $request->token)->first();

        if (!$user) {
            return back()->withErrors(['token' => 'Token tidak valid']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'remember_token' => null
        ]);

        return redirect()->route('login')->with('status', 'Password berhasil direset');
    }
}
