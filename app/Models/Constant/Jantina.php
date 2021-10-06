<?php

namespace App\Models\Constant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Jantina extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_constant__kod_jantina';

    protected $fillable         =   [
        'kod_jantina',
        'keterangan',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
