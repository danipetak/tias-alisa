<?php

namespace App\Models\Setting\Account;

use App\Models\Setting\Period;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Cashflow extends Model
{
    public static function report_akun($aliran = FALSE, $kategori = FALSE, $periode = FALSE)
    {
        $before         =   Period::where('end', '<', Period::find($periode)->start)
                            ->orderBy('end', 'DESC')
                            ->first();

        $daftar_periode =   $before ? [$periode, $before->id] : [$periode] ;

        return Cashflow::select('cashflows.id AS idcash', 'cashflows.nama')
        ->where(function ($query) use ($aliran) {
            if ($aliran) {
                $query->where('aliran', $aliran);
            }
        })
        ->where(function ($query) use ($kategori) {
            if ($kategori) {
                $query->where('kategori', $kategori);
            }
        })
        ->leftJoin('headlists', 'headlists.cashflow_id', '=', 'cashflows.id')
        ->whereIn('header_id', Header::select('id')->whereIn('period_id', $daftar_periode))
        ->groupBy('idcash')
        ->get();
    }

    public static function hasil_report($kategori, $periode, $aliran=FALSE, $id=FALSE)
    {
        return Cashflow::select(DB::raw("(SUM(headlists.debit)-SUM(headlists.kredit)) AS total"))
        ->leftJoin('headlists', 'headlists.cashflow_id', '=', 'cashflows.id')
        ->where('kategori', $kategori)
        ->whereIn('header_id', Header::select('id')->where('period_id', $periode))
        ->where(function($query) use ($aliran) {
            if ($aliran) {
                $query->where('aliran', $aliran);
            }
        })
        ->where(function($query) use ($id) {
            if ($id) {
                $query->where('cashflows.id', $id);
            }
        })
        ->first()
        ->total;
    }

    public static function awal_periode($periode)
    {
        $saldo_awal =   Account::select('begining_balance')
                        ->whereIn('id', Headlist::select('account_id')->whereIn('header_id', Header::select('id')))
                        ->whereIn('link_id', [2,3,4])
                        ->whereIn('period_id', Period::select('id')->where('start', '<=', Period::find($periode)->start))
                        ->sum('begining_balance');

        $transaksi  =   Headlist::select(DB::raw('(SUM(debit) - SUM(kredit)) AS total'))
                        ->whereIn('cashflow_id', Cashflow::select('id'))
                        ->whereIn('header_id', Header::select('id')
                            ->whereIn('period_id', Period::select('id')->where('start', '<', Period::find($periode)->start)->whereIn('status', [2,3,4]))
                        )->first();

        return $saldo_awal + $transaksi->total;
    }
}
