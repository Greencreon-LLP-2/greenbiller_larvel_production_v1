<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressLink extends Model
{
    use HasFactory;

    protected $table = 'address_links';

    protected $fillable = [
        'address_id',
        'entity_type',
        'entity_id',
    ];

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    // Polymorphic-like manual handling
    public function entity()
    {
        return match ($this->entity_type) {
            'store' => $this->belongsTo(Store::class, 'entity_id'),
            'customer' => $this->belongsTo(Customer::class, 'entity_id'),
            'supplier' => $this->belongsTo(Supplier::class, 'entity_id'),
            'user' => $this->belongsTo(User::class, 'entity_id'),
            default => null,
        };
    }
}
