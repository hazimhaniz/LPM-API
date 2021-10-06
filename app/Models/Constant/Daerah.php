<?php

namespace App\Models\Constant;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Constant\Negeri;

class Daerah extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__daerah';

    protected $fillable         =   [
        'kod_daerah',
        'keterangan',
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
    
}
