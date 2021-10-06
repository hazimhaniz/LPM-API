<?php

namespace App\Models\Constant;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Warganegara extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__kod_warganegara';

    protected $fillable         =   [
        'kod_warganegara',
        'keterangan',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
