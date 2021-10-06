<?php

namespace App\Models\Pemeriksa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlamatRumah extends Model
{
    // use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__pemeriksa_alamat_rumah';

    protected $fillable         =   [
        'id_kru',
        'id_user',
        'id_pemeriksa',
        'alamat_1',
        'alamat_2',
        'alamat_3',
        'poskod',
        'id_bandar',
        'id_negeri',
        'no_telefon_rumah',
        'no_telefon_bimbit',
        'no_emel',
        'no_cukai_pendapatan',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

}
