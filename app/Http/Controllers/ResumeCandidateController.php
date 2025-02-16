<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Menu_client;
use App\Models\McategoryTraining;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Models\ResumeCandidate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Certification;
class ResumeCandidateController extends Controller
{
    
    public function index()
    {
        $resume = ResumeCandidate::where('user_id', Auth::id())->latest()->first();
        return response()->json($resume);
    }

    public function storeResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('resume')) {
            // Hapus resume lama jika ada
            $existingResume = ResumeCandidate::where('user_id', Auth::id())->first();
            if ($existingResume) {
                // Hapus file dari public/storage/resumes/
                $filePath = public_path('storage/' . $existingResume->file_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                // Hapus record dari database
                $existingResume->delete();
            }

            // Simpan resume baru ke public/storage/resumes/
            $file = $request->file('resume');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/resumes'), $fileName);

            // Simpan path ke database (sesuai format sebelumnya)
            $filePath = 'resumes/' . $fileName;

            $resume = ResumeCandidate::create([
                'user_id' => Auth::id(),
                'file_name' => $fileName,
                'file_path' => $filePath
            ]);

            return response()->json($resume);
        }

        return response()->json(['error' => 'Upload gagal'], 400);
    }

    public function destroyResume()
    {
        $resume = ResumeCandidate::where('user_id', Auth::id())->first();

        if ($resume) {
            Storage::disk('public')->delete($resume->file_path);
            $resume->delete();
            return response()->json(['message' => 'Resume berhasil dihapus']);
        }

        return response()->json(['error' => 'Resume tidak ditemukan'], 404);
    }
}
