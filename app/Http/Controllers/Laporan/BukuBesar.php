<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Account\Account;
use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Http\Request;

class BukuBesar extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'profil']);
    }

    public function index(Request $request)
    {
        $trans      =   '';
        $list       =   '';
        $q          =   $request->q ?? '';
        $periode    =   $request->periode ?? Period::periode_aktif('id');
        $period     =   Period::whereIn('status', [2, 3, 4])->get();
        if ($request->trans) {
            $trans  =   Account::where('id', $request->trans)
                        ->where('level', 4)
                        ->first();
        }

        if ($trans) {
            $list   =   Header::whereIn('id', Headlist::select('header_id')->where('account_id', $trans->id))
                        ->where('period_id', $periode)
                        ->withTrashed()
                        ->orderBy('tanggal_transaksi', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->get();

            $list   =   $list->filter(function ($item) use ($q) {
                            $res = true;
                            if ($q != "") {
                                $res =  (false !== stripos($item->nomor_transaksi, $q)) ||
                                        (false !== stripos($item->uraian, $q)) ||
                                        (false !== stripos($item->report_total, $q));
                            }
                            return $res;
                        });

            $list       =   $list->paginate(40);
        }

        return view('page.laporan.buku_besar.index', compact('trans', 'list', 'q', 'periode', 'period'));
    }
}
