<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'store_id',
        'created_by',
        'country_id',
        'group_id',
        'customer_code',
        'customer_name',
        'mobile',
        'phone',
        'email',
        'gst_enabled',
        'gstin',
        'vat_enabled',
        'vatin',
        'tax_number',
        'credit_limit',
        'credit_date_limit',
        'price_level_type',
        'price_level_value',
        'delete_bit',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function country()
    {
        return $this->belongsTo(CountrySetting::class, 'country_id');
    }

    public function group()
    {
        return $this->belongsTo(CustomerGroup::class, 'group_id');
    }

    public function attachments()
    {
        return $this->hasMany(CustomerAttachment::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
