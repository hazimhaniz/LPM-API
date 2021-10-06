<?php

namespace App\Models;

use App\Models\Kru\Kru;
use App\Models\Calon\Calon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use  HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

    const ROLE_DEVELOPER    = 1;
    const ROLE_CALON        = 2;


    protected $fillable     =   [
        'id_pengguna',
        'id_peperiksaan',
        'id_jenis_pengguna',
        'email',
        'email_verified_at',
        'password',
        'status'
    ];

    protected $hidden       =   [
        'password',
        'created_at',
        'updated_at',
        'email_verified_at',
        'remember_token',
    ];

    protected $casts        =   [
        'email_verified_at' => 'datetime',
    ];

    public function kru()
    {
        return $this->hasOne(Kru::class, 'id_user', 'id');
    }

    public function calon()
    {
        return $this->hasOne(Calon::class, 'id_user', 'id');
    }

}
