<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Peperiksaan\Peperiksaan;

class JenisCalon extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_peperiksaan__kod_jenis_calon';

    protected $fillable         =   [
        'id_peperiksaan',
        'kod_jenis_calon',
        'keterangan',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function peperiksaan()
    {
        return $this->hasOne(Peperiksaan::class, 'id', 'id_peperiksaan');
    }
}
