<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\TraningCourseModel;
use App\Models\TrainingCourseFilesModel;
use App\Models\TraningCourseDetailsModel;
use App\Http\Requests\ListItemDetail as RequestsListItemDetail;
use App\Models\ListItemDetail;
use App\Models\MasterTipeModel;
use App\Models\ListItemModel;
use App\Models\M_Category_TrainingCourseModel;
use App\Models\M_Jenis_Sertifikasi_TrainingCourseModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Dtc_Persyaratan_TrainingCourseModel;
use App\Models\dtc_File_TrainingCourseModel;
use App\Models\Dtc_Materi_TrainingCourseModel;
use App\Models\Dtc_Fasilitas_TrainingCourseModel;

use App\Models\Province;
use App\Models\M_type_TrainingCourseModel;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use PDO;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Pastikan driver GD digunakan
use Intervention\Image\Encoders\WebpEncoder; // Tambahkan encoder WEBP
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class PosttrainingController extends Controller
{
    public function generateNumber()
    {
        // Fetch the last number from the database
        $lastRecord = TraningCourseDetailsModel::whereDate('created_at', Carbon::today())
            ->orderBy('generatenumber', 'desc')
            ->first();

        // Determine the last number part, if it exists
        $lastNumber = $lastRecord ? $lastRecord->generatenumber : null;
        $lastNumberPart = $lastNumber ? intval(substr($lastNumber, 4, 3)) : 0;

        // Generate new number
        $newNumberPart = str_pad($lastNumberPart + 1, 3, '0', STR_PAD_LEFT);

        // Format the new number with the current date
        $datePart = Carbon::now()->format('dmy');

        return "TRC-{$newNumberPart}-{$datePart}";
    }


    public function posttraining()
    {
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
        $title_page    = 'Traning Kerja | Pages';
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
        $id=$user->id;
        //dd($id);
        $personalsummarys = User::where('users_client.id', $user->id)
        ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'users_client.id')
        ->leftJoin('m_provinsi', 'company_profiles.provinsi_id', '=', 'm_provinsi.id')
        ->leftJoin('m_sector', 'company_profiles.sector_id', '=', 'm_sector.id')
        ->orderBy('users_client.updated_at', 'desc')
        ->select('users_client.*', 'company_profiles.*','m_provinsi.id as provinsi_id', 'm_sector.id as sector_id','m_provinsi.nama as provinsi_name', 'm_sector.nama as sector_name')
        ->get();

        return view('company.traningcourse', compact('user', 'menus','title_page','id','personalsummarys'));
    }

    public function getFilters() {
        $filters = DB::table('dtc_training_course_detail')
        ->leftJoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course')
        ->leftJoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course')
        ->leftJoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
        ->select(
            'dtc_training_course_detail.traning_name',
            DB::raw('CASE
                        WHEN dtc_training_course_detail.status = 1 THEN "Publish"
                        WHEN dtc_training_course_detail.status = 2 THEN "Pending"
                        WHEN dtc_training_course_detail.status = 3 THEN "Non Publish"
                        WHEN dtc_training_course_detail.status = 4 THEN "Kadaluarsa"
                        ELSE "Unknown"
                    END as status_training'),
            'm_category_training_course.nama as category',
            'm_jenis_sertifikasi_training_course.nama as cetificate_type',
            'm_type_training_course.nama as typeonlineofline'
        ) ->distinct() ->get();


        return response()->json($filters);
    }

    public function getDataCourses(Request $request) {

        $user = Auth::user();
        //dd($request->all());
        $query = DB::table('dtc_training_course_detail')
        ->leftjoin('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course') // Bergabung dengan tabel tipe_master
        ->leftjoin('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course') // Bergabung dengan tabel ifg_master_tipe
        ->leftjoin('m_type_training_course', 'm_type_training_course.id', '=', 'dtc_training_course_detail.typeonlineoffile')
        ->where('dtc_training_course_detail.idcompany', $user->id)
        ->select('dtc_training_course_detail.*', 'm_category_training_course.nama as category','m_jenis_sertifikasi_training_course.nama as cetificate_type','m_type_training_course.nama as typeonlineofline'); // Pilih kolom yang dibutuhkan

        // Menerapkan filter berdasarkan parameter yang tersedia
        if ($request->has('traning_name') && $request->traning_name != '') {
            $query->where('dtc_training_course_detail.traning_name', 'LIKE', '%' . $request->traning_name . '%');
        }

        if ($request->category != '') {
            $query->where('m_category_training_course.nama', 'LIKE', '%' . $request->category . '%');
        }

        if ($request->cetificate_type != '') {
            $query->where('m_jenis_sertifikasi_training_course.nama', 'LIKE', '%' . $request->cetificate_type . '%');
        }
        if ($request->status_training != '') {

            if ( $request->status_training  =='Publish') {
                $query->where('dtc_training_course_detail.status',1);
            }
            elseif ( $request->status_training  == 'Pending') {
                $query->where('dtc_training_course_detail.status',2);
            }
            elseif ( $request->status_training  == 'Non Publish') {
                $query->where('dtc_training_course_detail.status',3);
            }
            elseif ($request->status_training  =='Kadaluarsa') {
                $query->where('dtc_training_course_detail.status',0);
            }

        }

        if ($request->typeonlineofline != '') {
            $query->where('m_type_training_course.id',$request->typeonlineofline);
        }

        // Mengambil hasil query
        $courses = $query->get();
        //dd($courses);
        // Mengembalikan data dalam format JSON
        return response()->json($courses);
    }


    public function ViewsStoretraningcourse($id)
    {

        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest
        $title_page    = 'Traning Kerja | Pages';
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
        $id=$user->id;
        $liscategory = M_Category_TrainingCourseModel::all();
        $listsertifikasi = M_Jenis_Sertifikasi_TrainingCourseModel::all();
        $listprovinsi = Province::all();
        $listtype = M_type_TrainingCourseModel::all();
        $content = base64_decode($id);

        $personalsummarys = User::where('users_client.id', $user->id)
        ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'users_client.id')
        ->leftJoin('m_provinsi', 'company_profiles.provinsi_id', '=', 'm_provinsi.id')
        ->leftJoin('m_sector', 'company_profiles.sector_id', '=', 'm_sector.id')
        ->orderBy('users_client.updated_at', 'desc')
        ->select('users_client.*', 'company_profiles.*','m_provinsi.id as provinsi_id', 'm_sector.id as sector_id','m_provinsi.nama as provinsi_name', 'm_sector.nama as sector_name')
        ->get();

        return view('company.traningcourse_store', compact('personalsummarys','content','user', 'menus','id','liscategory','listsertifikasi','listprovinsi','listtype','title_page'));
    }


    public function storeCourseEndpoint(Request $req)
    {
        //dd($req->all());
        try {
            $user = Auth::user();

            // Konversi tanggal
            $jadwalMulai = Carbon::createFromDate(
                $req->jadwal_mulai_tahun,
                $req->jadwal_mulai_bulan,
                $req->jadwal_mulai_tanggal
            )->toDateString();

            $jadwalSelesai = Carbon::createFromDate(
                $req->jadwal_selesai_tahun,
                $req->jadwal_selesai_bulan,
                $req->jadwal_selesai_tanggal
            )->toDateString();

            $idProvinsi = $req->provinsi === 'Pilih Provinsi' ? 0 : $req->provinsi;
            $type = $req->type === 'Pilih Type' ? 0 : $req->type;

            // Tentukan tab aktif
            $tab_active;

            if ($req->abouttraining !="" | $req->abouttraining != null) {
                $tab_active=1;
            }

            elseif ($req->abouttrainer !="" | $req->abouttrainer != null) {
                $tab_active=2;
            }
            elseif ($req->aboutcareer !="" | $req->aboutcareer != null) {
                $tab_active=3;
            }
            else
            {
                $tab_active=1;
            }

            // Simpan data training course
            $listItem = new TraningCourseDetailsModel();
            $listItem->traning_name = $req->nama_training;
            $listItem->abouttraining = $req->abouttraining;
            $listItem->yotube = $req->yotube;
            $listItem->id_m_category_training_course = $req->category;
            $listItem->id_m_jenis_sertifikasi_training_course = $req->jenis_sertifikasi;
            $listItem->training_duration = $req->training_duration;
            $listItem->startdate = $jadwalMulai;
            $listItem->enddate = $jadwalSelesai;
            $listItem->registrationfee = $req->registrationfee;
            $listItem->typeonlineoffile = $type;
            $listItem->abouttrainer = $req->abouttrainer;
            $listItem->id_provinsi = $idProvinsi;
            $listItem->lokasi = $req->lokasi;
            $listItem->link_pendaftaran = $req->link_pendaftaran;
            $listItem->aboutcareer = $req->aboutcareer;
            $listItem->tab_active = $tab_active;
            $listItem->company_name = $user->name;

            $listItem->status = $req->status;
            $listItem->idcompany = $user->id;
            $listItem->generatenumber = $this->generateNumber();
            $listItem->insert_by = session()->get('id');
            $listItem->updated_by = session()->get('id');
            $listItem->updated_by_ip = $req->ip();
            $listItem->save();

            // Simpan persyaratan
            if (!is_null($req->persyaratan)) {
                foreach ($req->persyaratan as $persyaratan) {
                    $datapersyaratan = new Dtc_Persyaratan_TrainingCourseModel();
                    $datapersyaratan->id_training_course_dtl = $listItem->id;
                    $datapersyaratan->nama = $persyaratan;
                    $datapersyaratan->insert_by = session()->get('id');
                    $datapersyaratan->updated_by = session()->get('id');
                    $datapersyaratan->updated_by_ip = $req->ip();
                    $datapersyaratan->save();
                }
            }

            // Simpan materi training
            if (!is_null($req->materi_training)) {
                foreach ($req->materi_training as $materi_training) {
                    $datamateri_training = new Dtc_Materi_TrainingCourseModel();
                    $datamateri_training->id_training_course_dtl = $listItem->id;
                    $datamateri_training->nama = $materi_training;
                    $datamateri_training->insert_by = session()->get('id');
                    $datamateri_training->updated_by = session()->get('id');
                    $datamateri_training->updated_by_ip = $req->ip();
                    $datamateri_training->save();
                }
            }

            // Simpan fasilitas
            if (!is_null($req->fasilitas)) {
                foreach ($req->fasilitas as $fasilitas) {
                    $datafasilitas = new Dtc_Fasilitas_TrainingCourseModel();
                    $datafasilitas->id_training_course_dtl = $listItem->id;
                    $datafasilitas->nama = $fasilitas;
                    $datafasilitas->insert_by = session()->get('id');
                    $datafasilitas->updated_by = session()->get('id');
                    $datafasilitas->updated_by_ip = $req->ip();
                    $datafasilitas->save();
                }
            }

            // Simpan file gambar
            if (!$req->hasFile('photo')) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Tidak ada file yang diunggah'
                ]);
            }

            $files = $req->file('photo');

            // Jika hanya satu file, langsung proses tanpa looping
            if (!is_array($files)) {
                $files = [$files]; // Ubah menjadi array untuk menyamakan proses
            }

            $file = $files[0]; // Ambil hanya satu file pertama

            if (!$file->isValid()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'File tidak valid'
                ]);
            }

            // Generate nama unik untuk file
            $filePhoto = uniqid() . '.webp';

            // Konversi gambar ke WebP
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file->getPathname())
                ->resize(1080, 750, function ($constraint) {
                    $constraint->aspectRatio(); // Pertahankan rasio aspek
                    $constraint->upsize(); // Jangan perbesar gambar lebih dari ukuran aslinya
                })
                ->encode(new WebpEncoder(80)); // Konversi ke WebP dengan kualitas 80
            // Simpan gambar ke storage/public/
            Storage::disk('public')->put($filePhoto, (string) $img);

            //$filePath = public_path('storage/' . $filePhoto);
            $filePath = public_path('storage/' . $filePhoto);
            file_put_contents($filePath, (string) $img);
            // URL file yang diunggah
            $fileUrl = 'https://admin.trainingkerja.com/public/storage/' . $filePhoto;

            Log::info('File berhasil diunggah', [
                'file_name' => $filePhoto,
                'file_url' => $fileUrl
            ]);

            // Pastikan $listItem tersedia sebelum menyimpan ke database
            if (!isset($listItem) || !$listItem->id) {
                Log::error('ID training course tidak ditemukan');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'ID training course tidak ditemukan'
                ]);
            }

            // **Cek database sebelum insert**
            $existingFile = dtc_File_TrainingCourseModel::where('fileold', $fileUrl)
                ->where('id_training_course_dtl', $listItem->id)
                ->first();

            if ($existingFile) {
                Log::warning('File sudah ada di database, tidak disimpan ulang', [
                    'file_name' => $filePhoto,
                    'id_training_course_dtl' => $listItem->id
                ]);
                return response()->json([
                    'status' => 'warning',
                    'message' => 'File sudah ada di database'
                ]);
            }

            // Simpan informasi file ke database
            $datapenulis = new dtc_File_TrainingCourseModel();
            $datapenulis->id_training_course_dtl = $listItem->id;
            $datapenulis->nama = $filePhoto;
            $datapenulis->fileold = "frontend";
            $datapenulis->save();

            Log::info('Data berhasil disimpan ke database', [
                'file_name' => $filePhoto,
                'id_training_course_dtl' => $listItem->id
            ]);

            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan']);

        } catch (\Exception $e) {
            return response()->json(['status' => 'failed', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function editTraningCourse($id)
    {
        $user = Auth::user();
        $data['title']      = 'Traning Kerja | Pages';
        $data['title_page']= 'Edit Traning Course';
        $data['content'] = base64_decode($id);
        $user = Auth::user();
        $role = $user ? $user->role : 'guest'; // Jika belum login, role = guest

        // Get menus for candidate
        $data ['menus'] = Menu_client::where(function($query) use ($role) {
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

        $data['liscategory'] = M_Category_TrainingCourseModel::all();
        $data['listsertifikasi'] = M_Jenis_Sertifikasi_TrainingCourseModel::all();
        $data['listprovinsi'] = Province::all();
        $data['listtype'] = M_type_TrainingCourseModel::all();

        $data['listpersyaratan'] =  Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();
        $data['listmateri'] =  Dtc_Materi_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();
        $data['listfasilitas']=  Dtc_Fasilitas_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();
        $data['listfiles']=  dtc_File_TrainingCourseModel::where('id_training_course_dtl',base64_decode($id))->get();

        $data['databyid'] = DB::table('dtc_training_course_detail')
        ->join('m_category_training_course', 'm_category_training_course.id', '=', 'dtc_training_course_detail.id_m_category_training_course') // Bergabung dengan tabel tipe_master
        ->join('m_jenis_sertifikasi_training_course', 'm_jenis_sertifikasi_training_course.id', '=', 'dtc_training_course_detail.id_m_jenis_sertifikasi_training_course') // Bergabung dengan tabel ifg_master_tipe
        ->leftjoin('m_provinsi', 'm_provinsi.id', '=', 'dtc_training_course_detail.id_provinsi') // Bergabung dengan tabel ifg_master_tipe
        ->select('dtc_training_course_detail.*', 'm_category_training_course.nama as category','m_jenis_sertifikasi_training_course.nama as cetificate_type','m_provinsi.nama as namaprovinsi')
        ->where('dtc_training_course_detail.idcompany', $user->id)
        ->where('dtc_training_course_detail.id',base64_decode($id))->first(); // Pilih kolom yang dibutuhkan
        //dd($data);
        $dt_list_item =  TraningCourseDetailsModel::where('id',base64_decode($id))->first();
        $data['startdate']  = Carbon::parse($dt_list_item->startdate)->format('Y-m-d');
        $data['enddate']  = Carbon::parse($dt_list_item->enddate)->format('Y-m-d');

        $data['iddtl']=base64_decode($id);
        $data['personalsummarys'] = User::where('users_client.id', $user->id)
        ->leftJoin('company_profiles', 'company_profiles.user_id', '=', 'users_client.id')
        ->leftJoin('m_provinsi', 'company_profiles.provinsi_id', '=', 'm_provinsi.id')
        ->leftJoin('m_sector', 'company_profiles.sector_id', '=', 'm_sector.id')
        ->orderBy('users_client.updated_at', 'desc')
        ->select('users_client.*', 'company_profiles.*','m_provinsi.id as provinsi_id', 'm_sector.id as sector_id','m_provinsi.nama as provinsi_name', 'm_sector.nama as sector_name')
        ->get();


        return view('company.traningcourse_edit', $data);
    }


    public function updateCourseEndpoint(Request $req)
    {

        try {
            $user = Auth::user();
           //dd($req->all());
            $jadwalMulai = Carbon::createFromDate(
                $req->jadwal_mulai_tahun,
                $req->jadwal_mulai_bulan,
                $req->jadwal_mulai_tanggal
            )->toDateString();

            $jadwalSelesai = Carbon::createFromDate(
                $req->jadwal_selesai_tahun,
                $req->jadwal_selesai_bulan,
                $req->jadwal_selesai_tanggal
            )->toDateString();

            $idProvinsi = $req->provinsi === 'Pilih Provinsi' ? 0 : $req->provinsi;

            $tab_active;

            if ($req->abouttraining !="" | $req->abouttraining != null) {
                $tab_active=1;
            }

            elseif ($req->abouttrainer !="" | $req->abouttrainer != null) {
                $tab_active=2;
            }
            elseif ($req->aboutcareer !="" | $req->aboutcareer != null) {
                $tab_active=3;
            }
            else
            {
                $tab_active=1;
            }

            $listItem = TraningCourseDetailsModel::find($req->iddtl);
            $listItem->abouttraining                = $req->abouttraining;
            $listItem->abouttrainer                 = $req->abouttrainer;
            $listItem->aboutcareer                  = $req->aboutcareer;
            $listItem->tab_active                   = $tab_active;
            $listItem->company_name                 = $user->name;
            $listItem->traning_name                 = $req->nama_training;
            $listItem->id_m_category_training_course          = $req->category;
            $listItem->id_m_jenis_sertifikasi_training_course             = $req->jenis_sertifikasi;
            $listItem->training_duration            = $req->training_duration;
            $listItem->startdate                    = $jadwalMulai;
            $listItem->enddate                      = $jadwalSelesai;
            $listItem->registrationfee              = $req->registrationfee;
            $listItem->typeonlineoffile             = $req->type;
            $listItem->id_provinsi                  = $idProvinsi;
            $listItem->lokasi                       = $req->lokasi;
            $listItem->yotube                       = $req->yotube;
            $listItem->link_pendaftaran             = $req->link_pendaftaran;
            $listItem->status                       = $req->status;
            $listItem->idcompany                    = $user->id;
            $listItem->insert_by                    = session()->get('id');
            $listItem->updated_by                   = session()->get('id');
            $listItem->updated_by_ip                = $req->ip();
            $listItem->save();

            Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl', $req->iddtl)->delete();

            //persyaratan
            if (!is_null($req->persyaratan)) {
                //Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl', $req->iddtl)->delete();
                //$query = DB::table('id_training_course_dtl')->whereIn('id', $req->iddtl)->delete();
                foreach ($req->persyaratan as $persyaratan) {

                        if ($persyaratan !=null || $persyaratan !='') {
                            $datapersyaratan = new Dtc_Persyaratan_TrainingCourseModel();
                            $datapersyaratan->id_training_course_dtl =  $req->iddtl;
                            $datapersyaratan->nama = $persyaratan;
                            $datapersyaratan->insert_by = session()->get('id');
                            $datapersyaratan->updated_by = session()->get('id');
                            $datapersyaratan->updated_by_ip = $req->ip();
                            $datapersyaratan->save();
                        }


                }
            }

             //persyaratan Db
             if (!is_null($req->persyaratanDb)) {
                //$query = DB::table('id_training_course_dtl')->whereIn('id', $req->iddtl)->delete();
                foreach ($req->persyaratanDb as $persyaratanDb) {
                    //dd($persyaratanDb);
                    $datapersyaratan = new Dtc_Persyaratan_TrainingCourseModel();
                    $datapersyaratan->id_training_course_dtl =  $req->iddtl;
                    $datapersyaratan->nama = $persyaratanDb;
                    $datapersyaratan->insert_by = session()->get('id');
                    $datapersyaratan->updated_by = session()->get('id');
                    $datapersyaratan->updated_by_ip = $req->ip();
                    $datapersyaratan->save();
                }
            }

            Dtc_Materi_TrainingCourseModel::where('id_training_course_dtl', $req->iddtl)->delete();

            // //materi_training
            if (!is_null($req->materi_training)) {

                    foreach ($req->materi_training as $materi_training) {
                        if ($materi_training !=null || $materi_training !='') {

                            $datamateri_training = new Dtc_Materi_TrainingCourseModel();
                            $datamateri_training->id_training_course_dtl =  $req->iddtl;
                            $datamateri_training->nama = $materi_training;
                            $datamateri_training->insert_by = session()->get('id');
                            $datamateri_training->updated_by = session()->get('id');
                            $datamateri_training->updated_by_ip =$req->ip();
                            $datamateri_training->save();
                        }
                    }
            }

            // //materi_training Db
            if (isset($req->materi_trainingDb)) {

                foreach ($req->materi_trainingDb as $materi_trainingDb) {
                    $datamateri_training = new Dtc_Materi_TrainingCourseModel();
                    $datamateri_training->id_training_course_dtl =  $req->iddtl;
                    $datamateri_training->nama = $materi_trainingDb;
                    $datamateri_training->insert_by = session()->get('id');
                    $datamateri_training->updated_by = session()->get('id');
                    $datamateri_training->updated_by_ip =$req->ip();
                    $datamateri_training->save();
                }
            }

            Dtc_Fasilitas_TrainingCourseModel::where('id_training_course_dtl', $req->iddtl)->delete();
            // //fasilitas
            if (isset($req->fasilitas)) {

                foreach ($req->fasilitas as $fasilitas) {
                    if ($fasilitas !=null || $fasilitas !='') {
                        $datafasilitas = new Dtc_Fasilitas_TrainingCourseModel();
                        $datafasilitas->id_training_course_dtl =  $req->iddtl;
                        $datafasilitas->nama = $fasilitas;
                        $datafasilitas->insert_by = session()->$datapenulis = new dtc_File_TrainingCourseModel();
                        $datapenulis->id_training_course_dtl = $listItem->id;
                        $datapenulis->nama = $filePhoto;
                        $datapenulis->fileold = "frontend";
                        $datapenulis->save();get('id');
                        $datafasilitas->updated_by = session()->get('id');
                        $datafasilitas->updated_by_ip = $req->ip();
                        $datafasilitas->save();
                    }
                }
            }

            //fasilitas Db
            if (isset($req->fasilitasDb)) {
                foreach ($req->fasilitasDb as $fasilitasDb) {
                    $datafasilitas = new Dtc_Fasilitas_TrainingCourseModel();
                    $datafasilitas->id_training_course_dtl =  $req->iddtl;
                    $datafasilitas->nama = $fasilitasDb;
                    $datafasilitas->insert_by = session()->get('id');
                    $datafasilitas->updated_by = session()->get('id');
                    $datafasilitas->updated_by_ip = $req->ip();
                    $datafasilitas->save();
                }
            }

             // Simpan file gambar
             if (!$req->hasFile('photo')) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'Tidak ada file yang diunggah'
                ]);
            }

            $files = $req->file('photo');

            // Jika hanya satu file, langsung proses tanpa looping
            if (!is_array($files)) {
                $files = [$files]; // Ubah menjadi array untuk menyamakan proses
            }

            $file = $files[0]; // Ambil hanya satu file pertama

            if (!$file->isValid()) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'File tidak valid'
                ]);
            }

            // Generate nama unik untuk file
            $filePhoto = uniqid() . '.webp';

            // Konversi gambar ke WebP
            $manager = new ImageManager(new Driver());
            $img = $manager->read($file->getPathname())
            ->resize(1080, 750, function ($constraint) {
                $constraint->aspectRatio(); // Pertahankan rasio aspek
                $constraint->upsize(); // Jangan perbesar gambar lebih dari ukuran aslinya
            })
            ->encode(new WebpEncoder(80)); // Konversi ke WebP dengan kualitas 80

            Storage::disk('public')->put($filePhoto, (string) $img);

            $filePath = public_path('storage/' . $filePhoto);
            file_put_contents($filePath, (string) $img);

            // URL file yang diunggah
            $fileUrl = 'https://admin.trainingkerja.com/public/storage/' . $filePhoto;

            Log::info('File berhasil diunggah', [
                'file_name' => $filePhoto,
                'file_url' => $fileUrl
            ]);

            // Pastikan $listItem tersedia sebelum menyimpan ke database
            if (!isset($listItem) || !$listItem->id) {
                Log::error('ID training course tidak ditemukan');
                return response()->json([
                    'status' => 'failed',
                    'message' => 'ID training course tidak ditemukan'
                ]);
            }

            // **Cek database sebelum insert**
            $existingFile = dtc_File_TrainingCourseModel::where('fileold', $fileUrl)
                ->where('id_training_course_dtl', $listItem->id)
                ->first();

            if ($existingFile) {
                Log::warning('File sudah ada di database, tidak disimpan ulang', [
                    'file_name' => $filePhoto,
                    'id_training_course_dtl' => $listItem->id
                ]);
                return response()->json([
                    'status' => 'warning',
                    'message' => 'File sudah ada di database'
                ]);
            }

            dtc_File_TrainingCourseModel::where('id_training_course_dtl', $req->iddtl)->delete();
            $datapenulis = new dtc_File_TrainingCourseModel();
            $datapenulis->id_training_course_dtl = $listItem->id;
            $datapenulis->nama = $filePhoto;
            $datapenulis->fileold = "frontend";
            $datapenulis->save();

            Log::info('Data berhasil disimpan ke database', [
                'file_name' => $filePhoto,
                'id_training_course_dtl' => $listItem->id
            ]);


            $response = [
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ];
        } catch (ModelNotFoundException $e) {
            $response = [
                'status' => 'failed',
                'message' => "Terjadi Kesalahan pada sistem : " . $e,
            ];
        }
        $status = $req->status;

        $statusText = ($status == 1) ? 'publish' :
              (($status == 2) ? 'pending' :
              (($status == 3) ? 'preview' : 'unknown'));

        return json_encode($response);
    }

    public function removePersyaratanEndpoint ($id)
    {
        Dtc_Persyaratan_TrainingCourseModel::where('id', $id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ];
        return json_encode($response);
    }

    public function removeMateriTrainingEndpoint ($id)
    {
        Dtc_Materi_TrainingCourseModel::where('id', $id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ];
        return json_encode($response);
    }

    public function removeFasilitasEndpoint ($id)
    {
        Dtc_Fasilitas_TrainingCourseModel::where('id', $id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ];
        return json_encode($response);
    }

    public function removePhotoEndpoint ($id)
    {

        dtc_File_TrainingCourseModel::where('id', $id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ];
        return json_encode($response);
    }


    public function stopTrainingCourse ($id)
    {

        $listItem = TraningCourseDetailsModel::find($id);
            $listItem->status                       = 3;
            $listItem->insert_by                    = session()->get('id');
            $listItem->updated_by                   = session()->get('id');
            $listItem->save();
        $response = [
            'status' => 'success',
            'message' => 'Data berhasil diupdate'
        ];
        return json_encode($response);
    }

    public function copyTrainingCourseList($id)
    {
        try {
            $dt_list_item =  TraningCourseDetailsModel::find($id);
            $output = View::make("components.copy-training-course-modal")
                ->with("dt_item", $dt_list_item)
                ->with("route", route('update-copy-training-course'))
                ->with("formId", "copy-training-course-edit")
                ->with("formMethod", "PUT")
                ->render();

            $response = [
                'status' => 'success',
                'output'  => $output,
                'message' => 'Berhasil Parsing',
            ];
            return json_encode($response);
        } catch (ModelNotFoundException $e) {
            $response = [
                'status' => 'failed',
                'message' => "Terjadi Kesalahan pada sistem.",
            ];
        }
        return json_encode($response);
    }


    public function updateCopyTrainingCourseList(Request $req)
    {

        try {

            $listItem = TraningCourseDetailsModel::find($req->upt_id);
            $listItem->link_pendaftaran             = $req->link_pendaftaran;

            $listItem->save();
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ];
        } catch (ModelNotFoundException $e) {
            $response = [
                'status' => 'failed',
                'message' => "Terjadi Kesalahan pada sistem : " . $e,
            ];
        }


        return json_encode($response);
    }


    public function removePTrainingCourse ($id)
    {
        TraningCourseDetailsModel::where('id', $id)->delete();
        Dtc_Persyaratan_TrainingCourseModel::where('id_training_course_dtl', $id)->delete();
        Dtc_Materi_TrainingCourseModel::where('id_training_course_dtl', $id)->delete();
        Dtc_Fasilitas_TrainingCourseModel::where('id_training_course_dtl', $id)->delete();
        dtc_File_TrainingCourseModel::where('id_training_course_dtl', $id)->delete();

        $response = [
            'status' => 'success',
            'message' => 'Data berhasil disimpan'
        ];
        return json_encode($response);
    }

    public function editTraningCourseDetail($id)
    {
        try {
                $dt_list_item =  TraningCourseDetailsModel::find($id);
                $output = View::make("components.traning-course-component")
                    ->with("dt_item", $dt_list_item)
                    ->with("route", route('update-traning-course-detail'))
                    ->with("formId", "traning-course-edit")
                    ->with("formMethod", "PUT")
                    ->render();

                $response = [
                    'status' => 'success',
                    'output'  => $output,
                    'message' => 'Berhasil Parsing',
                ];
                return json_encode($response);
        } catch (Exception $e) {
            $response = [
                'status' => 'failed',
                'message' => "Terjadi Kesalahan pada sistem.",
            ];
        }
        return json_encode($response);
    }


    public function updateTraningCourseDetail(Request $req)
    {


        try {

            $listItem = TraningCourseDetailsModel::find($req->upt_id);
            $listItem->traning_name            = $req->traning_name;
            $listItem->traning_name_en         = $req->traning_name;
            $listItem->cetificate_type         = $req->cetificate_type;
            $listItem->cetificate_type_en      = $req->cetificate_type_en;
            $listItem->startdate     = $req->startdate;
            $listItem->enddate     = $req->enddate;
            $listItem->training_duration       = $req->training_duration;
            $listItem->requirements       = (new HelperController)->scriptStripper( $req->requirements ?? '-');
            $listItem->requirements_en    = (new HelperController)->scriptStripper( $req->requirements_en ?? '-');
            $listItem->training_material                = $req->training_material;
            $listItem->training_material_en             = $req->training_material_en;
            $listItem->facility                = $req->facility;
            $listItem->facility_en             = $req->facility_en;

            $listItem->insert_by = session()->get('id');
            $listItem->updated_by = session()->get('id');
            $listItem->updated_by_ip = $req->ip();
            if (!is_null($req->file('item_file'))) {
                $manager                = new ImageManager();
                $ext                    =  $req->file('item_file')->extension();
                $img                    = $manager->make($req->file('item_file')->getPathname());
                $listItem->file         = uniqid() . '.' . $req->file('item_file')->getClientOriginalExtension();

                if ($ext == 'png' || $ext == 'PNG') {
                    $listItem->file = uniqid() . '.' . 'webp';
                }

                $img->save(public_path('storage') . '/'  . $listItem->file, 80);

                if (env('PLATFORM_NAME') !== 'windows') {
                    //SFTP
                    Storage::disk('sftp')->put('/' . $listItem->file, $img);
                } else {
                    Storage::disk('windows_uploads')->put('/' . $listItem->file, $img);
                }
            }

            $listItem->save();
            $response = [
                'status' => 'success',
                'message' => 'Data berhasil disimpan'
            ];
        } catch (ModelNotFoundException $e) {
            $response = [
                'status' => 'failed',
                'message' => "Terjadi Kesalahan pada sistem : " . $e,
            ];
        }

        return json_encode($response);
    }
}
