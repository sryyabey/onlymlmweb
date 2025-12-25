<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name',
        'phone_code',
        'flag',
        'code',
        'is_active',
    ];
}
