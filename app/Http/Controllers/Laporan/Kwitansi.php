<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setup;
use App\Models\Transaksi\Header;
use App\Models\Transaksi\Headlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use QrCode;

class Kwitansi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('index')->with('error', 'Tidak ditemukan transaksi');
    }

    public function show($id)
    {
        $data   =   Header::where('id', $id)
                    ->withTrashed()
                    ->first();

        if ($data) {
            $terbilang  =   $this->terbilang($data->total_transaksi, 1);

            $list       =   Headlist::where('header_id', $data->id)->get();
            $barcode    =   base64_encode(QrCode::format('svg')->size(50)->errorCorrection('H')->generate('lorem'));
            $usaha      =   json_decode(Setup::where('slug', 'profil')->first()->json_content, FALSE);
            $pdf        =   App::make('dompdf.wrapper');
            $pdf->loadView('page.laporan.unduh.kwitansi', compact('data', 'terbilang', 'list', 'barcode', 'usaha'))->setPaper('a5');
            return $pdf->stream();
        }
        return redirect()->route('index')->with('error', 'Tidak ditemukan transaksi');
    }

    public function kekata($x)
    {
        $x = abs($x);
        $angka  =   ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
        $temp   =   "";
        if ($x < 12) {
            $temp   =   " " . $angka[$x];
        } else if ($x < 20) {
            $temp   =   $this->kekata($x - 10) . " belas";
        } else if ($x < 100) {
            $temp   =   $this->kekata($x / 10) . " puluh" . $this->kekata($x % 10);
        } else if ($x < 200) {
            $temp   =   " seratus" . $this->kekata($x - 100);
        } else if ($x < 1000) {
            $temp   =   $this->kekata($x / 100) . " ratus" . $this->kekata($x % 100);
        } else if ($x < 2000) {
            $temp   =   " seribu" . $this->kekata($x - 1000);
        } else if ($x < 1000000) {
            $temp   =   $this->kekata($x / 1000) . " ribu" . $this->kekata($x % 1000);
        } else if ($x < 1000000000) {
            $temp   =   $this->kekata($x / 1000000) . " juta" . $this->kekata($x % 1000000);
        } else if ($x < 1000000000000) {
            $temp   =   $this->kekata($x / 1000000000) . " milyar" . $this->kekata(fmod($x, 1000000000));
        } else if ($x < 1000000000000000) {
            $temp   =   $this->kekata($x / 1000000000000) . " trilyun" . $this->kekata(fmod($x, 1000000000000));
        }
        return $temp;
    }

    public function tkoma($x)
    {
        $str = stristr($x, ",");
        $ex = explode(',', $x);

        if (($ex[1] / 10) >= 1) {
            $a = abs($ex[1]);
        }
        $string = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";

        $a2 = $ex[1] / 10;
        $pjg = strlen($str);
        $i = 1;


        if ($a >= 1 && $a < 12) {
            $temp .= " " . $string[$a];
        } else if ($a > 12 && $a < 20) {
            $temp .= konversi($a - 10) . " belas";
        } else if ($a > 20 && $a < 100) {
            $temp .= konversi($a / 10) . " puluh" . konversi($a % 10);
        } else {
            if ($a2 < 1) {

                while ($i < $pjg) {
                    $char = substr($str, $i, 1);
                    $i++;
                    $temp .= " " . $string[$char];
                }
            }
        }
        return $temp;
    }


    public function terbilang($x, $style = 4)
    {
        $before     =   trim($this->kekata($x));
        $after      =   trim($this->comma($x));
        $hasil  = ($x < 0) ? "minus " . $before . ($after == '' ? '' : $after . ' sen') : $before . ($after == '' ? '' : $after . ' sen');
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

    public function comma($number)
    {
        $after_comma = stristr($number,'.');
        $arr_number = ["nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan"];
        $results = "";
        $length = strlen($after_comma);
        $i = 1;
        while($i<$length)
        {
            $get = substr($after_comma,$i,1);
            $results .= " ".$arr_number[$get];
            $i++;
        }
        return $results;
    }

}
