<?php

namespace App\Models\Constant;

use App\Models\Peperiksaan\RefPeperiksaan\PPD;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Negeri extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__negeri';

    protected $fillable         =   [
        'kod_negeri',
        'keterangan',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function ppd() {
        return $this->hasMany(PPD::class, 'id_negeri' , 'id');
    }
}
