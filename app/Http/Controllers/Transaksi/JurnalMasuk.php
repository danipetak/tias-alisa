<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Cashflow;
use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalMasuk extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        $aruskas    =   Cashflow::pluck('nama', 'id');
        return view('page.transaksi.kas_masuk.index', compact('aruskas'));
    }

    public function riwayat()
    {
        $riwayat    =   Header::list_trans(['CD']);
        return view('page.transaksi.master.riwayat', compact('riwayat'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'rekening_kas'      =>  'required',
            'tanggal_transaksi' =>  'required',
            'uraian'            =>  'required',
            'arus_kas'          =>  'required',
            'jenis_transaksi'   =>  'required|in:1,0'
        ]);

        $parent =   NULL;
        if ($request->jenis_transaksi == '0') {
            if ($request->riwayat_transaksi) {
                $riwayat    =   Header::where('id', $request->riwayat_transaksi)->where('reff', 'CD');
                if ($riwayat->count() > 0) {
                    $riwayat->delete();
                    $parent =   $request->riwayat_transaksi;
                } else {
                    $parent =   NULL;
                }
            } else {
                $parent =   NULL;
            }
        }

        $trans                      =   new Header;
        $trans->parent              =   $parent ?? NULL;
        $trans->user_id             =   Auth::user()->id;
        $trans->period_id           =   Period::periode_aktif('id');
        $trans->tanggal_transaksi   =   $request->tanggal_transaksi;
        $trans->reff                =   $parent ? 'CJ' : 'CD';
        $trans->nomor               =   Header::nomor_transaksi($parent ? 'CJ' : 'CD');
        $trans->uraian              =   $request->uraian;
        $trans->save();

        $list                       =   new Headlist ;
        $list->header_id            =   $trans->id ;
        $list->account_id           =   $request->rekening_kas ;
        $list->cashflow_id          =   $request->arus_kas ;
        $list->debit                =   $request->total ;
        $list->kredit               =   0 ;
        $list->save();

        $rekening               =   json_decode(json_encode($request->rekening), TRUE);
        $besar                  =   json_decode(json_encode($request->besar), TRUE);

        foreach ($rekening as $x => $row) {
            $list               =   new Headlist;
            $list->header_id    =   $trans->id;
            $list->account_id   =   $row;
            $list->cashflow_id  =   NULL;
            $list->debit        =   0;
            $list->kredit       =   $besar[$x];
            $list->save();
        }
    }
}
