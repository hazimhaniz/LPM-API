<?php

namespace App\Models\Constant;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Constant\Negeri;
use App\Models\Peperiksaan\RefPeperiksaan\PPD;

class Parlimen extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__parlimen';

    protected $fillable         =   [
        'kod_parlimen',
        'keterangan',
        'id_negeri',
        'id_kod_ppd',
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

    public function kod_ppd() 
    {
        return $this->hasOne(PPD::class, 'id', 'id_kod_ppd');

    }
}
