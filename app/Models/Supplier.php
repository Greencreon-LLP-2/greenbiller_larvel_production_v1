<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SupplierBalance;

class Supplier extends Model
{
    protected $table = 'suppliers';

    protected $fillable = [
        'store_id',
        'created_by',
        'country_id',
        'state',
        'city',
        'supplier_code',
        'supplier_name',
        'mobile',
        'phone',
        'email',
        'gstin',
        'vatin',
        'postcode',
        'address',
        'status',
    ];

    // Relationships
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

    public function balances()
    {
        return $this->hasOne(SupplierBalance::class, 'id');
    }
}
