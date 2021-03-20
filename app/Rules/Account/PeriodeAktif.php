<?php

namespace App\Rules\Account;

use App\Models\Setting\Period;
use Illuminate\Contracts\Validation\Rule;

class PeriodeAktif implements Rule
{
    public function passes($attribute, $value)
    {
        $data   =   Period::select('status')
                    ->where('id', $value)
                    ->first() ;

        if (Period::where('status', 2)->count() > 0) {
            $aktif  =   Period::where('status', 2)->first() ;
            if ($aktif->id == $value) {
                return TRUE ;
            } else {
                return ($data->status == 3) ? TRUE : FALSE ;
            }
        } else {
            return TRUE ;
        }
    }

    public function message()
    {
        return 'Periode akuntansi masih ada yang aktif';
    }
}
