<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JurnalMasuk extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        return view('page.transaksi.kas_masuk.index');
    }
}
