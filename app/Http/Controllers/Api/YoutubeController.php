<?php

namespace App\Http\Controllers\Api;
use App\Models\YoutubeTestimonial;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class YoutubeController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $limit = 6; // Batasi jumlah video per halaman
        $cacheKey = "youtube_page_{$page}";

        $youtube = Cache::remember($cacheKey, 60, function () use ($limit, $page) {
            return YoutubeTestimonial::skip(($page - 1) * $limit)->take($limit)->get();
        });

        return response()->json($youtube);
    }
}
