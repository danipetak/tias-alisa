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
        return view('page.transaksi.saldo_awal.index');
    }

    public function show()
    {
        $data   =   Account::orderBy('kode_akun', 'ASC')
                    ->get();

        return view('page.transaksi.saldo_awal.show', compact('data'));
    }
}
