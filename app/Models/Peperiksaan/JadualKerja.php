<?php

namespace App\Models\Peperiksaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class JadualKerja extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory, SoftDeletes;


    protected $primaryKey       =   'id';
    protected $table            =   'peperiksaan__jadual_kerja';

    protected $fillable         =   [
        'id_tahun_peperiksaan',
        'keterangan',
        'tarikh_mula',
        'tarikh_tamat',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'tarikh_mula' => 'datetime:Y-m-d',
        'tarikh_tamat' => 'datetime:Y-m-d'
    ];
}
