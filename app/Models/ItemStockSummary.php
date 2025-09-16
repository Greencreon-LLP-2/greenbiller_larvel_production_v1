<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemStockSummary extends Model
{
    protected $table = 'item_stock_summary';

    public $timestamps = false; // since it uses `last_updated`

    protected $fillable = [
        'store_id',
        'item_id',
        'total_available',
        'total_reserved',
        'last_updated',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
