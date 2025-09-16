<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'created_by',
        'journal_code',
        'entry_date',
        'reference_type',
        'reference_id',
        'description',
        'status',
    ];

    protected $casts = [
        'entry_date' => 'date',
    ];

    public function store() {
        return $this->belongsTo(Store::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items() {
        return $this->hasMany(JournalEntryItem::class);
    }
}
