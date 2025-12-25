<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'name',
        'city_id',
        'is_active',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
