<?php

namespace App\Models\Calon\RefCalon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKeperluanKhas extends Model
{
    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_calon__kod_jenis_keperluan_khas';

    protected $fillable         =   [
        'keterangan',
        'status'
    ];

}
