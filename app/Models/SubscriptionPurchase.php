<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPurchase extends Model
{
    protected $table = 'subscription_purchase';

    protected $fillable = [
        'store_id',
        'package_id',
        'counter_id',
        'created_by',
        'subscription_code',
        'start_date',
        'end_date',
        'amount',
        'payment_type_id',
        'status',
    ];

    // Relationships
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function counter()
    {
        return $this->belongsTo(StoreCounter::class, 'counter_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class);
    }
}
