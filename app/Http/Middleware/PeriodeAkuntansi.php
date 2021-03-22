<?php

namespace App\Http\Middleware;

use App\Models\Setting\Period;
use Closure;

class PeriodeAkuntansi
{
    public function handle($request, Closure $next)
    {
        if (Period::periode_aktif()) {
            return $next($request);
        }

        return redirect()->route('index')->with('error', "Tidak ditemukan periode akuntansi") ;
    }
}
