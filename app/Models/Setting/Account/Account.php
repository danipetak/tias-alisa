<?php

namespace App\Models\Setting\Account;

use App\Models\Setting\Setup;
use App\Models\Transaksi\Headlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
