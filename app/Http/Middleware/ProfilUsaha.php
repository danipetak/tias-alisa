<?php

namespace App\Http\Middleware;

use App\Models\Setting\Setup;
use Closure;

class ProfilUsaha
{
    public function handle($request, Closure $next)
    {
        if (Setup::where('slug', 'profil')->count() > 0) {
            return $next($request);
        }

        return redirect()->route('index')->with('error', "Silahkan lakukan pembaharuan data profil perusahaan");
    }
}
