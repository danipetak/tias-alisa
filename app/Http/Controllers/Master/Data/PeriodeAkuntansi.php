<?php

namespace App\Http\Controllers\Master\Data;

use App\Http\Controllers\Controller;
use App\Models\Setting\Period;
use App\Rules\Account\HapusPeriode;
use App\Rules\Account\PeriodeAktif;
use Illuminate\Http\Request;

class PeriodeAkuntansi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('page.master.data.periode_akuntansi.index');
    }

    public function show()
    {
        $data   =   Period::orderBy('start', 'DESC')->get();
        return view('page.master.data.periode_akuntansi.show', compact('data')) ;
    }

    public function info()
    {
        return view('page.master.data.periode_akuntansi.info');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tanggal_mulai'     =>  'required|date',
            'tanggal_berakhir'  =>  'required|date|after:tanggal_mulai'
        ]);

        $periode                =   new Period ;
        $periode->start         =   $request->tanggal_mulai ;
        $periode->end           =   $request->tanggal_berakhir ;
        $periode->status        =   1 ;
        $periode->save() ;
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'row_id'    =>  new PeriodeAktif
        ]);

        $periode            =   Period::find($request->row_id) ;
        $periode->status    =   ($periode->status + 1) ;
        $periode->save() ;
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'row_id'    =>  new HapusPeriode
        ]);

        Period::find($request->row_id)->delete() ;
    }
}
