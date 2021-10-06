<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use App\Models\Constant\Bandar;
use App\Models\Constant\Daerah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Constant\Negeri;
use App\Models\Peperiksaan\RefPeperiksaan\JenisSekolah;
use App\Models\Kru\Kru;

class Sekolah extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_peperiksaan__kod_sekolah';
    protected $guarded          =   ['id', 'created_at', 'updated_at'];
    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function jenisSekolah()
    {
        return $this->hasOne(JenisSekolah::class, 'id', 'id_jenis_sekolah');
    }

    public function negeri()
    {
        return $this->hasOne(Negeri::class, 'id', 'id_negeri');
    }

    public function bandar()
    {
        return $this->hasOne(Bandar::class, 'id', 'id_bandar');
    }

    public function daerah()
    {
        return $this->hasOne(Daerah::class, 'id', 'id_daerah');
    }

    public function ppd()
    {
        return $this->hasOne(PPD::class, 'id', 'id_ppd');
    }

    public function pusat()
    {
        return $this->hasMany(Pusat::class, 'id_sekolah', 'id');
    }

    public function kru()
    {
        return $this->hasOne(Kru::class, 'id_sekolah', 'id');
    }
}
