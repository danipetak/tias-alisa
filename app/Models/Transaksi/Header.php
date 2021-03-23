<?php

namespace App\Models\Transaksi;

use App\Models\Setting\Period;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use SoftDeletes;

    public static function nomor_transaksi($type)
    {
        $data   =   Header::select('nomor')
                    ->where('reff', $type)
                    ->where('period_id', Period::periode_aktif('id'))
                    ->orderBy('nomor', 'DESC')
                    ->limit(1)
                    ->first();

        return  $data ? ($data->nomor + 1) : 1 ;
    }
}
