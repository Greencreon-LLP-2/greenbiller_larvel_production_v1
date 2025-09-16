<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingCycle extends Model
{
    protected $table = 'billing_cycles';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
    ];

    // Relationships
    public function packages()
    {
        return $this->hasMany(Package::class, 'billing_cycle_id');
    }

    public function addons()
    {
        return $this->hasMany(PackageAddon::class, 'billing_cycle_id');
    }
}
