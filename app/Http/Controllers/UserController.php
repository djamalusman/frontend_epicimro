<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
     // Menampilkan halaman login
     public function login()
     {
         return view('template2.login');  // Menampilkan halaman login
     }

     // Menampilkan halaman dashboard (setelah login)
     public function dashboard()
     {
         // Memeriksa apakah user sudah login melalui session
         if (!session('user')) {
             return redirect()->route('login');  // Redirect ke halaman login jika belum login
         }

         return view('dashboard');  // Menampilkan halaman dashboard
     }

   

     // Menangani sign-in (login)
     public function signUp(Request $request)
     {
         // Validasi data form registrasi
         $validator = Validator::make($request->all(), [
             'username' => 'required',
             'email' => 'required|email',
             'password' => 'required|min:6', // Validasi password minimal 6 karakter
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
             'id' => $no,
             'name' => $request->username,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);
     
         // Berikan respons sukses
         return response()->json([
             'message' => 'Registration successful!',
         ]);
     }
     

     // Menangani logout
     public function logout()
     {
         Auth::logout();  // Logout pengguna
         session()->flush();  // Menghapus data session

         return redirect()->route('login');  // Redirect ke halaman login
     }
}
