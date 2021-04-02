<?php

namespace App\Models\Setting\Account;

use App\Models\Setting\Period;
use App\Models\Setting\Setup;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    protected $appends  =   ['saldo_normal', 'link_akun', 'ambil_rekening', 'hitung_mutasi', 'total_mutasi', 'hitung_begining', 'saldo_awal', 'hitung_akhir', 'saldo_akhir'];

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
    public function getHitungMutasiAttribute()
    {
        $data   =   Header::select('id')
                    ->whereIn('id', Headlist::select('header_id')->where('account_id', $this->id))
                    ->get();

        $total  =   0;
        foreach ($data as $row) {
            $total  +=  $row->total_transaksi;
        }

        return $total;
    }

    public function getTotalMutasiAttribute()
    {
        if ($this->hitung_mutasi == 0) {
            return '0.00';
        } else {
            return $this->hitung_mutasi > 0 ? number_format($this->hitung_mutasi, 2) : "(" . number_format(abs($this->hitung_mutasi), 2) . ")";
        }
    }

    // Saldo Awal
    public function getHitungBeginingAttribute()
    {
        $data   =   Header::select('id')
                    ->whereIn('id', Headlist::select('header_id')->where('account_id', $this->id))
                    ->whereIn('period_id', Period::select('id')->where('status', '>', 2)->whereDate('start', '<', Period::periode_aktif('start')))
                    ->get();

        $total  =   0;
        foreach ($data as $row) {
            $total  +=  $row->total_transaksi;
        }

        return $this->begining_balance + $total ;
    }

    public function getSaldoAwalAttribute()
    {
        if ($this->hitung_begining == 0) {
            return '0.00';
        } else {
            return $this->hitung_begining > 0 ? number_format($this->hitung_begining, 2) : "(" . number_format(abs($this->hitung_begining), 2) . ")";
        }
    }

    // Saldo Akhir
    public function getSaldoAkhirAttribute()
    {
        $hasil  =   $this->hitung_begining + $this->hitung_mutasi ;

        if ($hasil == 0) {
            return '0.00';
        } else {
            return $hasil > 0 ? number_format($hasil, 2) : "(" . number_format(abs($hasil), 2) . ")";
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
}
