<?php

namespace App\Models\Setting\Account;

use App\Models\Setting\Setup;
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

    public static function daftar_akun($id=FALSE)
    {
        $akun   =   Account::where('level', 4)
                    ->orderBy('kode_akun', 'ASC')
                    ->get();

        $data   =   '';
        foreach ($akun as $row) {
            $data   .=  "<option value='" . $row->id . "' " . ($id == $row->id ? 'selected' : '') . " >" . $row->ambil_rekening . "</option>";
        }

        return $data;
    }
}
