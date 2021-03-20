<?php

namespace App\Http\Controllers\Master\Account;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use Illuminate\Http\Request;

class RekeningAkuntansi extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        return view('page.master.account.chartofaccount.index');
    }

    public function show()
    {
        $data   =   Account::orderBy('kode_akun', 'ASC')
                    ->get();

        return view('page.master.account.chartofaccount.show', compact('data'));
    }
}
