<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreCounter extends Model
{
    use HasFactory;

    protected $table = 'store_counters';

    protected $fillable = [
        'store_id',
        'name',
        'counter_code',
        'assigned_user_id',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function documentSettings()
    {
        return $this->hasMany(CounterDocumentSetting::class, 'counter_id');
    }

    public function featureFlags()
    {
        return $this->hasMany(CounterFeatureFlag::class, 'counter_id');
    }
}
