<?php

namespace App\Models\Peperiksaan\RefPeperiksaan;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Constant\Negeri;

class PPD extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_peperiksaan__kod_ppd';

    protected $fillable         =   [
        'kod_ppd',
        'nama_ppd',
        'id_negeri',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function negeri()
    {
        return $this->hasOne(Negeri::class, 'id', 'id_negeri');
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class, 'id_ppd', 'id'); 
    }
}
