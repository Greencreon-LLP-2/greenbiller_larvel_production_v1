<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_order_id',
        'order_status_id',
        'store_id',
        'customer_id',
        'user_id',
        'sales_id',
        'shipping_address_id',
        'order_address',
        'reward_point',
        'sub_total',
        'tax_rate',
        'tax_amt',
        'delivery_charge',
        'discount',
        'coupon_id',
        'coupon_amount',
        'handling_charge',
        'order_totalamt',
        'payment_mode',
        'map_distance',
        'delivery_pin',
        'deliveryboy_id',
        'delivery_timeslot_id',
        'notifications_admin',
        'notifications_store',
        'notifications_deliveryboy',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sales() {
        return $this->belongsTo(Sale::class);
    }

    public function shippingAddress() {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function orderStatus() {
        return $this->belongsTo(OrderStatus::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
