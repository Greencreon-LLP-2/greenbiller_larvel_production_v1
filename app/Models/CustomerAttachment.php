<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAttachment extends Model
{
    protected $table = 'customer_attachments';

    public $timestamps = false;

    protected $fillable = [
        'customer_id',
        'file_path',
        'file_storage_provider',
        'file_type',
        'uploaded_by',
        'created_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
