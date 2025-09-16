<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_id',
        'item_id',
        'quantity',
        'price_per_unit',
        'tax_id',
        'discount_type',
        'discount_value',
        'unit',
        'batch_no',
        'serial_numbers',
        'status',
    ];

    public function quotation() {
        return $this->belongsTo(Quotation::class);
    }

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }

    public function charges() {
        return $this->hasMany(QuotationItemCharge::class);
    }
}
