<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\ApplyTraining;
use App\Models\SkillCandidate;
use App\Models\ApplyJob;
use App\Models\McategoryTraining;
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
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;

class UserCandidateController extends Controller
{
     // Menampilkan halaman login
     public function showLoginForm()
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

        return view('formlogin', compact('menus'));
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
             session(['id' => $user->id,'email' => $user->email, 'name' => $user->name,'lastname' => $user->lastname,'phone' => $user->phone,'photouser' => $user->photo],);
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
             'username' => 'nullable|string',
             'email' => 'required|email',
             'password' => 'nullable|string',
             'employeeId' => 'nullable|string',
         ]);
        //  dd($request->all());
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
         
         $role = $request->companyId ? 'company' : 'candidate';

         // Buat user baru
         User::create([
             'name' => $request->username,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'role' => $role,
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
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
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


    public function profileCandidate()
    {
        $user = Auth::user();
        
        // Get menus for candidate
        $menus = Menu_client::where(function($query) {
            $query->where('role', 'candidate');
        })
        ->where('is_active', true)
        ->orderBy('order')
        ->get();
        $userEmail = session('email');
        $userData = User::where('email', $userEmail)->firstOrFail();

        

        $personalsummarys = User::where('id', $user->id)
                               ->orderBy('updated_at', 'desc')
                               ->get();

        $personalsummarys = User::where('id', $user->id)
                               ->orderBy('updated_at', 'desc')
                               ->get();

        // Get experiences, educations, and certifications
        $experiences = Experience::where('user_id', $user->id)
                               ->orderBy('start_date', 'desc')
                               ->get();
                               
        $educations = Education::where('user_id', $user->id)
                             ->orderBy('start_date', 'desc')
                             ->get();
                             
        $certifications = Certification::where('user_id', $user->id)
                                    ->orderBy('issue_date', 'desc')
                                    ->get();

        $skills = SkillCandidate::where('user_id', $user->id)->get();

        return view('candidate.profile', compact('user', 'menus','personalsummarys' ,'experiences', 'educations', 'certifications','userData','skills'));
    }

    public function saveExperience(Request $request, $id = null)
    {
        
        try {
            $data = $request->validate([
                'position' => 'required|string|max:255',
                'company' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'description' => 'nullable|string',
                'is_current' => 'nullable|boolean'
            ]);

            $data['user_id'] = auth()->id();
            
            // Handle is_current and end_date
            $data['is_current'] = $request->has('is_current');
            if ($data['is_current']) {
                $data['end_date'] = null;
            }
            
            if ($id) {
                $experience = Experience::findOrFail($id);
                
                // Check if the experience belongs to the authenticated user
                if ($experience->user_id !== auth()->id()) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                
                $experience->update($data);
            } else {
                $experience = Experience::create($data);
            }

            // Reload the experience to get the formatted dates
            $experience = Experience::find($experience->id);

            return response()->json([
                'message' => $id ? 'Experience updated successfully' : 'Experience added successfully',
                'data' => $experience
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $id ? 'Failed to update experience' : 'Failed to add experience',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteExperience($id)
    {
        try {
            $experience = Experience::findOrFail($id);
            
            // Check if the experience belongs to the authenticated user
            if ($experience->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $experience->delete();
            return response()->json(['message' => 'Experience deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete experience'], 500);
        }
    }

    public function saveSummaryPersonal(Request $request, $id = null)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'lastname' => 'nullable|string|max:255',
                'password' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'phone' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'lokasi' => 'nullable|string',
            ]);

            // Ambil user berdasarkan email dari session
            $userEmail = session('email');
            $user = User::where('email', $userEmail)->firstOrFail();

            // Data yang akan diupdate
            $updateData = [];
            $passwordChanged = false;

            // Cek jika ada perubahan di field selain password & foto
            foreach ($validatedData as $key => $value) {
                if ($value !== null && $key !== 'password' && $key !== 'photo' && $user->$key !== $value) {
                    $updateData[$key] = $value;
                }
            }

            // **Cek apakah ada file foto diupload**
            if ($request->hasFile('photo')) {
                $FileName = time() . '_' . $request->file('photo')->getClientOriginalName();
                $destinationPath = public_path('storage');
                $request->file('photo')->move($destinationPath, $FileName);
                
                if ($user->photo !== $FileName) {
                    $user->photo = $FileName;
                }
            }

            // **Cek apakah password diubah**
            if (!empty($validatedData['password']) && !Hash::check($validatedData['password'], $user->password)) {
                $updateData['password'] = Hash::make($validatedData['password']);
                $passwordChanged = true;
            }

            // Jika ada perubahan, lakukan update
            if (!empty($updateData) || $user->isDirty('photo')) {
                $user->update($updateData);
                $user->save();
            }

            // Jika password diubah, redirect ke logout
            if ($passwordChanged) {
                Auth::logout();
                return response()->json([
                    'message' => 'Password changed, please log in again.'
                ], 401);
            }

            return response()->json([
                'message' => 'Profile updated successfully',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update profile',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    
    public function storeSkill(Request $request)
    {
        $request->validate([
            'skill_name' => 'required|string|max:255',
        ]);

        $skill = SkillCandidate::create([
            'user_id' => Auth::id(),
            'skill_name' => $request->skill_name,
        ]);

        return response()->json($skill);
    }

    public function search(Request $request)
    {
        $skills = McategoryTraining::where('nama', 'LIKE', "%{$request->term}%")
                        ->pluck('nama')
                        ->toArray();
        return response()->json($skills);
    }

    public function destroySkill($id)
    {
        $skill = SkillCandidate::findOrFail($id);

        if ($skill->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $skill->delete();
        return response()->json(['message' => 'Skill deleted successfully']);
    }




    


}
