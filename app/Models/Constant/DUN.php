<?php

namespace App\Models\Constant;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Constant\Negeri;
use App\Models\Constant\Parlimen;

class DUN extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__dun';

    protected $fillable         =   [
        'kod_dun',
        'keterangan',
        'kod_parlimen',
        'id_negeri',
        'status',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

    public function negeri()
    {
        return $this->hasOne(Negeri::class, 'id', 'id_negeri');
    }

    public function parlimen()
    {
        return $this->hasOne(Parlimen::class, 'kod_parlimen', 'kod_parlimen');
    }
}
