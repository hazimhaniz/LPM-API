<?php

namespace App\Models\Calon\RefCalon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPendaftaran extends Model
{

    const APDM                  = 1;
    const JPN                   = 2;
    const BARU                  = 3;
    const IMPORT                = 4;
    const KOHORT                = 5;
    const LEWAT                 = 6;
    const PERSENDIRIAN          = 7;
    const PINDAH                = 8;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'ref_calon__jenis_pendaftaran';

    protected $fillable         =   [
        'keterangan',
        'status'
    ];

}
