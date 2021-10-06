<?php

namespace App\Models\Constant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Agama extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__kod_agama';

    protected $fillable         =   [
        'kod_agama',
        'keterangan',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
