<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'customer_id',
        'transaction_code',
        'transaction_type',
        'payment_type_id',
        'related_reference_type',
        'related_reference_id',
        'account_id',
        'amount',
        'note',
        'created_by',
        'status',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function paymentType() {
        return $this->belongsTo(PaymentType::class);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
