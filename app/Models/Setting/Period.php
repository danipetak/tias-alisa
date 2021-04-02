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
            if ($type == 'start') {
                return $periode->start ;
            }
        } else {
            return ($periode->count() > 0) ? TRUE : FALSE ;
        }
    }

    public static function selectPeriode($old=FALSE)
    {
        $periode    =   Period::whereIn('status', [2,3])
                        ->orderBy('start', 'DESC')
                        ->get();

        $data   =   '';
        foreach ($periode as $row) {
            $data   .=  "<option value='" . $row->id . "' " . (($old == $row->id) ? 'selected' : '') . "> " . date('d M Y', strtotime($row->start)) . " - " . date('d M Y', strtotime($row->end)) . " </option>" ;
        }
        return $data ;
    }
}
