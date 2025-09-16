<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationItemCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_item_id',
        'charge_type',
        'input_value',
        'tax_id',
        'calculated_amount',
        'discount_type',
    ];

    public function quotationItem() {
        return $this->belongsTo(QuotationItem::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }
}
