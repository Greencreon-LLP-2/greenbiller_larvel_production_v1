<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSerial extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'purchase_id',
        'purchase_return_id',
        'sales_id',
        'sales_return_id',
        'serial_no',
        'status',
        'warranty_until',
    ];

    protected $casts = [
        'warranty_until' => 'date',
    ];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function purchase() {
        return $this->belongsTo(Purchase::class);
    }

    public function purchaseReturn() {
        return $this->belongsTo(PurchaseReturn::class);
    }

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function salesReturn() {
        return $this->belongsTo(SalesReturn::class);
    }
}
