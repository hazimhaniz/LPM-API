<?php

namespace App\Models\Pemeriksa;
use App\Models\Kru\Kru;
use App\Models\Pemeriksa\AlamtJawapan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class BorangJawapan extends Model
{
    //use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__borang_jawapan';

    protected $fillable         =   [
        'id_user',
        'id_kru',
        'id_pemeriksa',
        'kod_kertas',
        'kod_sek',
        'alamat_sek_1',
        'alamat_sek_2',
        'alamat_sek_3',
        'poskod',
        'no_faks_sek',
        'no_tel_sek',
        'alamat_rmh_1',
        'alamat_rmh_2',
        'alamat_rmh_3',
        'ic_no',
        'no_tel',
        'kelulusan_akademik',
        'gred_jawatan',
        'pengalaman_memeriksa',
        'pengalaman_memeriksa_hingga',
        'subject_ngajar',
        'subject_lain',
        'mata_pelajaran',
        'tahun_ngajar',
        'status'
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];


}
