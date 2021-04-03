<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Cashflow;
use App\Models\Setting\Period;
use Illuminate\Http\Request;

class ArusKas extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profil']);
    }

    public function index(Request $request)
    {
        $periode    =   $request->periode ?? Period::periode_aktif('id') ;
        $period     =   Period::whereIn('status', [2, 3, 4])->get();

        $around     =   Period::find($periode);

        $before     =   Period::where('end', '<', $around->start)
                        ->orderBy('end', 'DESC')
                        ->first();

        return view('page.laporan.arus_kas.index', compact('period', 'periode', 'around', 'before'));
    }

    public function show(Request $request, $id)
    {
        # code...
    }
}
