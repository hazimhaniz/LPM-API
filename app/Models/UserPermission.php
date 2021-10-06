<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Permission;

class UserPermission extends Permission implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'users__permissions';

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'status',
        'type',
        'pivot',
        'permission_id',
        'guard_name',
    ];

    protected $fillable         =   [
        'name',
        'permission_id',
        'type',
        'description',
        'guard_name',
        'status',
    ];

    public function subPermissions(){
        return $this->hasMany(UserPermission::class, 'permission_id', 'id');
    }
}
