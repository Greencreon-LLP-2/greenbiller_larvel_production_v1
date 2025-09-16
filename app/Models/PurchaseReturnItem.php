<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturnItem extends Model
{
    protected $table = 'purchase_return_items';

    protected $fillable = [
        'purchase_return_id',
        'purchase_item_id',
        'item_id',
        'return_qty',
        'price_per_unit',
        'tax_type',
        'tax_id',
        'discount_type',
        'discount_value',
        'batch_no',
        'expire_date',
        'description',
        'status',
    ];

    public function purchaseReturn()
    {
        return $this->belongsTo(PurchaseReturn::class);
    }

    public function purchaseItem()
    {
        return $this->belongsTo(PurchaseItem::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}
