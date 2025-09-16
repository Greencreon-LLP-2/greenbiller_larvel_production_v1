<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = [
        'store_id',
        'type',
        'name',
        'address',
        'mobile',
        'email',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
