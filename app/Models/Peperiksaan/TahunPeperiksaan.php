<?php

namespace App\Models\Peperiksaan;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;

class TahunPeperiksaan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory, SoftDeletes;

    protected $primaryKey       =   'id';
    protected $table            =   'peperiksaan__tahun_peperiksaan';

    const ID_TAHUN_SEMASA       =   1;
    const ID_TAHUN_AKAN_DATANG  =   2;
    const ID_TAHUN_LEPAS        =   3;

    protected $guarded         =   ['id', 'created_at', 'updated_at'];

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts            =   [
        'jadual_kerja'          => 'array',
    ];

    public function peperiksaan()
    {
        return $this->hasOne(Peperiksaan::class, 'id', 'id_peperiksaan');
    }

}
