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
use App\Models\CompanyProfile;
use App\Models\Province;
use App\Models\Sector;

class UserCompanyController extends Controller
{
    public function profileEmployee()
    {
        
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
        
        // Get menus for candidate
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
        $userEmail = session('email');
        $userData = User::where('email', $userEmail)->firstOrFail();

        $companyprofiles = CompanyProfile::with('province', 'sector')->where('user_id', $user->id)->get();
        $provinces = Province::all();
        $sectors = Sector::all();

        
        $personalsummarys = User::where('users_client.id', $user->id)
        ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'users_client.id')
        ->leftJoin('m_provinsi', 'company_profiles.provinsi_id', '=', 'm_provinsi.id')
        ->leftJoin('m_sector', 'company_profiles.sector_id', '=', 'm_sector.id')
        ->orderBy('users_client.updated_at', 'desc')
        ->select('users_client.*', 'company_profiles.*','m_provinsi.id as provinsi_id', 'm_sector.id as sector_id','m_provinsi.nama as provinsi_name', 'm_sector.nama as sector_name') 
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

        return view('company.profilecompany', compact('user', 'menus', 'companyprofiles', 'provinces', 'sectors', 'personalsummarys' ,'experiences', 'educations', 'certifications','userData','skills'));
    }
    
    public function saveCompanyProfile(Request $request, $id = null)
    {
        try {
            // Validasi data
            $validatedData = $request->validate([
                'name' => 'nullable|string|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'password' => 'nullable',
                'phone' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'descriptionaddress' => 'nullable|string',
                'provinsi_id' => 'nullable',
                'sector_id' => 'nullable'
            ]);

            // Ambil user berdasarkan email dari session
            $userEmail = session('email');
            $user = User::where('email', $userEmail)->firstOrFail();

            // Ambil data CompanyProfile yang terkait dengan user
            $companyProfile = CompanyProfile::where('user_id', $user->id)->first();

            // Data yang akan diupdate di tabel users
            $updateData = [];

            // Cek perubahan di User (kecuali password & foto)
            foreach ($validatedData as $key => $value) {
                if ($value !== null && $key !== 'password' && $key !== 'photo' && $user->$key !== $value) {
                    $updateData[$key] = $value;
                }
            }

            // **Cek jika ada file foto diupload**
            if ($request->hasFile('photo')) {
                $fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
                $destinationPath = public_path('storage');
                $request->file('photo')->move($destinationPath, $fileName);

                if ($user->photo !== $fileName) {
                    $user->photo = $fileName;
                }
            }

            // Jika ada perubahan, update User
            if (!empty($updateData) || $user->isDirty('photo')) {
                $user->update($updateData);
                $user->save();
            }

            // **Cek perubahan di CompanyProfile**
            $companyProfileData = [
                'user_id' => $user->id,
                'provinsi_id' => $validatedData['provinsi_id'] ?? null,
                'sector_id' => $validatedData['sector_id'] ?? null,
                'company_address' => $validatedData['descriptionaddress'] ?? null
            ];

            if ($companyProfile) {
                // **Update jika ada perubahan**
                if (
                    $companyProfile->provinsi_id !== $companyProfileData['provinsi_id'] ||
                    $companyProfile->sector_id !== $companyProfileData['sector_id']
                ) {
                    $companyProfile->update($companyProfileData);
                }
            } else {
                // **Buat baru jika belum ada**
                CompanyProfile::create($companyProfileData);
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


    
}
