<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'created_by',
        'transfer_code',
        'transfer_date',
        'from_account_id',
        'to_account_id',
        'payment_type_id',
        'amount',
        'note',
        'status',
    ];

    protected $casts = [
        'transfer_date' => 'date',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function fromAccount() {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function toAccount() {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    public function paymentType() {
        return $this->belongsTo(PaymentType::class);
    }
}
