<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItemCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_id',
        'charge_type',
        'input_value',
        'tax_id',
        'calculated_amount',
        'discount_type',
    ];

    public function sale() {
        return $this->belongsTo(Sale::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }
}
