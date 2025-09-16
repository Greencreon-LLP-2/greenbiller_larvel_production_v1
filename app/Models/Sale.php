<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'sales_code',
        'reference_no',
        'sales_date',
        'due_date',
        'sales_status',
        'customer_id',
        'payment_status',
        'quotation_id',
        'coupon_id',
        'invoice_terms',
        'status',
        'created_by',
    ];

    protected $casts = [
        'sales_date' => 'date',
        'due_date' => 'date',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function quotation() {
        return $this->belongsTo(Quotation::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items() {
        return $this->hasMany(SalesItem::class);
    }

    public function payments() {
        return $this->hasMany(SalesPayment::class);
    }
}
