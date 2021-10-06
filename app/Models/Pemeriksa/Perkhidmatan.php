<?php

namespace App\Models\Pemeriksa;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perkhidmatan extends Model
{
    // use HasFactory, SoftDeletes;
    use HasFactory;
    protected $primaryKey       =   'id';
    protected $table            =   'kru__perkhidmatan';

    protected $fillable         =   [
        'id_kru',
        'id_user',
        'id_pemeriksa',
        'jawatan',
        'gred_jawatan',
        'tetap_sandaran',
        'tarikh_bersara',
    ];

    protected $hidden           =   [
        'created_at',
        'updated_at',
    ];

}
