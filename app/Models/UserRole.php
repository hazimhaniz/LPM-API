<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role;

class UserRole extends Role implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'users__roles';

    protected $hidden           =   [
        'guard_name',
        'created_at',
        'updated_at',
        'status'
    ];

    protected $guarded         =   ['id', 'created_at', 'updated_at'];

    public function userPermissions(): BelongsToMany
    {
        return $this->morphToMany(
            UserPermission::class,
            'model',
            config('permission.table_names.model_has_permissions'),
            config('permission.column_names.model_morph_key'),
            'permission_id'
        );
    }
}
