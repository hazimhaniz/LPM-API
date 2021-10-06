<?php

namespace App\Models\Calon;

use App\Models\Constant\Keturunan;
use App\Models\Constant\Warganegara;
use App\Models\Dokumen\DokumenCalon;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Permohonan\PermohonanCalon;
use App\Models\Peperiksaan\TahunPeperiksaan;
use App\Models\Bayaran\BayaranPendaftaranCalon;
use App\Models\Calon\RefCalon\JenisKeperluanKhas;
use App\Models\Calon\CalonKeperluanKhas;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Calon\RefCalon\JenisPendaftaran;
use App\Models\Calon\CalonPembatalanPendaftaran;
use App\Models\Constant\Negara;
use App\Models\Peperiksaan\RefPeperiksaan\JenisBayaran;
use App\Models\Permohonan\PermohonanPendaftaranLewat;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Facades\DB;

class Calon extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory, SoftDeletes;

    protected $primaryKey       =   'id';
    protected $table            =   'calon';

    protected $guarded         =   [ 'id', 'created_at', 'updated_at'];

    protected $appends = [
        'mata_pelajaran'
    ];

    public function pusat()
    {
        return $this->hasOne(Pusat::class, 'id', 'id_pusat');
    }

    public function cbk()
    {
        return $this->hasOne(CalonKeperluanKhas::class, 'id_calon', 'id');
    }

    public function alamat()
    {
        return $this->hasOne(CalonAlamat::class, 'id_calon', 'id');
    }

    public function permohonan()
    {
        return $this->hasOne(PermohonanCalon::class, 'id_calon', 'id');
    }

    public function permohonanDaftarLewat()
    {
        return $this->hasOne(PermohonanPendaftaranLewat::class, 'id_calon', 'id');
    }

    public function mataPelajaranStam()
    {
        return $this->hasOne(CalonPermohonanMpStam::class, 'id_calon', 'id');
    }

    public function mataPelajaranPt3()
    {
        return $this->hasOne(CalonPermohonanMpPt3::class, 'id_calon', 'id');
    }

    public function warganegara()
    {
        return $this->hasOne(Warganegara::class, 'id', 'id_warganegara');
    }

    public function keturunan()
    {
        return $this->hasOne(Keturunan::class, 'id', 'id_keturunan');
    }

    public function JenisPendaftaran()
    {
        return $this->hasOne(JenisPendaftaran::class, 'id', 'id_jenis_pendaftaran');
    }

    public function JenisKeperluanKhas()
    {
        return $this->hasOne(JenisKeperluanKhas::class, 'id','id_keperluan_khas');
    }

    public function tahunPeperiksaan()
    {
        return $this->hasMany(tahunPeperiksaan::class, 'id_peperiksaan', 'id_peperiksaan');
    }

    public function permohonanPembatalan(){
        return $this->belongsto(CalonPembatalanPendaftaran::class, 'id', 'id_calon');
    }

    public function getMataPelajaranAttribute()
    {

        if ($this->id_peperiksaan == Peperiksaan::ID_PEPERIKSAAN_PT3)
        {
            if ($this->mataPelajaranPt3)
            {
                return MataPelajaran::find($this->mataPelajaranPt3->ids_mata_pelajaran);
            }

        }
        elseif ($this->id_peperiksaan == Peperiksaan::ID_PEPERIKSAAN_STAM)
        {
            if ($this->mataPelajaranStam)
            {
                return MataPelajaran::find($this->mataPelajaranStam->ids_mata_pelajaran);
            }
        }

        return null;
    }

    public function bayaran()
    {
        return $this->hasmany(BayaranPendaftaranCalon::class, 'id_calon', 'id');
    }

    public function bayaranLewat()
    {
        return $this->hasOne(BayaranPendaftaranCalon::class, 'id_calon', 'id')->where('id_penjenisan_bayaran', JenisBayaran::CALON_LEWAT);
    }

    public function dokumen()
    {
        return $this->hasMany(DokumenCalon::class, 'id_calon', 'id');
    }

    public function pembetulanCalon(){
        return $this->hasOne(CalonPembetulanMaklumat::class, 'id_calon', 'id');
    }

    public function negara(){
        return $this->hasOne(Negara::class, 'id_negara', 'id');
    }

    public function delete()
    {
        DB::transaction(function()
        {
            $this->alamat()->delete();
            $this->permohonan()->delete();
            $this->mataPelajaranStam()->delete();
            $this->mataPelajaranPt3()->delete();
            parent::delete();

        });
    }
}
