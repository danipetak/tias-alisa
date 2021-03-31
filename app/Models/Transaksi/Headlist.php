<?php

namespace App\Models\Transaksi;

use App\Models\Setting\Account\Account;
use Illuminate\Database\Eloquent\Model;

class Headlist extends Model
{
    public function akun()
    {
        return $this->belongsTo(Account::class, 'account_id', 'id');
    }
}
