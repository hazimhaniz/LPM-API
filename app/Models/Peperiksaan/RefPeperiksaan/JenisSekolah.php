<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Peperiksaan\Peperiksaan;

class JenisSekolah extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_peperiksaan__kod_jenis_sekolah';

    protected $fillable         =   [
        'kod_jenis_sekoalah',
        'id_peperiksaan',
        'keterangan',
        'status'
    ];

    public function peperiksaan()
    {
        return $this->hasOne(Peperiksaan::class, 'id', 'id_peperiksaan');
    }
}
