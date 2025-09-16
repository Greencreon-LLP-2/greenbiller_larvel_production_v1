<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesReturnCharge extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_return_id',
        'charge_type',
        'input_value',
        'tax_id',
        'discount_type',
    ];

    public function salesReturn() {
        return $this->belongsTo(SalesReturn::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }
}
