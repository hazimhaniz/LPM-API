<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Peperiksaan\Peperiksaan;

class JenisBayaran extends Model implements Auditable
{
    const PINDAH_PUSAT_PEPERIKSAAN      = 1;
    const YURAN_PEPERIKSAAN_ASAS        = 2;
    const YURAN_PEPERIKSAAN_MP          = 3;
    const YURAN_PEPERIKSAAN_BP          = 4;
    const PEMBETULAN_MAKLUMAT_CALON     = 5;
    const PEMBETULAN_MAKLUMAT_MP        = 6;
    const SEMAKAN_SEMULA_MP             = 7;
    const SALINAN_KEPUTUSAN             = 8;
    const SALINAN_TERJEMAHAN            = 9;
    const CALON_LEWAT                   = 10;
    const PENGESAHAN_KEPUTUSAN          = 11;
    const YURAN_PEPERIKSAAN_ASAS_PT3    = 12;
    const CALON_LEWAT_PT3               = 13;
    const PEMBETULAN_MAKLUMAT_CALON_PT3 = 14;
    const PEMBETULAN_MAKLUMAT_MP_PT3    = 15;

    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_peperiksaan__kod_jenis_bayaran';

    protected $fillable         =   [
        'id_peperiksaan',
        'kod_jenis_bayaran',
        'keterangan',
        'jumlah',
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
