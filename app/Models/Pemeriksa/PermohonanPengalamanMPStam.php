<?php

namespace App\Models\Pemeriksa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermohonanPengalamanMPStam extends Model
{
    // use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__permohonan_pengalaman_mp_stam';

    protected $fillable         =   [
        'id_kru',
        'id_user',
        'id_pemeriksa',
        'id_matapelajaran',
        'darjah_tingkatan',
        'tahun_mula',
        'tahun_tamat',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

}
