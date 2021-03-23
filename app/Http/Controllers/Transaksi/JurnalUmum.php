<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setup;
use Illuminate\Http\Request;

class JurnalUmum extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        $aruskas    =   Setup::where('slug', 'link')
                        ->where('status', 1)
                        ->pluck('values', 'id');

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
    }
}
