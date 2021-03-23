<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use App\Models\Setting\Account\Cashflow;
use App\Models\Setting\Period;
use App\Models\Setting\Setup;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalUmum extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        $aruskas    =   Cashflow::pluck('nama', 'id');

        return view('page.transaksi.jurnal_umum.index', compact('aruskas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal_transaksi' =>  'required',
            'uraian'            =>  'required',
            'arus_kas'          =>  'required',
            'jenis_transaksi'   =>  'required|in:1,0'
        ]);

        $json   = $request->valRekening;
        $trans                      =   new Header ;
        $trans->user_id             =   Auth::user()->id ;
        $trans->period_id           =   Period::periode_aktif('id') ;
        $trans->tanggal_transaksi   =   $request->tanggal_transaksi ;
        $trans->reff                =   'GJ' ;
        $trans->nomor               =   Header::nomor_transaksi('GJ') ;
        $trans->uraian              =   $request->uraian ;
        $trans->save() ;
    }
}
