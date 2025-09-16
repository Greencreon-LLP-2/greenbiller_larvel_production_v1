<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItemReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'sales_id',
        'sales_item_id',
        'customer_id',
        'item_id',
        'warehouse_id',
        'created_by',
        'return_code',
        'return_date',
        'note',
        'status',
    ];

    protected $casts = [
        'return_date' => 'date',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function salesItem() {
        return $this->belongsTo(SalesItem::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function charges() {
        return $this->hasMany(SalesItemReturnCharge::class);
    }
}
