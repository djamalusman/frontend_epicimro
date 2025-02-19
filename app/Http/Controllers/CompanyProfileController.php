<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkRole:employee']);
    }

    public function store(Request $request)
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

            $company_profile = CompanyProfile::create($data);
            $company_profile = CompanyProfile::find($company_profile->id);

            return response()->json([
                'message' => 'Company profile berhasil ditambahkan',
                'data' => $company_profile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menambahkan company profile',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        
        try {
            $company_profile = CompanyProfile::findOrFail($id);
            
            if ($company_profile->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $data = $request->validate([
                'company_name' => 'required|string|max:100',
                'company_address' => 'required|string|max:100',
                'company_email' => 'required|string|max:100',
                'phone_number' => 'required|regex:/^(\+62|62|0)[0-9]{9,12}$/|max:13',   // phone number validation
                'company_overview' => 'required|string|max:65535',                      // description validation text
                'province_id' => 'required|integer|exists:provinces,id',                // province_id validation
                'sector_id' => 'required|integer|exists:sectors,id'                     // sector_id validation
            ]);

            $company_profile->update($data);

            return response()->json([
                'message' => 'Company profile berhasil diperbarui',
                'data' => $company_profile
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal memperbarui company profile',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    // public function destroy($id)
    // {
    //     try {
    //         $company_profile = CompanyProfile::findOrFail($id);
            
    //         if ($company_profile->user_id !== auth()->id()) {
    //             return response()->json(['error' => 'Unauthorized'], 403);
    //         }

    //         $company_profile->delete();
    //         return response()->json(['message' => 'Company profile berhasil dihapus']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'Gagal menghapus company profile'], 500);
    //     }
    // }
}
