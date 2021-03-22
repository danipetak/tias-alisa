<?php

namespace App\Http\Controllers\Master\Account;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use App\Models\Setting\Period;
use App\Models\Setting\Setup;
use Illuminate\Http\Request;

class RekeningAkuntansi extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'periode']);
    }

    public function index()
    {
        $link   =   Setup::where('slug', 'link')
                    ->where('status', 1)
                    ->pluck('values', 'id');

        $keylink =   '';
        foreach ($link as $id => $row) {
            $keylink    .=  "<option value='" . $id . "'>" . $row . "</option>";
        }
        return view('page.master.account.chartofaccount.index', compact('keylink'));
    }

    public function show()
    {
        $data   =   Account::orderBy('kode_akun', 'ASC')
                    ->get();

        $link   =   Setup::where('slug', 'link')
                    ->where('status', 1)
                    ->pluck('values', 'id');

        $keylink=   '';
        foreach ($link as $id => $row) {
            $keylink    .=  "<option value='" . $id . "'>" . $row . "</option>" ;
        }

        return view('page.master.account.chartofaccount.show', compact('data', 'keylink'));
    }

    public function detail(Request $request)
    {
        # code...
    }

    public function store(Request $request)
    {
        if (is_null($request->x_code)) {
            return back();
        }

        for ($x=0; $x < COUNT($request->x_code); $x++) {
            $data   =   Account::where('id', $request->x_code[$x])->first();
            $link   =   $request->link[$x] ?? NULL ;

            if ($link == NULL) {
                $link_account   =   TRUE ;
            } else {
                $link_account   =   Setup::where('slug', 'link')
                                    ->where('status', 1)
                                    ->where('id', $link)
                                    ->count();
            }

            $kode   =   $request->kode[$x] ?? NULL ;
            $nama   =   $request->nama[$x] ?? NULL ;

            if ($data->level != 4) {
                if ($link_account > 0) {
                    if ($nama AND $kode) {
                        $akun               =   new Account ;
                        $akun->parent       =   $data->id ;
                        $akun->head         =   $data->head ;
                        $akun->kode_akun    =   $data->kode_akun.$request->kode[$x] ;
                        $akun->nama_akun    =   $request->nama[$x] ;
                        $akun->tipe_akun    =   $data->tipe_akun ;
                        $akun->level        =   ($data->endpoin == 1) ? 4 : ($data->level + 1) ;
                        $akun->sn           =   $request->sn[$x] ;
                        $akun->period_id    =   ($akun->level == 4) ? Period::periode_aktif('id') : NULL ;
                        $akun->link_id      =   (($data->level == 3) OR ($data->endpoin == 1)) ? $request->link[$x] : NULL ;
                        $akun->endpoin      =   $request->stop[$x] ?? NULL ;
                        $akun->status       =   1 ;
                        $akun->save() ;
                    }
                }
            }
        }

        return back()->with('status', 'Tambah rekening akuntansi berhasil') ;
    }
}
