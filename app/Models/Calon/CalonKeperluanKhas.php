<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CalonKeperluanKhas extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'calon__keperluan_khas';

    protected $fillable         =   [
        'id_calon',
        'id_jenis_keperluan_khas',
        'bantuan_oku',
        'no_kad_oku'
    ];
}
