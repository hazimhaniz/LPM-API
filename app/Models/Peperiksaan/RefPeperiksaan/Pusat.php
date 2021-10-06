<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use App\Models\Bayaran\BayaranPendaftaranCalonSekolah;
use App\Models\Calon\Calon;
use App\Models\Peperiksaan\Peperiksaan;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\TahunPeperiksaan;
use App\Models\Status\StatusPendaftaran;
use App\Models\Status\statusTempohPendaftaran;
use App\Models\Peperiksaan\RefPeperiksaan\JenisCalon;
use App\Models\Permohonan\PermohonanPendaftaranLewat;

class Pusat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_peperiksaan__kod_pusat';

    protected $fillable         =   [
        'kod_pusat',
        'nama_pusat',
        'nama_pusat_i18n',
        'id_sekolah',
        'no_sekolah',
        'jumlah_calon',
        'id_bilik_kebal',
        'id_jenis_calon',
        'ids_mata_pelajaran',
        'id_tahun_peperiksaan',
        'id_status_pendaftaran',
        'id_status_pendaftaran_calon',
        'id_status_tempoh_pendaftaran',
        'id_status_janaan_angka_giliran',
        'status',
    ];

    protected $hidden           =   [
        // 'created_at',
        // 'updated_at',
    ];

    protected $casts = [
        'ids_mata_pelajaran'    => 'array'
    ];


    protected $appends = [
        'jumlah_calon_daftar',
        'mata_pelajaran'
    ];


    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'id', 'id_sekolah');
    }

    public function tahunPeperiksaan()
    {
        return $this->hasOne(TahunPeperiksaan::class, 'id', 'id_tahun_peperiksaan');
    }

    public function statusPendaftaran()
    {
        return $this->hasOne(statusPendaftaran::class, 'id', 'id_status_pendaftaran');
    }

    public function statusPendaftaranCalon()
    {
        return $this->hasOne(statusPendaftaran::class, 'id', 'id_status_pendaftaran_calon');
    }

    public function statusTempohPendaftaran()
    {
        return $this->hasOne(statusTempohPendaftaran::class, 'id', 'id_status_pendaftaran_calon');
    }

    public function calon()
    {
        return $this->hasMany(Calon::class, 'id_pusat', 'id');
    }

    public function jenisCalon()
    {
        return $this->hasOne(JenisCalon::class, 'id', 'id_jenis_calon');
    }

    public function daftarLewat()
    {
        return $this->hasOne(PermohonanPendaftaranLewat::class, 'id_pusat', 'id');
    }

    public function bayaran()
    {
        return $this->hasMany(BayaranPendaftaranCalonSekolah::class, 'id_pusat', 'id');
    }

    public function getJumlahCalonDaftarAttribute()
    {
        return $this->calon->count();
    }

    public function getMataPelajaranAttribute()
    {

        if ($this->ids_mata_pelajaran)
        {
            return MataPelajaran::find($this->ids_mata_pelajaran);
        }

        return null;
    }
}
