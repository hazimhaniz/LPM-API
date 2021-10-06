<?php

namespace App\Models\Constant;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Constant\Negeri;
use App\Models\Constant\Daerah;
class Bandar extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__bandar';

    protected $fillable         =   [
        'kod_bandar',
        'keterangan',
        'kod_daerah',
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

    public function daerah()
    {
        return $this->hasOne(Daerah::class, 'kod_daerah', 'kod_daerah');
    }
}
