<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use Illuminate\Http\Request;

class SaldoAwal extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        $data   =   Account::orderBy('kode_akun', 'ASC')
                    ->get();

        $debit  =   0;
        $kredit =   0;
        foreach ($data as $row) {
            if ($row->sn == 'db') {
                $debit  +=  $row->begining_balance ;
            } else {
                $kredit +=  $row->begining_balance ;
            }
        }

        return view('page.transaksi.saldo_awal.index', compact('data', 'debit', 'kredit'));
    }

    public function store(Request $request)
    {
        $count  =   count($request->x_code) ;

        if ($count > 0) {
            for ($x=0; $x < $count; $x++) {
                $saldo                      =   Account::find($request->x_code[$x]) ;
                $saldo->begining_balance    =   $request->nom[$x] ?? 0 ;
                $saldo->save() ;
            }
        }

        return back()->with('status', 'Saldo awal berhasil diperbaharui');
    }
}
