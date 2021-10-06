<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CalonPermohonanMpStam extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'calon__permohonan_mp_stam';

    protected $fillable         =   [
        'id_calon',
        'ids_mata_pelajaran',
        'id_status_pengesahan',
    ];

    protected $casts = [
        'ids_mata_pelajaran'    => 'array'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function mataPelajaran()
    {
        return $this->hasOne(MataPelajaran::class, 'id', 'id_mata_pelajaran');
    }
}
