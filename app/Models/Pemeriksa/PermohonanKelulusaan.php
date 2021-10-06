<?php

namespace App\Models\Pemeriksa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermohonanKelulusaan extends Model
{
    // use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__permohonan_kelulusan';

    protected $fillable         =   [
        'id_kru',
        'id_user',
        'id_pemeriksa',
        'kelulusan_akademik_tertinggi',
        'grade_akademik_tertinggi',
        'tahun_akademik_tertinggi',
        'kelulusan_ikhtisas',
        'grade_ikhtisas',
        'tahun_ikhtisas',
        'kelulusan_mp_utama',
        'grade_mp_utama',
        'tahun_mp_utama',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

}
