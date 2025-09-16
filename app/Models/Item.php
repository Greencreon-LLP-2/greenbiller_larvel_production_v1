<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'store_id',
        'code',
        'name',
        'image',
        'category_id',
        'brand_id',
        'sku',
        'hsn_code',
        'barcode',
        'base_unit_id',
        'default_subunit_id',
        'description',
        'purchase_price',
        'mrp',
        'default_tax_id',
        'if_expiry',
        'if_batch',
        'status',
        'created_by',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function baseUnit()
    {
        return $this->belongsTo(Unit::class, 'base_unit_id');
    }

    public function subUnit()
    {
        return $this->belongsTo(Unit::class, 'default_subunit_id');
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'default_tax_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
