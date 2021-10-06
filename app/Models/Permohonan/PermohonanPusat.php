<?php

namespace App\Models\Permohonan;

use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\TahunPeperiksaan;
use App\Models\Calon\Calon;
use App\Models\Status\StatusPengesahan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermohonanPusat extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey       =   'id';
    protected $table            =   'permohonan__pusat';

    protected $fillable         =   [
        'id_sekolah',
        'id_tahun_peperiksaan',
        'id_peperiksaan',
        'id_status_pengesahan',
        'id_pusat',
        'alasan',
        'bekalan_elektrik',
        'bekalan_air',
        'id_negeri',
        'telefon',
        'tandas',
        'bangku_calon',
        'meja_calon',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'deleted_at',
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
        return $this->hasMany(Calon::class, 'id_pusat', 'id_pusat');
    }
}
