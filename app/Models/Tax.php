<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'tax_type',
        'parent_id',
        'name',
        'rate',
        'group_type',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Tax::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Tax::class, 'parent_id');
    }
}
