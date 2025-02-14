<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkRole:candidate']);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'issuing_organization' => 'required|string|max:255',
                'credential_id' => 'nullable|string|max:255',
                'issue_date' => 'required|date',
                'expiration_date' => 'nullable|date',
                'description' => 'nullable|string',
                'has_expiration' => 'nullable|boolean'
            ]);

            $data['user_id'] = auth()->id();
            
            // Handle has_expiration and expiration_date
            $data['has_expiration'] = $request->has('has_expiration');
            if (!$data['has_expiration']) {
                $data['expiration_date'] = null;
            }

            $certification = Certification::create($data);
            $certification = Certification::find($certification->id);

            return response()->json([
                'message' => 'Sertifikasi berhasil ditambahkan',
                'data' => $certification
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menambahkan sertifikasi',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $certification = Certification::findOrFail($id);
            
            if ($certification->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $data = $request->validate([
                'name' => 'required|string|max:255',
                'issuing_organization' => 'required|string|max:255',
                'credential_id' => 'nullable|string|max:255',
                'issue_date' => 'required|date',
                'expiration_date' => 'nullable|date',
                'description' => 'nullable|string',
                'has_expiration' => 'nullable|boolean'
            ]);
            
            // Handle has_expiration and expiration_date
            $data['has_expiration'] = $request->has('has_expiration');
            if (!$data['has_expiration']) {
                $data['expiration_date'] = null;
            }

            $certification->update($data);

            return response()->json([
                'message' => 'Sertifikasi berhasil diperbarui',
                'data' => $certification
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal memperbarui sertifikasi',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $certification = Certification::findOrFail($id);
            
            if ($certification->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $certification->delete();
            return response()->json(['message' => 'Sertifikasi berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus sertifikasi'], 500);
        }
    }
}
