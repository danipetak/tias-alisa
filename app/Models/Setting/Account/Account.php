<?php

namespace App\Models\Setting\Account;

use App\Models\Setting\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;
    protected $appends  =   ['saldo_normal', 'link_akun'];

    public function getSaldoNormalAttribute()
    {
        if ($this->sn == 'db') {
            return 'Debit' ;
        }
        if ($this->sn == 'cr') {
            return 'Kredit' ;
        }
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
            // Yang dicomment diaktifkan saat sudah ada header transaksi
            // if (condition) {
            //     # code...
            // } else {
                $status =   TRUE ;
            // }
        }

        return $status ;
    }
}
