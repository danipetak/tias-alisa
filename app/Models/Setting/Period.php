<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tanggal;

class Period extends Model
{
    use SoftDeletes ;
    protected $appends  =   ['mulai', 'selesai', 'status_periode'] ;

    public function getMulaiAttribute()
    {

        return Tanggal::date($this->start);
    }

    public function getSelesaiAttribute()
    {
        return Tanggal::date($this->end);
    }

    public function getStatusPeriodeAttribute()
    {
        if ($this->status == 1) {
            return 'Pending' ;
        }
        if ($this->status == 2) {
            return 'Aktif' ;
        }
        if ($this->status == 3) {
            return 'Berakhir' ;
        }
        if ($this->status == 4) {
            return 'Tutup Buku' ;
        }
    }

    public static function periode_aktif($type=FALSE)
    {
        $periode    =   Period::where('status', 2);
        if ($type) {
            $periode    =   $periode->first() ;
            if ($type == 'id') {
                return $periode->id ;
            }
            if ($type == 'tanggal') {
                return $periode->mulai . ' - ' . $periode->selesai ;
            }
        } else {
            return ($periode->count() > 0) ? TRUE : FALSE ;
        }

    }
}
