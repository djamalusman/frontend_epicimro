<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\ProfTrainingModel;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class ProfessionalTrainingClientController extends Controller
{
    public function indexProfessionalclient(Request $request)
    {
        $data = [
            'user_name' => session('email'),
            'title' => 'Training',
        ];

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.professionalclient.index_professional_client', compact('data', 'menus','currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    }

    public function getTasks()
    {
        
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();

        $tasks = DB::table('tr_proftraining')
        ->leftJoin('users_client', 'tr_proftraining.idusers', '=', 'users_client.id')
        ->leftJoin('m_bgrnd_education', 'm_bgrnd_education.id', '=', 'tr_proftraining.id_m_bgrnd_deducation')
        ->leftJoin('m_education', 'tr_proftraining.id_m_education', '=', 'm_education.id')
        ->leftJoin('m_provinsi', 'tr_proftraining.id_m_provinsi', '=', 'm_provinsi.id')
        ->leftJoin('m_age', 'tr_proftraining.idage', '=', 'm_age.id')
        ->leftJoin('m_experience_level', 'tr_proftraining.id_m_experience_l', '=', 'm_experience_level.id')
        ->leftJoin('m_sertifikat', 'tr_proftraining.id_m_sertifikat', '=', 'm_sertifikat.id')
        ->leftJoin('m_bidang', 'tr_proftraining.id_m_bidang', '=', 'm_bidang.id')
        ->leftJoin('m_software', 'tr_proftraining.id_m_sofware', '=', 'm_software.id')
        ->leftJoin('m_trainer', 'tr_proftraining.id_m_trainner', '=', 'm_trainer.id')
        ->leftJoin('m_job_vacancy', 'tr_proftraining.id_m_jobvacancy', '=', 'm_job_vacancy.id')
        ->leftJoin('m_epc_project', 'tr_proftraining.id_m_epc', '=', 'm_epc_project.id')
        ->leftJoin('m_salary', 'tr_proftraining.id_m_salary', '=', 'm_salary.id')
        ->leftJoin('m_prof_training', 'tr_proftraining.id_m_prof_training', '=', 'm_prof_training.id')

        ->select(

            'tr_proftraining.id as idproftraining',
            'm_prof_training.nama as namarof_training', // ini pertama di tampilkan baru yang lain
            //1
            'users_client.name',
            'users_client.lastname',
            'users_client.email',
            'users_client.phone',
            'm_bgrnd_education.nama as namabgroudneducation', //Background Pendidikan
            'm_education.nama as namaeducation', //Jenjang Pendidikan Terakhir
            'm_provinsi.nama as namaprovince', // Province of Domicile / Propinsi Tempat Tinggal 
            'm_age.nama as namaage', // Age / Umur
            'm_experience_level.nama as namaexperiencelevel',// Work Experience  / Pengalaman Pekerjaan 
            'm_sertifikat.nama as namasertifikat', //Owned Certification / Sertifikasi yang di Miliki
            'm_bidang.nama as namaBidang', // Bidang / Category Training yang diminati
            'm_software.nama as namasoftware', // Software yang di kuasai
            'm_trainer.nama as namtrainer', // Berminat untuk menjadi trainer ? onnlie/offline / onnlie & offline

            //2
            'm_job_vacancy.nama as namajobvacancy', // Posisi yang diminate sesuai keahlian
            'm_epc_project.nama as namaepccountry', // Dimanakah pengalaman proyek  kontruksi / EPC yang pernah dikerjakan?
            'm_salary.nama as namasalary',// Gaji perbulan yang diharapkan  / Bulan
            
            

        )
        ->where('tr_proftraining.idusers', $getdtUserClient->id)
        ->orderBy('tr_proftraining.updated_at', 'desc') 
        ->get();
        // Mengembalikan data dalam format JSON
        return response()->json([
            'data' => $tasks
        ]);
    }

    public function ViewStoreProfTran(Request $request)
    {
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();
        $data = [
            'name' => $getdtUserClient->name,
            'lastname' => $getdtUserClient->lastname,
            'email' => $getdtUserClient->email,
            'phone' => $getdtUserClient->phone,
            'user_name' => session('email'),
            'title' => 'Training',
        ];

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        $response = response()->view('template2.professionalclient.viewstoreprof', compact('data', 'menus','currentUrl'));
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    }
    
    public function viewEditProf($id)
    {
        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();
        $data = [
            'name' => $getdtUserClient->name,
            'lastname' => $getdtUserClient->lastname,
            'email' => $getdtUserClient->email,
            'phone' => $getdtUserClient->phone,
            'user_name' => session('email'),
            'idprof' => $id,
            'title' => 'Training',
        ];

        $menus = Menu_client::whereNull('parent_id')->with('children')->orderBy('order')->get();
        $currentUrl = url()->current();
        //dd($id);
        $datas = ProfTrainingModel::where('id', $id)->first();
        //dd($data->id_m_prof_training);
        $val=$datas->id_m_prof_training;
        if ($val == 1 ) {
            $response = response()->view('template2.professionalclient.vieweditprof1', compact('data', 'menus','currentUrl'));
        } else {
            $response = response()->view('template2.professionalclient.vieweditprof2', compact('data', 'menus','currentUrl'));
        }
        
        
        
      
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate','menus');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');

        return $response;
        // php artisan migrate --path=/database/migrations/2025_01_09_174154_create_menus_client_table.php

    }

    public function insertTask(Request $request)
    {
        $request->validate([
            'cvpath' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'fotopath' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'sertifikatpath' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'cvpath2' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'portofoliopath2' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
        ]);


        $userEmail = session('email');
        $getdtUserClient = User::where('email', $userEmail)->first();

        
           
            if ($request->mproftraining =="1") {
                    $destinationPath = public_path('storage');

                    $cvFileName = null;
                    $fotoFileName = null;
                    $sertifikatFileName = null;

                    if ($request->hasFile('cvpath')) {
                        $cvFileName = time() . '_' . $request->file('cvpath')->getClientOriginalName();
                        $request->file('cvpath')->move($destinationPath, $cvFileName);

                    }

                    if ($request->hasFile('fotopath')) {
                        $fotoFileName = time() . '_' . $request->file('fotopath')->getClientOriginalName();
                        $request->file('fotopath')->move($destinationPath, $fotoFileName);
                    }

                    if ($request->hasFile('sertifikatpath')) {
                        $sertifikatFileName = time() . '_' . $request->file('sertifikatpath')->getClientOriginalName();
                        $request->file('sertifikatpath')->move($destinationPath, $sertifikatFileName);
                    }
                    $insert = DB::table('tr_proftraining')->insert([
                    'idusers' => $getdtUserClient->id,
                    'id_m_bgrnd_deducation' => $request->mnamabgroudneducation,
                    'other_bgrnd_education' => $request->otherbgrndeducation,
                    'id_m_education' => $request->mnamaeducation,
                    'id_m_provinsi' => $request->mprovinceData,
                    'residence' => $request->residence,
                    'idage' => $request->mage,
                    'id_m_experience_l' => $request->mworkexperience,
                    'id_m_sertifikat' => $request->msertifikat,
                    'other_certification' =>$request->othersertifikat,
                    'id_m_sofware' => $request->msoftware,
                    'other_software' => $request->othersoftware,

                    'id_m_trainner' => $request->mtrainer,
                    'id_m_bidang' => $request->mbidang,
                    'expected_fee_hour' => $request->fee,
                    'cvpath' => $cvFileName,
                    'fotopath' => $fotoFileName,
                    'sertifikatpath' => $sertifikatpathFileName,

                    'status' => 1,
                    'info' => $request->mproftraining,
                    'opsion' => $request->mproftraining,
                    'id_m_prof_training' => $request->mproftraining,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }else {
                    $destinationPath = public_path('storage');
                    $cvFileName = null;
                    $portofolioFileName = null;

                    if ($request->hasFile('cvpath2')) {
                        $cvFileName = time() . '_' . $request->file('cvpath2')->getClientOriginalName();
                        $request->file('cvpath2')->move($destinationPath, $cvFileName);

                    }

                    if ($request->hasFile('portofoliopath2')) {
                        $portofolioFileName = time() . '_' . $request->file('portofoliopath2')->getClientOriginalName();
                        $request->file('portofoliopath2')->move($destinationPath, $fotoFileName);
                    }
                    
                    $insert = DB::table('tr_proftraining')->insert([
                    'idusers' => $getdtUserClient->id,
                    'id_m_bgrnd_deducation' => $request->mnamabgroudneducation2,
                    'other_bgrnd_education' => $request->otherbgrndeducation2,
                    'id_m_education' => $request->mnamaeducation2,
                    'id_m_provinsi' => $request->mprovinceData2,
                    'residence' => $request->residence2,
                    'idage' => $request->mage2,
                    'id_m_experience_l' => $request->mworkexperience2,
                    'id_m_sertifikat' => $request->msertifikat2,
                    'other_certification' =>$request->othersertifikat2,
                    'id_m_sofware' => $request->msoftware2,
                    'other_software' => $request->othersoftware2,

                    'id_m_jobvacancy' => $request->mnamajobvacancy2,
                    'id_m_epc' => $request->mepc2,
                    'id_m_salary' => $request->msalaray2,
                    'tunjagnan' => $request->tunjangan2,
                    'cvpath' => $cvFileName,
                    'portofoliopath' => $portofolioFileName,

                    'status' => 1,
                    'info' => $request->mproftraining,
                    'opsion' => $request->mproftraining,
                    'id_m_prof_training' => $request->mproftraining,
                    'created_at' => now(),
                    'updated_at' => now(),  
            ]);

        }

        if ($insert) {
            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data!']);
        }
    }

    public function getTaskEdit($id)
    {
        $task = DB::table('tr_proftraining')
        ->leftJoin('users_client', 'tr_proftraining.idusers', '=', 'users_client.id')
        ->leftJoin('m_bgrnd_education', 'm_bgrnd_education.id', '=', 'tr_proftraining.id_m_bgrnd_deducation')
        ->leftJoin('m_education', 'tr_proftraining.id_m_education', '=', 'm_education.id')
        ->leftJoin('m_provinsi', 'tr_proftraining.id_m_provinsi', '=', 'm_provinsi.id')
        ->leftJoin('m_age', 'tr_proftraining.idage', '=', 'm_age.id')
        ->leftJoin('m_experience_level', 'tr_proftraining.id_m_experience_l', '=', 'm_experience_level.id')
        ->leftJoin('m_sertifikat', 'tr_proftraining.id_m_sertifikat', '=', 'm_sertifikat.id')
        ->leftJoin('m_bidang', 'tr_proftraining.id_m_bidang', '=', 'm_bidang.id')
        ->leftJoin('m_software', 'tr_proftraining.id_m_sofware', '=', 'm_software.id')
        ->leftJoin('m_trainer', 'tr_proftraining.id_m_trainner', '=', 'm_trainer.id')
        ->leftJoin('m_job_vacancy', 'tr_proftraining.id_m_jobvacancy', '=', 'm_job_vacancy.id')
        ->leftJoin('m_epc_project', 'tr_proftraining.id_m_epc', '=', 'm_epc_project.id')
        ->leftJoin('m_salary', 'tr_proftraining.id_m_salary', '=', 'm_salary.id')
        ->leftJoin('m_prof_training', 'tr_proftraining.id_m_prof_training', '=', 'm_prof_training.id')

        ->select(
            'tr_proftraining.cvpath',
            'tr_proftraining.sertifikatpath',
            'tr_proftraining.fotopath',
            'tr_proftraining.other_bgrnd_education',
            'tr_proftraining.residence',
            'tr_proftraining.other_certification',
            'tr_proftraining.other_software',
            'tr_proftraining.expected_fee_hour',
            'tr_proftraining.tunjagnan',
            'tr_proftraining.portofoliopath',
            'm_prof_training.id as idrof_training', 
            'm_bgrnd_education.id as idbgroundeducation',
            
            
            'm_education.id as idducation',
            'm_provinsi.id as idprovince', 
            'm_age.id as idage',  
            'm_experience_level.id as idexperiencelevel',
            'm_sertifikat.id as idsertifikat', 
            'm_bidang.id as idBidang', 
            'm_software.id as idsoftware', 
            'm_trainer.id as idtrainer', 


            //2
            'm_job_vacancy.id as idjobvacancy', 
            'm_epc_project.id as ideproject',
            'm_salary.id as idsalary',
        
        )
            ->where('tr_proftraining.id', $id)
            ->first();

        if ($task) {
            return response()->json(['success' => true, 'data' => $task]);
        } else {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']);
        }
    }


    public function updateTask(Request $request)
    {
      
        $request->validate([
            'cvpath' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'fotopath' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'sertifikatpath' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'cvpath2' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
            'portofoliopath2' => 'file|mimes:pdf,doc,docx|max:2048', // Max 2MB
        ]);

            //dd($request->cvpath);
            $userEmail = session('email');
            $getdtUserClient = User::where('email', $userEmail)->first();

        
            //dd($request->mproftraining );
            if ($request->mproftraining =="1") {
                $destinationPath = public_path('storage');

                $cvFileName = null;
                $fotoFileName = null;
                $sertifikatFileName = null;

                if ($request->hasFile('cvpath')) {
                    $cvFileName = time() . '_' . $request->file('cvpath')->getClientOriginalName();
                    $request->file('cvpath')->move($destinationPath, $cvFileName);

                }

                if ($request->hasFile('fotopath')) {
                    $fotoFileName = time() . '_' . $request->file('fotopath')->getClientOriginalName();
                    $request->file('fotopath')->move($destinationPath, $fotoFileName);
                }

                if ($request->hasFile('sertifikatpath')) {
                    $sertifikatFileName = time() . '_' . $request->file('sertifikatpath')->getClientOriginalName();
                    $request->file('sertifikatpath')->move($destinationPath, $sertifikatFileName);
                }

                // Simpan ke database
                $update = DB::table('tr_proftraining')->where('id', $request->id)->update([
                    'idusers' => $getdtUserClient->id,
                    'id_m_bgrnd_deducation' => $request->mnamabgroudneducation,
                    'other_bgrnd_education' => $request->otherbgrndeducation,
                    'id_m_education' => $request->mnamaeducation,
                    'id_m_provinsi' => $request->mprovinceData,
                    'residence' => $request->residence,
                    'idage' => $request->mage,
                    'id_m_experience_l' => $request->mworkexperience,
                    'id_m_sertifikat' => $request->msertifikat,
                    'other_certification' => $request->othersertifikat,
                    'id_m_sofware' => $request->msoftware,
                    'other_software' => $request->othersoftware,
                    'id_m_trainner' => $request->mtrainer,
                    'id_m_bidang' => $request->mbidang,
                    'expected_fee_hour' => $request->fee,
                    'cvpath' => $cvFileName,
                    'fotopath' => $fotoFileName,
                    'sertifikatpath' => $sertifikatFileName,
                    'status' => 1,
                    'info' => $request->mproftraining,
                    'opsion' => $request->mproftraining,
                    'id_m_prof_training' => $request->mproftraining,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }else {

                    $destinationPath = public_path('storage');
                    $cvFileName = null;
                    $portofolioFileName = null;

                    if ($request->hasFile('cvpath2')) {
                        $cvFileName = time() . '_' . $request->file('cvpath2')->getClientOriginalName();
                        $request->file('cvpath2')->move($destinationPath, $cvFileName);

                    }

                    if ($request->hasFile('portofoliopath2')) {
                        $portofolioFileName = time() . '_' . $request->file('portofoliopath2')->getClientOriginalName();
                        $request->file('portofoliopath2')->move($destinationPath, $fotoFileName);
                    }

                    $update = DB::table('tr_proftraining')->where('id', $request->id)->update([
                    'idusers' => $getdtUserClient->id,
                    'id_m_bgrnd_deducation' => $request->mnamabgroudneducation2,
                    'other_bgrnd_education' => $request->otherbgrndeducation2,
                    'id_m_education' => $request->mnamaeducation2,
                    'id_m_provinsi' => $request->mprovinceData2,
                    'residence' => $request->residence2,
                    'idage' => $request->mage2,
                    'id_m_experience_l' => $request->mworkexperience2,
                    'id_m_sertifikat' => $request->msertifikat2,
                    'other_certification' =>$request->othersertifikat2,
                    'id_m_sofware' => $request->msoftware2,
                    'other_software' => $request->othersoftware2,

                    'id_m_jobvacancy' => $request->mnamajobvacancy2,
                    'id_m_epc' => $request->mepc2,
                    'id_m_salary' => $request->msalaray2,
                    'tunjagnan' => $request->tunjangan2,
                    'cvpath' => $cvFileName,
                    'portofoliopath' => $portofolioFileName,

                    'status' => 1,
                    'info' => $request->mproftraining,
                    'opsion' => $request->mproftraining,
                    'id_m_prof_training' => $request->mproftraining,
                    'created_at' => now(),
                    'updated_at' => now(),  
            ]);

        }

        if ($update) {
            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Gagal menyimpan data!']);
        }
    }


    public function getprofesionalPatner()
    {
        $data = DB::table('m_prof_training')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }


    public function getBackgroundPendidikan()
    {
        $data = DB::table('m_bgrnd_education')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    // Mengambil data Jenjang Pendidikan untuk select option
    public function getJenjangPendidikan()
    {
        $data = DB::table('m_education')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }


    // Mengambil data Province
    public function getProvinceData()
    {
        $data = DB::table('m_provinsi')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    // Mengambil data Province
    public function getAgeData()
    {
        $data = DB::table('m_age')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    // Mengambil data Work Experience Level
    public function getWorkExperienceData()
    {
        $data = DB::table('m_experience_level')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    public function getsertifikatData()
    {
        $data = DB::table('m_sertifikat')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }


    public function getBidangData()
    {
        $data = DB::table('m_bidang')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    public function getSoftwareData()
    {
        $data = DB::table('m_software')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    public function getTrainerData()
    {
        $data = DB::table('m_trainer')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    // Mengambil data Posisi yang Diminati untuk select option
    public function getPosisiDiminati()
    {
        $data = DB::table('m_job_vacancy')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    public function getepcData()
    {
        $data = DB::table('m_epc_project')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

    public function getsalarayData()
    {
        $data = DB::table('m_salary')->select('id', 'nama')->get();
        return response()->json(['data' => $data]);
    }

}
