<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountrySetting extends Model
{
    protected $table = 'country_settings';

    protected $fillable = [
        'name',
        'mobile_code',
        'currency_code',
        'currency_symbol',
        'status',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'country_id');
    }
}
