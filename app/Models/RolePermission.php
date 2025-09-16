<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'role_id',
        'module_id',
        'can_view',
        'can_create',
        'can_update',
        'can_delete',
    ];

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function module()
    {
        return $this->belongsTo(SystemModule::class, 'module_id');
    }
}
