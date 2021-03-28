<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    public static function zerofill($value, $width = 2)
    {
        return str_pad((string)$value, $width, "0", STR_PAD_LEFT);
    }

    public static function kekata($x) {
        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($x <12) {
            $temp = " ". $angka;
        } else if ($x <20) {
            $temp = Setup::kekata($x - 10). " belas";
        } else if ($x <100) {
            $temp = Setup::kekata($x/10)." puluh". Setup::kekata($x % 10);
        } else if ($x <200) {
            $temp = " seratus" . Setup::kekata($x - 100);
        } else if ($x <1000) {
            $temp = Setup::kekata($x/100) . " ratus" . Setup::kekata($x % 100);
        } else if ($x <2000) {
            $temp = " seribu" . Setup::kekata($x - 1000);
        } else if ($x <1000000) {
            $temp = Setup::kekata($x/1000) . " ribu" . Setup::kekata($x % 1000);
        } else if ($x <1000000000) {
            $temp = Setup::kekata($x/1000000) . " juta" . Setup::kekata($x % 1000000);
        } else if ($x <1000000000000) {
            $temp = Setup::kekata($x/1000000000) . " milyar" . Setup::kekata(fmod($x,1000000000));
        } else if ($x <1000000000000000) {
            $temp = Setup::kekata($x/1000000000000) . " trilyun" . Setup::kekata(fmod($x,1000000000000));
        }
        return $temp;
    }

    public static function terbilang($x, $style=4) {
        if($x<0) {
        $hasil = "minus ". trim(Setup::kekata($x));
        } else {
        $hasil = trim(Setup::kekata($x));
        }
        switch ($style) {
        case 1:
        $hasil = strtoupper($hasil);
        break;
        case 2:
        $hasil = strtolower($hasil);
        break;
        case 3:
        $hasil = ucwords($hasil);
        break;
        default:
        $hasil = ucfirst($hasil);
        break;
        }
        return $hasil;
    }

}
