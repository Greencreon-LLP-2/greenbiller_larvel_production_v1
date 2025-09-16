<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterDocumentSetting extends Model
{
    use HasFactory;

    protected $table = 'counter_document_settings';

    protected $fillable = [
        'counter_id',
        'doc_type',
        'printer_type',
        'page_size',
        'show_mrp',
        'show_paid_amount',
        'show_return',
        'number_to_word',
        'show_previous_balance',
        'invoice_notes',
        'copy_customer_enabled',
        'business_logo',
        'template',
        'signature_image',
        'footer_terms_conditions',
    ];

    public function counter()
    {
        return $this->belongsTo(StoreCounter::class, 'counter_id');
    }
}
