<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use App\Models\Setting\Period;
use Illuminate\Http\Request;

class LabaRugi extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profil']);
    }

    public function index(Request $request)
    {
        $periode    =   $request->periode ?? Period::periode_aktif('id');
        $period     =   Period::whereIn('status', [2, 3, 4])->get();

        $before     =   Period::where('end', '<', Period::find($periode)->start)
                        ->orderBy('end', 'DESC')
                        ->first();

        $penerimaan =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 4)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        $biaya      =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 5)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        $beban      =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 6)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        $kos        =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 7)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        $cash_other =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 8)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        $cost_other =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 9)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        return view('page.laporan.laba_rugi.index', compact('periode', 'period', 'before', 'penerimaan', 'biaya', 'beban', 'kos', 'cash_other', 'cost_other'));
    }
}
