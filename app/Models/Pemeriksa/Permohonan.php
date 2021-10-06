<?php

namespace App\Models\Pemeriksa;
use App\Models\Kru\Kru;
use App\Models\Status\StatusPengesahan;
use App\Models\Pemeriksa\AlamatJawapan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Status\StatusKelulusan;
use App\Models\Status\StatusJanaan;
use App\Models\Pemeriksa\EmailContent;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Permohonan extends Model
{
    // use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__pemeriksa';

    protected $fillable         =   [
        'id_kru',
        'id_user',
        'tahun',
        'status_permohonan_pertama',
        'status_pelawaan',
        'sebab_penolakan',
        'status_pemeriksa_lain',
        'id_matapelajaran_lain',
        'tahun_memeriksa',
        'status_kelulusan',
        'status_kelulusan_janaan',
        'status_janaan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function kru()
    {
        return $this->hasOne(Kru::class, 'id_user', 'id_user');
    }
    public function AlamatJawapan()
    {
        return $this->hasOne(AlamatJawapan::class,'id_pemeriksa','id');
    }
    public function AlamatRumah()
    {
        return $this->hasOne(AlamatRumah::class,'id_pemeriksa','id');
    }
    public function AlamatSekolah()
    {
        return $this->hasOne(AlamatSekolah::class,'id_pemeriksa','id');
    }
    public function Perkhidmatan()
    {
        return $this->hasMany(Perkhidmatan::class,'id_pemeriksa','id');
    }
    public function PermohonanKelulusaan()
    {
        return $this->hasOne(PermohonanKelulusaan::class,'id_pemeriksa','id');
    }
    public function PermohonanPengalamanMPStam()
    {
        return $this->hasMany(PermohonanPengalamanMPStam::class,'id_pemeriksa','id');
    }
    public function PengalamanPetugas()
    {
        return $this->hasMany(PengalamanPetugas::class,'id_pemeriksa','id');
    }
    public function StatusPengesahan()
    {
        return $this->hasOne(StatusPengesahan::class, 'id', 'status_permohonan_pertama');
    }
    public function StatusKelulusan()
    {
        return $this->hasOne(StatusKelulusan::class, 'id', 'status_kelulusan');
    }
    public function StatusJanaan()
    {
        return $this->hasOne(StatusJanaan::class, 'id', 'status_janaan');
    }
    public function EmailContent()
    {
        return $this->hasMany(EmailContent::class, 'id_pemeriksa', 'id');
    }

}
