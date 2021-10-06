<?php

namespace App\Models\Dokumen\RefDokumen;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisDokumen extends Model
{

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_calon__jenis_dokumen';

    protected $fillable         =   [
        'keterangan',
        'status',
    ];
}
