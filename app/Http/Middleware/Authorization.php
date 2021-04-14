<?php

namespace App\Http\Middleware;
use Closure;

class Authorization
{
	// Membuat Function Handle
	public function handle($request, Closure $next) {
		// Buat pengecakan terhadap method GET dan Name
		if($request->get('nama')) {
			return response()->json([
				'nama' => $request->get('nama'),
				'status' => 'Nama Tersedia'
			]);
		}
		return $next($request);
	}
}