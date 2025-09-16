<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name',
        'symbol',
        'description',
        'status',
    ];

    public function baseConversions()
    {
        return $this->hasMany(UnitConversion::class, 'base_unit_id');
    }

    public function subConversions()
    {
        return $this->hasMany(UnitConversion::class, 'sub_unit_id');
    }
}
