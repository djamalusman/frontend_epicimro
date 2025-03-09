<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Cache;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = 6; // Batasi jumlah gambar per halaman
        $cacheKey = "gallery_page_{$page}";

        $gallery = Cache::remember($cacheKey, 60, function () use ($limit, $page) {
            return Gallery::skip(($page - 1) * $limit)->take($limit)->get();
        });

        return response()->json($gallery);
    }
}
