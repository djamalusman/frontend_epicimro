<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkRole:candidate']);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'school_name' => 'required|string|max:255',
                'degree' => 'required|string|max:255',
                'field_of_study' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'description' => 'nullable|string',
                'is_current' => 'nullable|boolean'
            ]);

            $data['user_id'] = auth()->id();
            
            // Handle is_current and end_date
            $data['is_current'] = $request->has('is_current');
            if ($data['is_current']) {
                $data['end_date'] = null;
            }

            $education = Education::create($data);
            $education = Education::find($education->id);

            return response()->json([
                'message' => 'Pendidikan berhasil ditambahkan',
                'data' => $education
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal menambahkan pendidikan',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $education = Education::findOrFail($id);
            
            if ($education->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $data = $request->validate([
                'school_name' => 'required|string|max:255',
                'degree' => 'required|string|max:255',
                'field_of_study' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date',
                'description' => 'nullable|string',
                'is_current' => 'nullable|boolean'
            ]);
            
            // Handle is_current and end_date
            $data['is_current'] = $request->has('is_current');
            if ($data['is_current']) {
                $data['end_date'] = null;
            }

            $education->update($data);

            return response()->json([
                'message' => 'Pendidikan berhasil diperbarui',
                'data' => $education
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Gagal memperbarui pendidikan',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $education = Education::findOrFail($id);
            
            if ($education->user_id !== auth()->id()) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            $education->delete();
            return response()->json(['message' => 'Pendidikan berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus pendidikan'], 500);
        }
    }
}
