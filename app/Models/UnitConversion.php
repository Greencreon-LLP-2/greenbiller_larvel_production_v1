<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitConversion extends Model
{
    protected $fillable = [
        'base_unit_id',
        'sub_unit_id',
        'factor',
        'note',
    ];

    public function baseUnit()
    {
        return $this->belongsTo(Unit::class, 'base_unit_id');
    }

    public function subUnit()
    {
        return $this->belongsTo(Unit::class, 'sub_unit_id');
    }
}
