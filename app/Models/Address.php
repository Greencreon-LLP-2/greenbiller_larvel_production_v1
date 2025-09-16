<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'address_type',
        'country_id',
        'state',
        'city',
        'postcode',
        'address_line',
        'location_link',
        'is_default',
    ];

    public function country()
    {
        return $this->belongsTo(CountrySetting::class, 'country_id');
    }

    public function links()
    {
        return $this->hasMany(AddressLink::class, 'address_id');
    }
}
