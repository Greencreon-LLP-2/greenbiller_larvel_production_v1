namespace App\Models;

<?php

use App\Models\Store;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;

class SupplierBalance extends Model
{
    protected $table = 'supplier_balances';

    protected $fillable = [
        'supplier_id',
        'store_id',
        'purchase_due',
        'purchase_return_due',
    ];

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
