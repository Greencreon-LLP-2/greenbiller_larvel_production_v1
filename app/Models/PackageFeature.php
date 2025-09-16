<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    protected $table = 'package_features';
    public $timestamps = false;

    protected $fillable = [
        'package_id',
        'feature_code',
        'enabled',
    ];

    // Relationships
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
