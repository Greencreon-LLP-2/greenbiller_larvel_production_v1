<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $table = 'expense_categories';

    protected $fillable = [
        'store_id',
        'name',
        'description',
        'status',
    ];

    // Relationships
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expense_category_id');
    }
}
