<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'warehouse_id',
        'selling_price',
        'qty',
        'tax_rate',
        'tax_type',
        'tax_amt',
        'discount_type',
        'discount_value',
        'total_price',
        'if_offer',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}
