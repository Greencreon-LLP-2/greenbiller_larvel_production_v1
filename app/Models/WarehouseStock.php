<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseStock extends Model
{
    protected $table = 'warehouse_stock';

    protected $fillable = [
        'warehouse_id',
        'item_id',
        'batch_no',
        'expiry_date',
        'available_qty',
        'reserved_qty',
    ];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function adjustmentItems()
    {
        return $this->hasMany(StockAdjustmentItem::class);
    }
}
