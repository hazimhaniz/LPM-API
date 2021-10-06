<?php

namespace App\Models\Status;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusJanaan extends Model
{
    const TIADA                 = 0;
    const TELAH_DIJANA          = 1;
    const BELUM_DIJANA          = 2;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'status__status_janaan';

    protected $fillable         =   [
        'keterangan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];
}
