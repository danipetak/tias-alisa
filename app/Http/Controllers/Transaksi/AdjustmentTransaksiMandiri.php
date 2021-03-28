<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use App\Models\Setting\Account\Cashflow;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use App\Rules\Account\PeriodeTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdjustmentTransaksiMandiri extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        $aruskas    =   Cashflow::pluck('nama', 'id');
        return view('page.transaksi.adjustment_mandiri.index', compact('aruskas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'periode_akuntansi' =>  ['required', Rule::exists('periods', 'id')->whereIn('status', [2, 3])],
            'tanggal_transaksi' =>  ['required', new PeriodeTransaksi($request->periode_akuntansi)],
            'uraian'            =>  'required',
            'arus_kas'          =>  'required',
        ]);

        $trans                      =   new Header;
        $trans->user_id             =   Auth::user()->id;
        $trans->period_id           =   $request->periode_akuntansi;
        $trans->tanggal_transaksi   =   $request->tanggal_transaksi;
        $trans->reff                =   'AJM';
        $trans->nomor               =   Header::nomor_transaksi('AJM', $request->periode_akuntansi);
        $trans->uraian              =   $request->uraian;
        $trans->save();

        $rekening   =   json_decode(json_encode($request->valRekening), TRUE);
        $debit      =   json_decode(json_encode($request->data_db), TRUE);
        $kredit     =   json_decode(json_encode($request->data_cr), TRUE);

        foreach ($rekening as $x => $row) {
            $rekening           =   Account::where('id', $row)->first();
            $aruskas            =   (($rekening->link_id == 2) or ($rekening->link_id == 3) or ($rekening->link_id == 4)) ? $request->arus_kas : NULL;
            $list               =   new Headlist;
            $list->header_id    =   $trans->id;
            $list->account_id   =   $row;
            $list->cashflow_id  =   $aruskas;
            $list->debit        =   $debit[$x];
            $list->kredit       =   $kredit[$x];
            $list->save();
        }
    }
}
