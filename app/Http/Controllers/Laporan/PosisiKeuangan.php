<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Http\Request;

class PosisiKeuangan extends Controller
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

        $aset       =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 1)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        $kewajiban  =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 2)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        $modal      =   Account::select('id', 'nama_akun', 'kode_akun')
                        ->where('head', 3)
                        ->whereIn('level', [1,2,3])
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

        return view('page.laporan.posisi_keuangan.index', compact('periode', 'period', 'aset', 'kewajiban', 'modal', 'before'));
    }

    public function show(Request $request, $id)
    {
        $periode    =   $request->periode ?? Period::periode_aktif('id');
        $period     =   Period::whereIn('status', [2, 3, 4])->get();

        $data       =   Account::whereIn('level', [2,3])
                        ->whereIn('head', [1,2,3])
                        ->where('id', $id)
                        ->first();

        if ($data) {
            $akun   =   Account::where('parent', $data->id)
                        ->orderBy('kode_akun', 'ASC')
                        ->get();

            return view('page.laporan.posisi_keuangan.show', compact('data', 'periode', 'period', 'akun'));
        }
        return redirect()->route('posisikeuangan.index');

    }
}
