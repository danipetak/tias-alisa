<?php

namespace App\Rules\Account;

use App\Models\Setting\Account\Account;
use Illuminate\Contracts\Validation\Rule;

class KondisiRekening implements Rule
{
    public function passes($attribute, $value)
    {
        return Account::turunan_akun($value) ? TRUE : FALSE ;
    }

    public function message()
    {
        return 'Rekening sudah digunakan untuk transaksi';
    }
}
