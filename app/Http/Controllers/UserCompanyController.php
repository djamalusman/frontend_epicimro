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
use App\Models\JobVacancyDetailModel;
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
use Faker\Factory as Faker;
use App\Jobs\SendRegistrationEmail;

class UserCompanyController extends Controller
{

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

       return view('formlogincompany', compact('menus'));
    }

    // public function signUp(Request $request)
    // {
    //     try {
    //         // Validasi data form registrasi
    //         $validator = Validator::make($request->all(), [
    //             'username' => 'nullable|string',
    //             'email' => 'required|email',
    //             'password' => 'nullable|string',
    //             'employeeId' => 'nullable|string',
    //             'privacypolicy' => 'required|boolean',
    //         ]);

    //         if ($validator->fails()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'error' => $validator->errors()->first(),
    //             ], 422);
    //         }

    //         // Periksa apakah email sudah terdaftar
    //         if (User::whereRaw('LOWER(email) = ?', [strtolower($request->email)])->exists()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'error' => 'Email sudah terdaftar!',
    //             ], 409);
    //         }

    //         // Generate ID user
    //         $faker = Faker::create();
    //         $randomMixed = $faker->regexify('[A-Z]{3}[0-9]{3}');

    //         // Buat user baru
    //         $user = User::create([
    //             'name' => $request->username,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //             'role' => 'company',
    //             'privacypolicy' => true,
    //             'remember_token' => $randomMixed,
    //         ]);

    //         // Kirim email
    //         try {
    //             Mail::to($user->email)->send(new RegistrationSuccessMail($user, $request->password));

    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Registration successful! Email sent.',
    //             ], 201);
    //         } catch (\Exception $e) {
    //             return response()->json([
    //                 'success' => true,
    //                 'message' => 'Registration successful! But failed to send email.',
    //                 'email_error' => $e->getMessage(),
    //             ], 200);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'success' => false,
    //             'error' => 'Something went wrong!',
    //             'details' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function signUp(Request $request)
    {
        try {
            // Validasi data form registrasi
            $validator = Validator::make($request->all(), [
                'username' => 'nullable|string',
                'email' => 'required|email',
                'password' => 'nullable|string',
                'employeeId' => 'nullable|string',
                'privacypolicy' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'error' => $validator->errors()->first(),
                ], 422);
            }

            // Periksa apakah email sudah terdaftar
            if (User::whereRaw('LOWER(email) = ?', [strtolower($request->email)])->exists()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Email sudah terdaftar!',
                ], 409);
            }

            // Generate ID user
            $faker = Faker::create();
            $randomMixed = $faker->regexify('[A-Z]{3}[0-9]{3}');

            // Buat user baru
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'company',
                'privacypolicy' => true,
                'remember_token' => $randomMixed,
            ]);

            // Dispatch Job ke Queue
            //dispatch(new SendRegistrationEmail($user, $request->password));

            return response()->json([
                'success' => true,
                'message' => 'Registration successful! Email will be sent shortly.',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Something went wrong!',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required|min:6',
         ]);
     
         $credentials = $request->only('email', 'password');
         $user = User::where('email', $request->email)->first();
         if ($user && Hash::check($request->password, $user->password)) {
            if ($user->comfir_email != null) {
                if (Auth::attempt($credentials)) {
                    $user = Auth::user();
        
                    // Login sukses
                    session([
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                        'lastname' => $user->lastname,
                        'phone' => $user->phone,
                        'photouser' => $user->photo,
                    ]);
        
                    return response()->json(['message' => 'Login successful'], 200);
                } 
                else {
                    return response()->json(['error' => 'Login failed. Please check your credentials.'], 401);
                }
            }
                
             else {
                 return response()->json(['error' => 'Akun Anda belum dikonfirmasi. Silakan periksa kembali email Anda!'], 401);
             }
         } 
     
         return response()->json(['error' => 'Email atau password salah.'], 422);
     }

    
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
                'company_address' => 'nullable|string',
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
                'company_address' => $validatedData['company_address'] ?? null
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

    public function CourseGrid()
    {
        $title = 'Training';
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
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
        $dataCount = TraningCourseDetailsModel::where('status', 1)->get();
        $Counttraining = $dataCount->count();
        $filter = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
        return view('company.coursegrid', compact('title','menus', 'Counttraining', 'filter'));       
       
    }

    public function getContentGridCourse(Request $request)
    {
        $user = Auth::user();
        $filters = $request->all();
        //dd($request->all());
        $query = DB::table('dtc_training_course_detail')
            ->leftjoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course') // Bergabung dengan tabel tipe_master
            ->leftjoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course') // Bergabung dengan tabel ifg_master_tipe
            ->leftjoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
            ->leftjoin('m_provinsi', 'm_provinsi.id', '=', 'dtc_training_course_detail.id_provinsi')
            ->leftJoin(DB::raw('(
                SELECT *
                FROM dtc_file_training_course
                WHERE id IN (
                    SELECT MIN(id)
                    FROM dtc_file_training_course
                    GROUP BY id_training_course_dtl
                )
            ) AS dtc_file_training_course'), 'dtc_file_training_course.id_training_course_dtl', '=', 'dtc_training_course_detail.id')
            ->select('dtc_training_course_detail.*',
                'm_category_training_course.nama as category',
                'm_jenis_sertifikasi_training_course.nama as cetificate_type',
                'm_type_training_course.nama as namaonlineofline',
                'm_provinsi.nama as nama_provinsi',
                'dtc_file_training_course.nama as image_path',
                'dtc_file_training_course.fileold as fileold',
                'dtc_training_course_detail.updated_at'
            );

        $whereData=$query;

        $whereData->whereIn('dtc_training_course_detail.idcompany', [$user->id]);
        // Filter training name
        if (!empty($filters['trainingname']) && is_array($filters['trainingname'])) {
            $whereData->whereIn('dtc_training_course_detail.traning_name', $filters['trainingname']);

        } elseif (!empty($filters['trainingname']) && is_string($filters['trainingname'])) {
            $whereData->where('dtc_training_course_detail.traning_name', 'LIKE', '%' . $filters['trainingname'] . '%');
        }
        if (!empty($filters['datesearch'])) {
            // Periksa apakah $filters['datesearch'] adalah string yang berisi ' to '
            if (is_string($filters['datesearch']) && strpos($filters['datesearch'], ' to ') !== false) {
                // Pisahkan tanggal dengan ' to '
                $dates = explode(' to ', $filters['datesearch']);

                if (count($dates) == 2) {
                    // Filter berdasarkan rentang antara startdate dan enddate
                    $whereData->where(function ($query) use ($dates) {
                        $query->whereBetween('dtc_training_course_detail.startdate', [$dates[0], $dates[1]])
                              ->orWhereBetween('dtc_training_course_detail.enddate', [$dates[0], $dates[1]]);
                    });
                } elseif (count($dates) == 1) {
                    // Jika hanya ada satu tanggal, gunakan whereDate untuk mencari tanggal tertentu
                    $whereData->whereDate('dtc_training_course_detail.startdate', '=', $dates[0]);
                }
            } elseif (is_string($filters['datesearch'])) {
                // Jika 'datesearch' berisi string tanggal tunggal, gunakan whereDate untuk mencari tanggal tertentu
                $whereData->whereDate('dtc_training_course_detail.startdate', '=', $filters['datesearch']);
            }
        }



        // Filter category
        if (!empty($filters['category']) && is_array($filters['category'])) {
            $whereData->whereIn('m_category_training_course.id', $filters['category']);
        } elseif (!empty($filters['category']) && is_string($filters['category'])) {
            $categoryValue = intval($filters['category']);
            $whereData->where('m_category_training_course.id', $categoryValue);
        }
        if (!empty($filters['categoryTop']) && is_array($filters['categoryTop'])) {
            $whereData->whereIn('m_category_training_course.id', $filters['categoryTop']);
        } elseif (!empty($filters['categoryTop']) && is_string($filters['categoryTop'])) {
            $whereData->where('m_category_training_course.id', 'LIKE', '%' . $filters['categoryTop'] . '%');
        }

        // Filter provinsi
        if (!empty($filters['provinsi']) && is_array($filters['provinsi'])) {
            $whereData->whereIn('m_provinsi.id', $filters['provinsi']);
        } elseif (!empty($filters['provinsi']) && is_string($filters['provinsi'])) {
            $whereData->where('m_provinsi.id', 'LIKE', '%' . $filters['provinsi'] . '%');
        }
        if (!empty($filters['provinsiTop']) && is_array($filters['provinsiTop'])) {
            $whereData->whereIn('m_provinsi.id', $filters['provinsiTop']);
        } elseif (!empty($filters['provinsiTop']) && is_string($filters['provinsiTop'])) {
            $whereData->where('m_provinsi.id', 'LIKE', '%' . $filters['provinsiTop'] . '%');
        }

        // Filter Certificate
        if (!empty($filters['cetificatetype']) && is_array($filters['cetificatetype'])) {
            $whereData->whereIn('m_jenis_sertifikasi_training_course.id', $filters['cetificatetype']);
        } elseif (!empty($filters['cetificatetype']) && is_string($filters['cetificatetype'])) {
            $whereData->where('m_jenis_sertifikasi_training_course.id', 'LIKE', '%' . $filters['cetificatetype'] . '%');
        }

        // Filter status
        if (!empty($filters['status']) && is_array($filters['status'])) {
            $whereData->whereIn('dtc_training_course_detail.status', $filters['status']);
        } elseif (!empty($filters['status']) && is_string($filters['status'])) {
            $statusValue = intval($filters['status']);
            $whereData->where('dtc_training_course_detail.status', $statusValue);
        }
        if (!empty($filters['statusTop']) && is_array($filters['statusTop'])) {
            $whereData->whereIn('dtc_training_course_detail.status', $filters['statusTop']);
        } elseif (!empty($filters['statusTop']) && is_string($filters['statusTop'])) {
            $whereData->where('dtc_training_course_detail.status', 'LIKE', '%' . $filters['statusTop'] . '%');
        }
        // Filter Type Course
        if (!empty($filters['type']) && is_array($filters['type'])) {
            $whereData->whereIn('m_type_training_course.id', $filters['type']);
        } elseif (!empty($filters['type']) && is_string($filters['type'])) {
            $whereData->where('m_type_training_course.id', 'LIKE', '%' . $filters['type'] . '%');
        }
        if (!empty($filters['typeTop']) && is_array($filters['typeTop'])) {
            $whereData->whereIn('m_type_training_course.id', $filters['typeTop']);
        } elseif (!empty($filters['typeTop']) && is_string($filters['typeTop'])) {
            $whereData->where('m_type_training_course.id', 'LIKE', '%' . $filters['typeTop'] . '%');
        }

        // Apply filters and sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'newest':
                    $whereData->orderBy('dtc_training_course_detail.updated_at', 'desc');
                    break;
                case 'oldest':
                    $whereData->orderBy('dtc_training_course_detail.updated_at', 'asc');
                    break;
                //case 'rating':
                //    $query->orderBy('djv_job_vacancy_detail.rating', 'desc'); // Assuming there's a rating column
                //    break;
            }
        } else {
            $whereData->orderBy('dtc_training_course_detail.updated_at', 'desc'); // Default sort
        }

        $perPage = 3;
        $page = $request->input('page', 1);
        $data = $whereData->paginate($perPage, ['*'], 'page', $page);

        // Calculate the range of the items shown
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());

        // Render the 'showing' view with the calculated range
        $showing = view('partials.showing', [
            'from' => $from,
            'to' => $to,
            'total' => $data->total()
        ])->render();

        $sortAndView = view('partials.sort_and_view', [
            'sortBy' => $filters['sortBy'] ?? 'Newest Post'
        ])->render();
        $listfiles = dtc_File_TrainingCourseModel::orderBy('nama', 'asc')->get();
        return response()->json([
            'content' => view('partials..company.content_course_grid', [
                'data' => $data,
                'listfiles' => $listfiles
            ])->render(),
            'pagination' => view('partials.pagination', [
                'data' => $data
            ])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);

    }
    
    public function JobGrid(Request $request)
    {
      
        $title = 'Jobs';
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
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

        $dataCount = JobVacancyDetailModel::where('status', 1)->get();

        $CountJob = $dataCount->count();

        $filter = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();

        return view('company.jobgrid', compact('title','menus', 'dataCount', 'CountJob', 'filter'));

    }
    
    public function getContentJobGrid(Request $request)
    {
        $user = Auth::user();
        $filters = $request->all();
        //dd($filters);
        $query = DB::table('djv_job_vacancy_detail')
            ->leftJoin('m_employee_status', 'djv_job_vacancy_detail.id_m_employee_status', '=', 'm_employee_status.id')
            ->leftJoin('m_work_location', 'm_work_location.id', '=', 'djv_job_vacancy_detail.id_m_work_location')
            ->leftJoin('m_salary_date_month', 'm_salary_date_month.id', '=', 'djv_job_vacancy_detail.id_m_salaray_date_mont')
            ->leftJoin('m_salary', 'm_salary.id', '=', 'djv_job_vacancy_detail.id_m_salaray')
            ->leftJoin('m_sector', 'm_sector.id', '=', 'djv_job_vacancy_detail.id_m_sector')
            ->leftJoin('m_education', 'm_education.id', '=', 'djv_job_vacancy_detail.id_m_education')
            ->leftJoin('m_experience_level', 'm_experience_level.id', '=', 'djv_job_vacancy_detail.id_m_experience_level')
            ->leftJoin('m_provinsi', 'm_provinsi.id', '=', 'djv_job_vacancy_detail.id_provinsi')
            ->where('djv_job_vacancy_detail.idcompany',$user->id)
            ->select(
                'djv_job_vacancy_detail.*',
                'm_employee_status.nama as nama_status',
                'm_work_location.nama as work_location',
                'm_salary_date_month.nama as fee',
                'm_salary.nama as salary',
                'm_sector.nama as sector',
                'm_education.nama as education',
                'm_experience_level.nama as name_experience_level',
                'm_provinsi.nama as namaprovinsi'
            );
        $whereData=$query->where('djv_job_vacancy_detail.status',1);
        // dd($filters);
        // filter job title
        if (!empty($filters['jobtitle']) && is_array($filters['jobtitle'])) {
            $whereData->whereIn('djv_job_vacancy_detail.job_title', $filters['jobtitle']);
        } elseif (!empty($filters['jobtitle']) && is_string($filters['jobtitle'])) {
            $whereData->where('djv_job_vacancy_detail.job_title', 'LIKE', '%' . $filters['jobtitle'] . '%');
        }

        //date
        if (!empty($filters['datesearchJob'])) {
            // Periksa apakah $filters['datesearch'] adalah string yang berisi ' to '
            if (is_string($filters['datesearchJob']) && strpos($filters['datesearchJob'], ' to ') !== false) {
                // Pisahkan tanggal dengan ' to '
                $dates = explode(' to ', $filters['datesearchJob']);

                if (count($dates) == 2) {
                    // Filter berdasarkan rentang antara startdate dan enddate
                    $whereData->where(function ($query) use ($dates) {
                        $query->whereBetween('djv_job_vacancy_detail.posted_date', [$dates[0], $dates[1]])
                              ->orWhereBetween('djv_job_vacancy_detail.close_date', [$dates[0], $dates[1]]);
                    });
                } elseif (count($dates) == 1) {
                    // Jika hanya ada satu tanggal, gunakan whereDate untuk mencari tanggal tertentu
                    $whereData->whereDate('djv_job_vacancy_detail.posted_date', '=', $dates[0]);
                }
            } elseif (is_string($filters['datesearchJob'])) {
                // Jika 'datesearch' berisi string tanggal tunggal, gunakan whereDate untuk mencari tanggal tertentu
                $whereData->whereDate('djv_job_vacancy_detail.posted_date', '=', $filters['datesearchJob']);
            }
        }

        // filter lokasi
        if (!empty($filters['location']) && is_array($filters['location'])) {
            $whereData->whereIn('djv_job_vacancy_detail.lokasi', $filters['location']);
        } elseif (!empty($filters['location']) && is_string($filters['location'])) {
            $whereData->where('djv_job_vacancy_detail.lokasi', 'LIKE', '%' . $filters['location'] . '%');
        }
        // Filter Job type
        if (!empty($filters['employeeStatusSelect']) && is_array($filters['employeeStatusSelect'])) {
            $whereData->whereIn('m_employee_status.nama', $filters['employeeStatusSelect']);
        } elseif (!empty($filters['employeeStatusSelect']) && is_string($filters['employeeStatusSelect'])) {
            $whereData->where('m_employee_status.nama', 'LIKE', '%' . $filters['employeeStatusSelect'] . '%');
        }

        if (!empty($filters['employeeStatus']) && is_array($filters['employeeStatus'])) {
            $whereData->whereIn('m_employee_status.nama', $filters['employeeStatus']);
        } elseif (!empty($filters['employeeStatus']) && is_string($filters['employeeStatus'])) {
            $whereData->where('m_employee_status.nama', 'LIKE', '%' . $filters['employeeStatus'] . '%');
        }

        // Filter salary range
        if (!empty($filters['salaryRange']) && is_array($filters['salaryRange'])) {
            $whereData->whereIn('m_salary.nama', $filters['salaryRange']);
        } elseif (!empty($filters['salaryRange']) && is_string($filters['salaryRange'])) {
            $whereData->where('m_salary.nama', 'LIKE', '%' . $filters['salaryRange'] . '%');
        }

        // Filter salary range Top
        if (!empty($filters['salaryRangeTop']) && is_array($filters['salaryRangeTop'])) {
            $whereData->whereIn('m_salary.nama', $filters['salaryRangeTop']);
        } elseif (!empty($filters['salaryRangeTop']) && is_string($filters['salaryRangeTop'])) {
            $whereData->where('m_salary.nama', 'LIKE', '%' . $filters['salaryRangeTop'] . '%');
        }

        // Filter worklocation
        if (!empty($filters['placement']) && is_array($filters['placement'])) {
            $whereData->whereIn('m_work_location.nama', $filters['placement']);
        } elseif (!empty($filters['placement']) && is_string($filters['placement'])) {
            $whereData->where('m_work_location.nama', 'LIKE', '%' . $filters['placement'] . '%');
        }

        // Filter experience level
        if (!empty($filters['experiencelevel']) && is_array($filters['experiencelevel'])) {
            $whereData->whereIn('m_experience_level.nama', $filters['experiencelevel']);
        } elseif (!empty($filters['experiencelevel']) && is_string($filters['experiencelevel'])) {
            $whereData->where('m_experience_level.nama', 'LIKE', '%' . $filters['experiencelevel'] . '%');
        }



        // Apply filters and sorting
        if (!empty($filters['sortBy'])) {
            switch ($filters['sortBy']) {
                case 'newest':
                    $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'desc');
                    break;
                case 'oldest':
                    $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'asc');
                    break;
                //case 'rating':
                //    $query->orderBy('djv_job_vacancy_detail.rating', 'desc'); // Assuming there's a rating column
                //    break;
            }
        } else {
            $whereData->orderBy('djv_job_vacancy_detail.updated_at', 'desc'); // Default sort
        }

        $perPage = 3;
        $page = $request->input('page', 1);
        $data = $whereData->paginate($perPage, ['*'], 'page', $page);

        // Calculate the range of the items shown
        $from = ($data->currentPage() - 1) * $data->perPage() + 1;
        $to = min($data->currentPage() * $data->perPage(), $data->total());

        // Render the 'showing' view with the calculated range
        $showing = view('partials.showing', [
            'from' => $from,
            'to' => $to,
            'total' => $data->total()
        ])->render();

        $sortAndView = view('partials.sort_and_view', [
            'sortBy' => $filters['sortBy'] ?? 'Newest Post'
        ])->render();

        //$listfiles = JobFileModel::orderBy('nama', 'asc')->get();

        return response()->json([
            'content' => view('partials.company.content_job_grid', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);

    }

}
