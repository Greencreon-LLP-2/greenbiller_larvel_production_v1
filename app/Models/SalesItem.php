<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'item_id',
        'warehouse_id',
        'description',
        'sales_qty',
        'price_per_unit',
        'tax_type',
        'tax_id',
        'discount_type',
        'discount_input',
    ];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }

    public function charges() {
        return $this->hasMany(SalesItemCharge::class);
    }
}
