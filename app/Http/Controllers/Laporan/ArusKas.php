<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Cashflow;
use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Http\Request;
use Periode;

class ArusKas extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profil']);
    }

    public function index(Request $request)
    {
        $periode    =   $request->periode ?? Period::periode_aktif('id') ;
        $period     =   Period::whereIn('status', [2, 3, 4])->get();

        $around     =   Period::find($periode);

        $before     =   Period::where('end', '<', $around->start)
                        ->orderBy('end', 'DESC')
                        ->first();

        return view('page.laporan.arus_kas.index', compact('period', 'periode', 'around', 'before'));
    }

    public function show(Request $request, $id)
    {
        $q          =   $request->q ?? '' ;
        $data       =   Cashflow::find($id);
        $periode    =   Periode::find($request->periode ?? Periode::periode_aktif('id'));
        if ($data) {
            $trans  =   Header::whereIn('id', Headlist::select('header_id')->where('cashflow_id', $data->id))
                        ->where('period_id', $request->periode ?? Periode::periode_aktif('id'))
                        ->withTrashed()
                        ->orderBy('tanggal_transaksi', 'DESC')
                        ->get();

            $trans  =   $trans->filter(function ($item) use ($q) {
                            $res = true;
                            if ($q != "") {
                                $res =  (false !== stripos($item->nomor_transaksi, $q)) ||
                                        (false !== stripos($item->uraian, $q)) ||
                                        (false !== stripos($item->total_transaksi, $q)) ||
                                        (false !== stripos($item->report_total, $q));
                            }
                            return $res;
                        });

            $trans  =   $trans->paginate(40);

            return view('page.laporan.arus_kas.show', compact('q', 'data', 'trans', 'periode'));
        }

        return redirect()->route('aruskas.index');
    }
}
