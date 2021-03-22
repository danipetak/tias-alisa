<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use Illuminate\Http\Request;

class SaldoAwal extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
}
