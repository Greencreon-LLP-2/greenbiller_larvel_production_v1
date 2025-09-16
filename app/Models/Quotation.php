<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'customer_id',
        'quote_number',
        'quote_date',
        'due_date',
        'quotation_status',
        'payment_status',
        'created_by',
        'invoice_terms',
        'status',
    ];

    protected $casts = [
        'quote_date' => 'date',
        'due_date' => 'date',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items() {
        return $this->hasMany(QuotationItem::class);
    }
}
