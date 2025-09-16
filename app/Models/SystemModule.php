<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemModule extends Model
{
    protected $table = 'system_modules';

    protected $fillable = [
        'module_name',
        'module_group',
        'module_code',
        'is_pro_feature',
    ];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'module_id');
    }
}
