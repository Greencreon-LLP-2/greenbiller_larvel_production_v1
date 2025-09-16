<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table = 'customer_groups';

    protected $fillable = [
        'store_id',
        'group_name',
        'description',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class, 'group_id');
    }
}
