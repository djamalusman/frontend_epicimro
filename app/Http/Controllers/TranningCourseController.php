<?php

namespace App\Http\Controllers;

use App\Models\JobVacancyDetailModel;
use App\Models\Dtc_Persyaratan_TrainingCourseModel;
use App\Models\dtc_File_TrainingCourseModel;
use App\Models\Dtc_Materi_TrainingCourseModel;
use App\Models\Dtc_Fasilitas_TrainingCourseModel;
use Illuminate\Support\Facades\Auth;    
use App\Models\TraningCourseDetailsModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Menu_client;
use App\Models\User;
use App\Models\ApplyTraining;

class TranningCourseController extends Controller
{
    public function courseList()
    {
        $data['title'] = 'Training';

        $dataCount = TraningCourseDetailsModel::where('status', 1)->get();
        $data['Counttraining'] = $dataCount->count();
        $data['filter'] = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
       return view('course.courselist', $data);
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
        return view('course.coursegrid', compact('title','menus', 'Counttraining', 'filter'));       
       
    }

    public function detailCourse($id, $slug, Request $request)
    {
        $title = 'Details Training';
        
        $listpersyaratan = Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $listmateri = Dtc_Materi_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $listfasilitas = Dtc_Fasilitas_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $listfiles = dtc_File_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $imagetraining = dtc_File_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->first();

        $detail = DB::table('dtc_training_course_detail')
            ->leftJoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course')
            ->leftJoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course')
            ->leftJoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
            ->leftJoin('m_provinsi', 'm_provinsi.id', '=', 'dtc_training_course_detail.id_provinsi')
            ->select(
                'dtc_training_course_detail.*',
                'm_category_training_course.nama as category',
                'm_jenis_sertifikasi_training_course.nama as cetificate_type',
                'm_type_training_course.nama as typeonlineofline',
                'm_provinsi.nama as provinsi'
            )
            ->where('dtc_training_course_detail.id', base64_decode($id))
            ->first();

        $imagemeta = dtc_File_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->first();

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

        $userEmail = session('email');
        $UserCleint = User::where('email', $userEmail)->first();
        $getdtApplyTraining= ApplyTraining::where('idtraining', base64_decode($id))->first();
        
        if ($getdtApplyTraining !=null || $getdtApplyTraining !="") {
            $getdtApplyTraining = User::where('id', $getdtApplyTraining->idusers)->first();
        }
        else
        {
            $getdtApplyTraining=null;
        }

        

        $description = '';
        if ($detail->tab_active == 1 && $detail->abouttraining != "") {
            $description = $detail->abouttraining;
        } elseif ($detail->tab_active == 2 && $detail->abouttrainer != "") {
            $description = $detail->abouttrainer;
        } elseif ($detail->tab_active == 3 && $detail->aboutcareer != "") {
            $description = $detail->aboutcareer;
        }
        $url = route('detail-course', ['id' => $id, 'slug' => $detail->traning_name]);
        $meta = [
            'title' => $detail->traning_name,
            'description' => $description,
            'image' => asset('https://admin.trainingkerja.com/public/storage/' . ($imagemeta->nama ?? '')),
            'url' => url()->current(),
        ];

        $share_buttons = \Share::page($meta['url'])
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();

        $meta = $meta;
        $share_buttons = $share_buttons;
        $getdataDetail   = $detail;
         return view('course.detailcourse', compact('title','menus','getdtApplyTraining','meta','role','getdataDetail','share_buttons','listpersyaratan','listmateri','listfasilitas','listfiles','imagetraining'));       
         //return view('course.detailcourse', $data);
    }



    public function getTabContent($id, $tabId)
    {
        // Decode ID yang diterima dalam base64
        $decodedId = base64_decode($id);

        // Validasi apakah ID kosong atau tidak valid
        if (empty($decodedId)) {
            return response()->json([
                'success' => false,
                'message' => 'ID tidak valid.'
            ]);
        }

        // Ambil data dari model terkait
        $listpersyaratan = Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl', $decodedId)->get();
        $listmateri = Dtc_Materi_TrainingCourseModel::where('id_training_course_dtl', $decodedId)->get();
        $listfasilitas = Dtc_Fasilitas_TrainingCourseModel::where('id_training_course_dtl', $decodedId)->get();
        $listfiles = dtc_File_TrainingCourseModel::where('id_training_course_dtl', $decodedId)->get();

        $datadetail = TraningCourseDetailsModel::where('id', $decodedId)->get();

        // Render HTML menggunakan Blade View
        if ($tabId == 1 ) {
            $htmlContent = view('partials.course.tab_content_about_training', compact('datadetail'))->render();
        }
        if ($tabId == 2 ) {
            $htmlContent = view('partials.course.tab_content_trainer', compact('datadetail'))->render();
        }
        if ($tabId == 3 ) {
            $htmlContent = view('partials.course.tab_content_career', compact('datadetail'))->render();
        }

        // Kembalikan hasil HTML dalam JSON
        return response()->json([
            'success' => true,
            'content' => $htmlContent
        ]);
    }






    public function loadDataCategory(Request $request)
    {
        $filtemployeeStatus = DB::table('m_category_training_course')->get();

        return response()->json($filtemployeeStatus);
    }
    public function loadDataCertificate(Request $request)
    {
        $filtercetificate = DB::table('m_jenis_sertifikasi_training_course')->get();

        return response()->json($filtercetificate);
    }

    public function loadDataType(Request $request)
    {
        $type = DB::table('m_type_training_course')->get();

        return response()->json($type);
    }

    public function getContentListCourse(Request $request)
    {
        $filters = $request->all();

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
                'm_type_training_course.nama as typeonlineofline',
                'm_provinsi.nama as nama_provinsi',
                'dtc_file_training_course.nama as image_path'
            );

