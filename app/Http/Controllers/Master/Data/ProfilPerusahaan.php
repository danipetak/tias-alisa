<?php

namespace App\Http\Controllers\Master\Data;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setup;
use Illuminate\Http\Request;

class ProfilPerusahaan extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data   =   Setup::where('slug', 'profil')->first();

        $row    =   '';
        if ($data) {
            $row    =   json_decode($data->json_content, FALSE);
        }

        return view('page.master.data.profil_perusahaan.index', compact('row'));
    }

    public function store(Request $request)
    {
        $row    =   [
            'nama_perusahaan'   =>  $request->nama_perusahaan,
            'nomor_telepon'     =>  $request->nomor_telepon,
            'fax'               =>  $request->fax,
            'email'             =>  $request->email,
            'npwp'              =>  $request->npwp,
            'alamat'            =>  $request->alamat,
            'pemilik_perusahaan' =>  $request->pemilik_perusahaan,
            'akuntan_perusahaan' =>  $request->akuntan_perusahaan,
        ];

        $data   =   Setup::where('slug', 'profil')->first();

        if ($data) {
            $setup                  =   Setup::find($data->id) ;
            $setup->json_content    =   json_encode($row) ;
            $setup->save();
        } else {
            $setup                  =   new Setup ;
            $setup->slug            =   'profil' ;
            $setup->json_content    =   json_encode($row);
            $setup->save() ;
        }

        return back()->with('status', 'Profil perusahaan berhasil diperbaharui') ;
    }
}
