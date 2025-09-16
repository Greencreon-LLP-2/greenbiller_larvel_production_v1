<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'created_by',
        'payment_code',
        'payment_date',
        'payment_type_id',
        'reference_type',
        'reference_id',
        'amount',
        'transaction_id',
        'note',
        'status',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function paymentType() {
        return $this->belongsTo(PaymentType::class);
    }
}
