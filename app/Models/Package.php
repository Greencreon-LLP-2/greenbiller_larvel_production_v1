<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    protected $fillable = [
        'store_id',
        'package_code',
        'package_name',
        'description',
        'price',
        'if_multistore',
        'store_limit',
        'user_limit',
        'is_recurring',
        'billing_cycle_id',
        'status',
    ];

    // Relationships
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function billingCycle()
    {
        return $this->belongsTo(BillingCycle::class);
    }

    public function features()
    {
        return $this->hasMany(PackageFeature::class, 'package_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(SubscriptionPurchase::class, 'package_id');
    }
}
