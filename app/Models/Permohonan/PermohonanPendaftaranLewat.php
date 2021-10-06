<?php

namespace App\Models\Permohonan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Bayaran\BayaranPendaftaranCalonSekolah;
use App\Models\Bayaran\BayaranPendaftaranCalon;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Peperiksaan\TahunPeperiksaan;
use App\Models\Calon\Calon;
use App\Models\Status\StatusPengesahan;

class PermohonanPendaftaranLewat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'permohonan__daftar_lewat';

    protected $fillable         =   [
        'id_calon',
        'jumlah_calon',
        'id_pusat',
        'id_tahun_peperiksaan',
        'id_status_pengesahan',
    ];

    public function tahunPeperiksaan()
    {
        return $this->hasOne(TahunPeperiksaan::class, 'id', 'id_tahun_peperiksaan');
    }

    public function statusPengesahan()
    {
        return $this->hasOne(StatusPengesahan::class, 'id', 'id_status_pengesahan');
    }

    public function pusat()
    {
        return $this->hasOne(Pusat::class, 'id', 'id_pusat');
    }

    public function calon()
    {
        return $this->hasOne(Calon::class, 'id', 'id_calon');
    }

    public function bayaranPusat()
    {
        return $this->hasOne(BayaranPendaftaranCalonSekolah::class, 'id_pusat', 'id_pusat');
    }
    public function bayaranCalon()
    {
        return $this->hasOne(BayaranPendaftaranCalon::class, 'id_calon', 'id_calon');
    }
}
