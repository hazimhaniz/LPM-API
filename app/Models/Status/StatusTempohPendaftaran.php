<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTempohPendaftaran extends Model
{
    const TIADA                 = 0;
    const DALAM_TEMPOH          = 1;
    const LUAR_TEMPOH           = 2;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'status__status_tempoh_pendaftaran';

    protected $fillable         =   [
        'keterangan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
