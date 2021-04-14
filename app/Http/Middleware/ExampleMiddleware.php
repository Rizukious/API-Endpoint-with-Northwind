<?php

namespace App\Http\Middleware;

use Closure;

class ExampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Membuat aksi yang akan dijalankan ketika ada request masuk
        if(true) {
            return response()->json(['status' => false, 'message' => 'Middleware Example diaktifkan'], 401);
        }
        return $next($request);
    }
}
