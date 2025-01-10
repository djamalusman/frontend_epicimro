<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
     // Menampilkan halaman login
     public function showLoginForm()
     {
        if (Auth::check()) {
            // Pengguna sudah login
            $user = Auth::user(); // Mengambil data pengguna yang sedang login
            return redirect()->route('dashboardindex');
        } else {
            return view('template2.login');
        }

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
             session(['email' => $user->email, 'name' => $user->name]);

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
     // Logout
    public function logout()
    {
        // Menghapus session email jika ada
        Session::flush();

        // Redirect ke halaman login setelah logout
        return redirect()->route('login');
    }



}
