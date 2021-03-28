<?php

namespace App\Rules\Account;

use App\Models\Transaksi\Header;
use Illuminate\Contracts\Validation\Rule;

class RiwayatTransaksi implements Rule
{
    private $periode;

    public function __construct($periode)
    {
        $this->periode  =   $periode;
    }

    public function passes($attribute, $value)
    {
        $data   =   Header::where('period_id', $this->periode)
                    ->where('id', $value)
                    ->count();

        return $data > 0 ? TRUE : FALSE ;
    }

    public function message()
    {
        return 'Transaksi tidak tersedia di periode dipilih';
    }
}
