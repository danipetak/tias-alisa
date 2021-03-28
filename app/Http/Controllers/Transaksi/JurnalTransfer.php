<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use App\Rules\Account\PeriodeTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalTransfer extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        return view('page.transaksi.transfer_kas.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal_transaksi' =>  ['required', new PeriodeTransaksi(Period::periode_aktif('id'))],
            'uraian'            =>  'required',
        ]);

        $trans                      =   new Header;
        $trans->user_id             =   Auth::user()->id;
        $trans->period_id           =   Period::periode_aktif('id');
        $trans->tanggal_transaksi   =   $request->tanggal_transaksi;
        $trans->reff                =   'TRF';
        $trans->nomor               =   Header::nomor_transaksi('TRF');
        $trans->uraian              =   $request->uraian;
        $trans->save();

        $rekening   =   json_decode(json_encode($request->valRekening), TRUE);
        $debit      =   json_decode(json_encode($request->data_db), TRUE);
        $kredit     =   json_decode(json_encode($request->data_cr), TRUE);

        foreach ($rekening as $x => $row) {
            $list               =   new Headlist();
            $list->header_id    =   $trans->id;
            $list->account_id   =   $row;
            $list->debit        =   $debit[$x];
            $list->kredit       =   $kredit[$x];
            $list->save();
        }
    }
}
