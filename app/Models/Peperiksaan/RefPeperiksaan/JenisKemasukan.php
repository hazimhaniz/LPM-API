<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Peperiksaan\Peperiksaan;

class JenisKemasukan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_calon__kod_kemasukan';

    protected $fillable         =   [
        'kod_kemasukan',
        'id_peperiksaan',
        'keterangan',
        'status'
    ];

    public function peperiksaan()
    {
        return $this->hasOne(Peperiksaan::class, 'id', 'id_peperiksaan');
    }
}
