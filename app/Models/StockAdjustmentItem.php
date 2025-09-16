<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockAdjustmentItem extends Model
{
    protected $table = 'stock_adjustment_items';

    protected $fillable = [
        'adjustment_id',
        'warehouse_stock_id',
        'item_id',
        'batch_no',
        'qty_change',
        'qty_before',
        'qty_after',
        'note',
    ];

    public function adjustment()
    {
        return $this->belongsTo(StockAdjustment::class, 'adjustment_id');
    }

    public function warehouseStock()
    {
        return $this->belongsTo(WarehouseStock::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
