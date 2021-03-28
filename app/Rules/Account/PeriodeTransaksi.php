<?php

namespace App\Rules\Account;

use App\Models\Setting\Period;
use Illuminate\Contracts\Validation\Rule;

class PeriodeTransaksi implements Rule
{
    private $periode ;

    public function __construct($periode)
    {
        $this->periode  =   $periode ;
    }

    public function passes($attribute, $value)
    {
        $data   =   Period::where('id', $this->periode)
                    ->whereDate('start', '<=', $value)
                    ->whereDate('end', '>=', $value)
                    ->count();

        return  ($data > 0) ? TRUE : FALSE ;
    }

    public function message()
    {
        return 'Tanggal transaksi diluar periode dipilih';
    }
}
