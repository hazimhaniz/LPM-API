<?php

namespace App\Models\Permohonan;

use App\Models\Calon\Calon;
use App\Models\Dokumen\DokumenCalon;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\TahunPeperiksaan;
use App\Models\Status\StatusPengesahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PermohonanCalonPindahPusat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    const BATAL                         = -1;
    const PINDAH_KELUAR                 = 0;
    const PINDAH_MASUK                  = 1;
    const PINDAH_COMPLETE               = 2;

    const PINDAH_PUSAT                  = 1;
    const PINDAH_MENUMPANG              = 2;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'permohonan__calon_pindah_pusat';

    protected $fillable         =   [
        'id_peperiksaan',
        'id_tahun_peperiksaan',
        'id_calon',
        'id_pusat',
        'id_pusat_baharu',
        'id_status_pindah',
        'id_status_pengesahan',
        'id_jenis_pindah'
    ];

    public function tahunPeperiksaan()
    {
        return $this->hasOne(TahunPeperiksaan::class, 'id', 'id_tahun_peperiksaan');
    }

    public function statusPengesahan()
    {
        return $this->hasOne(StatusPengesahan::class, 'id', 'id_status_pengesahan');
    }

    public function calon()
    {
        return $this->hasOne(Calon::class, 'id', 'id_calon');
    }

    public function pusat()
    {
        return $this->hasOne(Pusat::class, 'id', 'id_pusat');
    }

    public function pusatBaharu()
    {
        return $this->hasOne(Pusat::class, 'id', 'id_pusat_baharu');
    }
}
