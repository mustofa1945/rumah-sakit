<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForceLoginPath
{
    public function handle(Request $request, Closure $next)
    {
        
        $response = $next($request);

        // if (!Auth::check()) {
        //     // Ganti dengan path yang kamu mau
        //     return redirect()->route("home.index"); // bisa ganti '/custom-path'
        // }

        return $response;
    }
}
