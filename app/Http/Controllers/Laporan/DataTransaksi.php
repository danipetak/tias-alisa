<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use Illuminate\Http\Request;

class DataTransaksi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $periode    =   $request->periode ?? '';
        $period     =   Period::whereIn('status', [2,3,4])->get();

        $trans      =   Header::where(function($query) use ($periode) {
                            if ($periode) {
                                $query->where('period_id', $periode);
                            }
                        })
                        ->orderBy('tanggal_transaksi', 'DESC')
                        ->orderBy('id', 'DESC')
                        ->withTrashed()
                        ->paginate(50);

        return view('page.laporan.data_transaksi.index', compact('period', 'periode', 'trans'));
    }
}
