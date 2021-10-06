<?php

namespace App\Models\Calon;

use App\Models\Calon\Calon;
use App\Models\Permohonan\PermohonanCalonPindahPusat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CalonPindahPusat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'calon__pindah';

    protected $fillable         =   [
        'id_calon',
        'tempoh_permohonan',
        'id_sekolah_baharu',
    ];

    public function calon()
    {
        return $this->hasOne(Calon::class, 'id', 'id_calon');
    }

    public function permohonan()
    {
        return $this->hasOne(PermohonanCalonPindahPusat::class, 'id_calon', 'id_calon');
    }
}
