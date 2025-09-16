<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemPrice extends Model
{
    protected $table = 'item_prices';

    protected $fillable = [
        'item_id',
        'store_id',
        'warehouse_id',
        'customer_group_id',
        'price_type',
        'price',
        'valid_from',
        'valid_to',
        'currency_id',
        'active',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function customerGroup()
    {
        return $this->belongsTo(CustomerGroup::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
