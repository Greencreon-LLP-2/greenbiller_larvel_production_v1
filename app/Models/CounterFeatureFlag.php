<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterFeatureFlag extends Model
{
    use HasFactory;

    protected $table = 'counter_feature_flags';

    protected $fillable = [
        'counter_id',
        'feature_name',
        'enabled',
    ];

    public function counter()
    {
        return $this->belongsTo(StoreCounter::class, 'counter_id');
    }
}
