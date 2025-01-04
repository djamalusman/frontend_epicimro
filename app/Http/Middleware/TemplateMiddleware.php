<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TemplateMiddleware
{
    public function handle(Request $request, Closure $next, $template)
    {
       // Tentukan layout berdasarkan template yang dipilih
       view()->share('template', $template);
       return $next($request);
    }
}

