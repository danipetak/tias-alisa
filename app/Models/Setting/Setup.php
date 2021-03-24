<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    public static function zerofill($value, $width = 2)
    {
        return str_pad((string)$value, $width, "0", STR_PAD_LEFT);
    }
}
