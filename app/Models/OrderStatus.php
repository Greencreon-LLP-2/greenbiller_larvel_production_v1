<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'status_name',
        'status_color',
        'is_default',
        'status',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }
}