        $whereData=$query;

        // Filter training name
        if (!empty($filters['trainingname']) && is_array($filters['trainingname'])) {
            $whereData->whereIn('dtc_training_course_detail.traning_name', $filters['trainingname']);

        } elseif (!empty($filters['trainingname']) && is_string($filters['trainingname'])) {
            $whereData->where('dtc_training_course_detail.traning_name', 'LIKE', '%' . $filters['trainingname'] . '%');
        }


        // Filter category
        if (!empty($filters['category']) && is_array($filters['category'])) {
            $whereData->whereIn('m_category_training_course.id', $filters['category']);
        } elseif (!empty($filters['category']) && is_string($filters['category'])) {
            $whereData->where('m_category_training_course.id', 'LIKE', '%' . $filters['category'] . '%');
        }

        if (!empty($filters['categoryTop']) && is_array($filters['categoryTop'])) {
            $whereData->whereIn('m_category_training_course.id', $filters['categoryTop']);
        } elseif (!empty($filters['categoryTop']) && is_string($filters['categoryTop'])) {
            $whereData->where('m_category_training_course.id', 'LIKE', '%' . $filters['categoryTop'] . '%');
        }

        // Filter Certificate
        if (!empty($filters['cetificatetype']) && is_array($filters['cetificatetype'])) {
            $whereData->whereIn('m_jenis_sertifikasi_training_course.id', $filters['cetificatetype']);
        } elseif (!empty($filters['cetificatetype']) && is_string($filters['cetificatetype'])) {
            $whereData->where('m_jenis_sertifikasi_training_course.id', 'LIKE', '%' . $filters['cetificatetype'] . '%');
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

        return response()->json([
            'content' => view('partials.course.content_course_list', ['data' => $data])->render(),
            'pagination' => view('partials.pagination', ['data' => $data])->render(),
            'showing' => $showing,
            'sort_and_view' => $sortAndView
        ]);
    }

    public function getContentGridCourse(Request $request)
    {
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
                'dtc_training_course_detail.updated_at'
            );

        $whereData=$query;

        // Filter training name
        if (!empty($filters['trainingname']) && is_array($filters['trainingname'])) {
            $whereData->whereIn('dtc_training_course_detail.traning_name', $filters['trainingname']);

        } elseif (!empty($filters['trainingname']) && is_string($filters['trainingname'])) {
            $whereData->where('dtc_training_course_detail.traning_name', 'LIKE', '%' . $filters['trainingname'] . '%');
        }
        //date
        // if (!empty($filters['datesearch']) && is_array($filters['datesearch'])) {
        //     // If datesearch contains an array, use whereDate for each value
        //     $whereData->where(function($query) use ($filters) {
        //         foreach ($filters['datesearch'] as $date) {
        //             $query->orWhereDate('dtc_training_course_detail.updated_at', '=', $date);
        //         }
        //     });
        // } elseif (!empty($filters['datesearch']) && is_string($filters['datesearch'])) {
        //     // If datesearch contains a single date string, apply whereDate directly
        //     $whereData->whereDate('dtc_training_course_detail.updated_at', '=', $filters['datesearch']);
        // }

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
            'content' => view('partials..course.content_course_grid', [
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


    public function registerCourse($id, $slug, Request $request)
    {
        $data['title'] = 'Details Training';

        $data['listpersyaratan'] = Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $data['listmateri'] = Dtc_Materi_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $data['listfasilitas'] = Dtc_Fasilitas_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $data['listfiles'] = dtc_File_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->get();
        $data['imagetraining'] = dtc_File_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->first();

        $detail = DB::table('dtc_training_course_detail')
            ->leftJoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course')
            ->leftJoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course')
            ->leftJoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
            ->leftJoin('m_provinsi', 'm_provinsi.id', '=', 'dtc_training_course_detail.id_provinsi')
            ->select(
                'dtc_training_course_detail.*',
                'm_category_training_course.nama as category',
                'm_jenis_sertifikasi_training_course.nama as cetificate_type',
                'm_type_training_course.nama as typeonlineofline',
                'm_provinsi.nama as provinsi'
            )
            ->where('dtc_training_course_detail.id', base64_decode($id))
            ->first();

        $imagemeta = dtc_File_TrainingCourseModel::where('id_training_course_dtl', base64_decode($id))->first();

        $description = '';
        if ($detail->tab_active == 1 && $detail->abouttraining != "") {
            $description = $detail->abouttraining;
        } elseif ($detail->tab_active == 2 && $detail->abouttrainer != "") {
            $description = $detail->abouttrainer;
        } elseif ($detail->tab_active == 3 && $detail->aboutcareer != "") {
            $description = $detail->aboutcareer;
        }
        $url = route('detail-course', ['id' => $id, 'slug' => $detail->traning_name]);
        $meta = [
            'title' => $detail->traning_name,
            'description' => $description,
            'image' => asset('https://admin.trainingkerja.com/public/storage/' . ($imagemeta->nama ?? '')),
            'url' => url()->current(),
        ];

        $share_buttons = \Share::page($meta['url'])
            ->facebook()
            ->twitter()
            ->linkedin()
            ->whatsapp();

        $data['meta'] = $meta;
        $data['share_buttons'] = $share_buttons;
        $data['getdataDetail'] = $detail;

        return view('course.registerCourse', $data);
    }
    public function getDatabackgroundeducation()
    {
        // Query ke database
        $options = \DB::table('m_background_education')
            ->select('id_background_education', 'nama_bgrd_edu') // Ambil kolom yang dibutuhkan
            ->get();

        // Kembalikan dalam format JSON
        return response()->json($options);
    }
}
