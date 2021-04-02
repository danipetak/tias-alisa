<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use Illuminate\Http\Request;
use Tanggal;

class PeriodeJurnal extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profil']);
    }

    public function index(Request $request)
    {
        $periode    =   $request->periode ?? '';
        $q          =   $request->q ?? '';
        $period     =   Period::whereIn('status', [2, 3, 4])->get();

        $trans      =   Header::where(function ($query) use ($periode) {
                            if ($periode) {
                                $query->where('period_id', $periode);
                            }
                        })
                        ->orderBy('tanggal_transaksi', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->withTrashed()
                        ->get();

        $trans      =   $trans->filter(function ($item) use ($q) {
                            $res = true;
                            if ($q != "") {
                                $res =  (false !== stripos($item->tanggal_transaksi, $q)) ||
                                        (false !== stripos(Tanggal::date($item->tanggal_transaksi), $q)) ||
                                        (false !== stripos($item->nomor_transaksi, $q)) ||
                                        (false !== stripos($item->uraian, $q));
                            }
                            return $res;
                        });

        $trans      =   $trans->paginate(20);

        return view('page.laporan.periode_jurnal.index', compact('period', 'periode', 'q', 'trans'));
    }
}
