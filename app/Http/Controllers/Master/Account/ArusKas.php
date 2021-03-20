<?php

namespace App\Http\Controllers\Master\Account;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Cashflow;
use Illuminate\Http\Request;

class ArusKas extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('page.master.account.arus_kas.index');
    }

    public function show()
    {
        $data   =   Cashflow::orderBy('aliran', 'ASC')
                    ->orderBy('kategori', 'ASC')
                    ->get();

        return view('page.master.account.arus_kas.show', compact('data'));
    }

    public function detail(Request $request)
    {
        return Cashflow::find($request->row_id) ;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_arus_kas'     =>  'required|string|max:100|unique:cashflows,nama',
            'aliran'            =>  'required|in:penerimaan,pengeluaran',
            'kategori'          =>  'required|in:operasional,pendanaan,investasi'
        ]);

        $aruskas                =   new Cashflow ;
        $aruskas->aliran        =   $request->aliran ;
        $aruskas->kategori      =   $request->kategori ;
        $aruskas->nama          =   $request->nama_arus_kas ;
        $aruskas->save() ;
    }

    public function destroy(Request $request)
    {
        return  Cashflow::find($request->row_id)->delete() ;
    }
}
