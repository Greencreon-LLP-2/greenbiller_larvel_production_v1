<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $table = 'stores';

    protected $fillable = [
        'created_by',
        'store_code',
        'slug',
        'name',
        'website',
        'email',
        'mobile',
        'phone',
        'logo',
        'country_id',
        'state',
        'city',
        'address',
        'postcode',
        'gst_enabled',
        'gst_no',
        'vat_enabled',
        'vat_no',
        'pan_no',
        'default_sales_discount',
        'language_id',
        'currency_id',
        'currency_placement',
        'timezone_id',
        'date_format',
        'time_format',
        'status',   
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function country()
    {
        return $this->belongsTo(CountrySetting::class, 'country_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class, 'timezone_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_stores', 'store_id', 'user_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'store_id');
    }

    public function counters()
    {
        return $this->hasMany(StoreCounter::class, 'store_id');
    }
}
