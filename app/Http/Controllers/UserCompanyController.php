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
        
        // Get menus for candidate
        $menus = Menu_client::where(function($query) {
            $query->where('role', 'candidate');
        })
        ->where('is_active', true)
        ->orderBy('order')
        ->get();
        $userEmail = session('email');
        $userData = User::where('email', $userEmail)->firstOrFail();

        $companyprofile = CompanyProfile::with('province', 'sector')->where('user_id', $user->id)->get();
        $provinces = Province::all();
        $sectors = Sector::all();

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

        return view('employee.profileemployee', compact('user', 'menus', 'companyprofile', 'provinces', 'sectors', 'personalsummarys' ,'experiences', 'educations', 'certifications','userData','skills'));
    }

    public function saveCompanyProfile(Request $request, $id = null)
    {
        
        try {
            $data = $request->validate([
                'company_name' => 'nullable|string|max:100',
                'company_address' => 'nullable|string|max:100',
                'company_email' => 'nullable|string|max:100',
                'phone_number' => 'nullable|regex:/^(\+62|62|0)[0-9]{9,12}$/|max:13',   // phone number validation
                'company_overview' => 'nullable|string|max:65535',                      // description validation text
                'province_id' => 'nullable|integer|exists:provinces,id',                // province_id validation
                'sector_id' => 'nullable|integer|exists:sectors,id'                     // sector_id validation
            ]);

            $data['user_id'] = auth()->id();
            
            if ($id) {
                $companyprofile = CompanyProfile::findOrFail($id);
                
                // Check if the experience belongs to the authenticated user
                if ($companyprofile->user_id !== auth()->id()) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                
                $companyprofile->update($data);
            } else {
                $companyprofile = CompanyProfile::create($data);
            }

            // Reload the experience to get the formatted dates
            $companyprofile = CompanyProfile::find($companyprofile->id);

            return response()->json([
                'message' => $id ? 'Company profile updated successfully' : 'Company profile added successfully',
                'data' => $companyprofile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $id ? 'Failed to update company profile' : 'Failed to add company profile',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
