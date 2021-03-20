<?php

namespace App\Rules\Account;

use App\Models\Setting\Period;
use Illuminate\Contracts\Validation\Rule;

class HapusPeriode implements Rule
{
    public function passes($attribute, $value)
    {
        return (Period::where('status', 1)->where('id', $value)->count() > 0) ? TRUE : FALSE ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Hapus periode akuntansi gagal';
    }
}
