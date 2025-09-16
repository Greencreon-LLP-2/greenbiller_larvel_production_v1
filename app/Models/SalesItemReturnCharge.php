<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItemReturnCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_item_return_id',
        'charge_type',
        'input_value',
        'tax_id',
        'discount_type',
    ];

    public function salesItemReturn() {
        return $this->belongsTo(SalesItemReturn::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }
}
