<?php

namespace App\Models\Transaksi;

use App\Models\Setting\Period;
use App\Models\Setting\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Header extends Model
{
    use SoftDeletes;
    protected $appends  =   ['nomor_transaksi'];

    public function getNomorTransaksiAttribute()
    {
        return $this->reff . '-' . Setup::zerofill($this->nomor, 7);
    }

    public static function nomor_transaksi($type, $periode=FALSE)
    {
        $data   =   Header::select('nomor')
                    ->where(function($query) use ($type) {
                        if (($type == 'AJB') OR ($type == 'AJM') OR ($type == 'AJT')) {
                            $query->whereIn('reff', ['AJB','AJM','AJT']);
                        } else {
                            $query->where('reff', $type);
                        }
                    })
                    ->where(function($query) use ($periode) {
                        if ($periode) {
                            $query->where('period_id', $periode);
                        } else {
                            $query->where('period_id', Period::periode_aktif('id'));
                        }
                    })
                    ->orderBy('nomor', 'DESC')
                    ->limit(1)
                    ->withTrashed()
                    ->first();

        return  $data ? ($data->nomor + 1) : 1 ;
    }

    public static function list_trans($reff=FALSE, $periode=FALSE)
    {
        $riwayat    =   Header::where(function($query) use ($reff) {
                            if ($reff) {
                                $query->whereIn('reff', $reff);
                            }
                        })
                        ->where('period_id', $periode ? $periode : Period::periode_aktif('id'))
                        ->orderBy('id', 'DESC')
                        ->get();

        $data   =   '';
        foreach ($riwayat as $row) {
            $data   .=  "<option value='" . $row->id . "'>";
            $data   .=  $row->nomor_transaksi . ' | ' . $row->uraian;
            $data   .=  "</option>";
        }

        return $data;
    }
}
