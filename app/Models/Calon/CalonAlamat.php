<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalonAlamat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory, SoftDeletes;

    protected $primaryKey       =   'id';
    protected $table            =   'calon__alamat';

    protected $fillable         =   [
        'id_calon',
        'id_jenis_alamat',
        'jenis_alamat',
        'alamat',
        'poskod',
        'id_bandar',
        'id_negeri',
    ];
}
