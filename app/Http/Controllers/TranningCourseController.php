<?php

namespace App\Http\Controllers;

use App\Models\JobVacancyDetailModel;
use App\Models\Dtc_Persyaratan_TrainingCourseModel;
use App\Models\dtc_File_TrainingCourseModel;
use App\Models\Dtc_Materi_TrainingCourseModel;
use App\Models\Dtc_Fasilitas_TrainingCourseModel;
use App\Models\TrainingCourseDetailModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TranningCourseController extends Controller
{
    public function courseList()
    {
        $data['title'] = 'Training';

        $dataCount = TrainingCourseDetailModel::where('status', 1)->get();
        $data['Counttraining'] = $dataCount->count();
        $data['filter'] = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
       return view('course.courselist', $data);
    }

    public function CourseGrid()
    {
        $data['title'] = 'Training';

        $dataCount = TrainingCourseDetailModel::where('status', 1)->get();
        $data['Counttraining'] = $dataCount->count();
        $data['filter'] = DB::table('m_employee_status')
            ->select(
                'm_employee_status.nama as employees_status'
            )->get();
       return view('course.coursegrid', $data);
    }

    public function detailCourse($id,$slug)
    {

        $data['title'] = ' Details Training';;

        $data['listpersyaratan'] =  Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();
        $data['listmateri'] =  Dtc_Materi_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();
        $data['listfasilitas']=  Dtc_Fasilitas_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();
        $data['listfiles']=  dtc_File_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();

        $query = DB::table('dtc_training_course_detail')
            ->leftjoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course') // Bergabung dengan tabel tipe_master
            ->leftjoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course') // Bergabung dengan tabel ifg_master_tipe
            ->leftjoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
            ->leftjoin('m_provinsi', 'm_provinsi.id', '=', 'dtc_training_course_detail.id_provinsi')
            ->select('dtc_training_course_detail.*',
                'm_category_training_course.nama as category',
                'm_jenis_sertifikasi_training_course.nama as cetificate_type',
                'm_type_training_course.nama as typeonlineofline',
                'm_provinsi.nama as provinsi'
            );

        $whereData=$query;
        $data['getdataDetail']=$whereData->where('dtc_training_course_detail.id',base64_decode($id))->first();
        //dd($data);
        return view('course.detailcourse', $data);
    }


    // public function previewFilter_jenis_sertifikasi(Request $request)
    // {
    //     $filters = $request->all();
    //     $filterData_jenis_sertifikasi = DB::table('m_jenis_sertifikasi_training_course');

    //     $filterData_jenis_sertifikasi = $filterData_jenis_sertifikasi->get();

    //     return view('partials.filter_jenis_sertifikasi_preview', ['filter_jenis_sertifikasi' => $filterData_jenis_sertifikasi]);
    // }

    // public function previewFilter_Type_course(Request $request)
    // {
    //     $filters = $request->all();
    //     $filterData_jenis_sertifikasi = DB::table('m_jenis_sertifikasi_training_course');

    //     $filterData_jenis_sertifikasi = $filterData_jenis_sertifikasi->get();

    //     return view('partials.filter_jenis_sertifikasi_preview', ['filter_jenis_sertifikasi' => $filterData_jenis_sertifikasi]);
    // }

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
}