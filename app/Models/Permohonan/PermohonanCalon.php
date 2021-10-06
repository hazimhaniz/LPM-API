<?php

namespace App\Models\Permohonan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Calon\CalonBayaranPendaftaran;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\TahunPeperiksaan;
use App\Models\Calon\Calon;
use App\Models\Status\StatusPengesahan;

class PermohonanCalon extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'permohonan__calon';

    protected $fillable         =   [
        'id_calon',
        'id_peperiksaan',
        'id_kemasukan',
        'id_sekolah',
        'id_pusat',
        'id_negeri',
        'id_tahun_peperiksaan',
        'id_status_pengesahan',
        'tahun_peperiksaan_spm',
        'angka_giliran_spm',
        'no_kelas'
    ];

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'id', 'id_sekolah');
    }

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

    public function bayaran()
    {
        return $this->hasOne(CalonBayaranPendaftaran::class, 'id_calon', 'id_calon');
    }
}
