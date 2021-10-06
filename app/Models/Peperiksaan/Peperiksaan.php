<?php

namespace App\Models\Peperiksaan;

use App\Models\Peperiksaan\App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Peperiksaan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    const KOD_PEPERIKSAAN_PT3   =   '01';
    const KOD_PEPERIKSAAN_STAM  =   '04';

    const ID_PEPERIKSAAN_PT3    =   1;
    const ID_PEPERIKSAAN_STAM   =   2;

    protected $primaryKey       =   'id';
    protected $table            =   'peperiksaan';

    protected $fillable         =   [
        'kod_peperiksaan',
        'keterangan',
        'keterangan_panjang',
        'id_tahun_peperiksaan_semasa',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function tahunPeperiksaan()
    {
        return $this->hasMany(tahunPeperiksaan::class, 'kod_peperiksaan', 'kod_peperiksaan');
    }

}
