<?php

namespace App\Models\Pemeriksa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PengalamanPetugas extends Model
{
    // use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__pengalaman_bertugas';

    protected $fillable         =   [
        'id_kru',
        'id_user',
        'id_pemeriksa',
        'jawatan_nama',
        'nama_peperiksaan',
        'nama_metapelajaran',
        'tahun_mula',
        'tahun_hingga',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

}
