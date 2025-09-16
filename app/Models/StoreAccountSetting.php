<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreAccountSetting extends Model
{
    protected $table = 'store_account_settings';

    protected $fillable = [
        'store_id',
        'account_name',
        'bank_name',
        'account_number',
        'ifsc_code',
        'upi_id',
        'balance',
        'user_id',
    ];

    // Relationships
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
