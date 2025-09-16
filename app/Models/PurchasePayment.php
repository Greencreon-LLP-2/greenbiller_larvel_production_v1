<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchasePayment extends Model
{
    protected $table = 'purchase_payments';

    protected $fillable = [
        'store_id',
        'purchase_id',
        'created_by',
        'payment_code',
        'payment_date',
        'payment_type_id',
        'reference_no',
        'amount',
        'note',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
