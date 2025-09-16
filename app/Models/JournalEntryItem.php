<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'journal_entry_id',
        'account_id',
        'debit',
        'credit',
        'description',
        'status',
    ];

    public function journalEntry() {
        return $this->belongsTo(JournalEntry::class);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }
}
