<?php

namespace App\Models\Kru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KruPermohonan extends Model
{
    use HasFactory, SoftDeletes;


    protected $primaryKey       =   'id';
    protected $table            =   'kru__permohonan';

    protected $fillable         =   [
        'id_kru',
        'id_jawatan_permohonan',
        'kod_mp_permohonan',
        'kod_pentaksiran',
        'id_tahun_peperiksaan',
        'poskod',
        'status_surat_pelantikan',
        'status_sijil_penghargaan'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
