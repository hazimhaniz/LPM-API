<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPendaftaran extends Model
{
    const TIADA                 = 0;
    const TELAH_DAFTAR          = 1;
    const BELUM_DAFTAR          = 2;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'status__status_pendaftaran';

    protected $fillable         =   [
        'keterangan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
