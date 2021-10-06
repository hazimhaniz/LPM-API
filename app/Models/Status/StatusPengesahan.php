<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPengesahan extends Model
{
    const TIADA                              = NULL;
    const SAH                                = 1;
    const TIDAK_SAH                          = 2;
    const DALAM_PENGESAHAN                   = 3;
    const DALAM_PENGESAHAN_JPN               = 4;
    const DALAM_PENGESAHAN_PENGARAH_JPN      = 5;
    const DALAM_PENGESAHAN_PENGETUA_SEKOLAH  = 6;
    const DALAM_PENGESAHAN_UMPK              = 7;
    const DALAM_PENGESAHAN_JPN_ASAL          = 8;
    const DALAM_PENGESAHAN_JPN_BARU          = 9;
    const DALAM_PENGESAHAN_SUP_BARU          = 10;
    const DALAM_PENGESAHAN_KPP_UPU           = 11;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'status__status_pengesahan';

    protected $fillable         =   [
        'keterangan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
