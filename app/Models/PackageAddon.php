<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageAddon extends Model
{
    protected $table = 'package_addons';

    protected $fillable = [
        'store_id',
        'addon_code',
        'name',
        'description',
        'price',
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
}
