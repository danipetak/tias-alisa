<?php

namespace App\Models\Setting\Account;

use App\Models\Setting\Period;
use App\Models\Setting\Setup;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    use SoftDeletes;
    protected $appends  =   ['saldo_normal', 'link_akun', 'ambil_rekening'];

    public function getAmbilRekeningAttribute()
    {
        return $this->kode_akun . ' ' . $this->nama_akun;
    }

    public function getSaldoNormalAttribute()
    {
        return $this->sn == 'db' ? 'Debit' : 'Kredit';
    }

    public function getLinkAkunAttribute()
    {
        return $this->link_id ? 'Terhubung ke ' . $this->penghubung->values : '';
    }

    // Mutasi
    public static function mutasi_transaksi($periode, $akun, $nominal = FALSE)
    {
        $data   =   Header::select('id')
                    ->whereIn('id', Headlist::select('header_id')->where('account_id', $akun))
                    ->where('period_id', $periode)
                    ->get();

        $total  =   0;
        foreach ($data as $row) {
            $total  +=  $row->total_transaksi;
        }

        if ($nominal) {
            return $total;
        } else {
            return $total < 0 ? "(" . number_format(abs($total), 2) . ")" : number_format($total, 2);
        }
    }

    // Saldo Awal
    public static function saldo_awal($periode, $akun, $saldo_awal, $nominal = FALSE)
    {
        $data   =   Header::select('id')
                    ->whereIn('id', Headlist::select('header_id')->where('account_id', $akun))
                    ->whereIn('period_id', Period::select('id')->where('status', '>', 2)->whereDate('start', '<', Period::find($periode)->start))
                    ->get();

        $total  =   0;
        foreach ($data as $row) {
            $total  +=  $row->total_transaksi;
        }

        $hasil  =   $saldo_awal + $total;
        if ($nominal) {
            return $hasil ;
        } else {
            return $hasil < 0 ? "(" . number_format(abs($hasil), 2) . ")" : number_format($hasil, 2) ;
        }
    }

    // Saldo Akhir
    public static function saldo_akhir($periode, $akun, $saldo_awal, $nominal = FALSE)
    {
        $hasil  =   Account::mutasi_transaksi($periode, $akun, TRUE) + Account::saldo_awal($periode, $akun, $saldo_awal, TRUE);
        if ($nominal) {
            return $hasil;
        } else {
            return $hasil < 0 ? "(" . number_format(abs($hasil), 2) . ")" : number_format($hasil, 2);
        }
    }

    public function penghubung()
    {
        return $this->belongsTo(Setup::class, 'link_id', 'id');
    }

    public static function turunan_akun($id)
    {
        $status =   FALSE ;
        if (Account::where('parent', $id)->count() < 1) {
            $status =   (Headlist::where('account_id', $id)->count() > 0) ? FALSE : TRUE ;
        }

        return $status ;
    }

    public static function daftar_akun($id=FALSE, $link=FALSE)
    {
        $akun   =   Account::where('level', 4)
                    ->where(function($query) use ($link) {
                        if ($link) {
                            if ($link == 'kas') {
                                $query->whereIn('link_id', [2,3,4]);
                            }
                            if ($link == 'nonkas') {
                                $query->whereNotIn('link_id', [2,3,4]);
                            }
                        }
                    })
                    ->orderBy('kode_akun', 'ASC')
                    ->get();

        $data   =   '';
        foreach ($akun as $row) {
            $data   .=  "<option value='" . $row->id . "' " . ($id == $row->id ? 'selected' : '') . " >" . $row->ambil_rekening . "</option>";
        }

        return $data;
    }

    public static function posisi_keuangan($parent, $periode, $nominal=FALSE)
    {
        $akun   =   Account::select('id', 'begining_balance', 'sn')
                    ->where('parent', $parent)
                    ->get();

        $total  =   0;
        foreach ($akun as $row) {
            $saldo_awal =   (Account::find($parent)->sn != $row->sn) ? (-$row->begining_balance) : $row->begining_balance;
            $total      +=  Account::saldo_akhir($periode, $row->id, $saldo_awal, TRUE);
        }

        if ($nominal) {
            return $total ;
        } else {
            if ($total != 0) {
                return $total < 0 ? "(" . number_format(abs($total), 2) . ")" : number_format($total, 2);
            }
        }

    }
}
