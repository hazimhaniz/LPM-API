<?php

namespace App\Models\Kru;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Kru\KruAlamat;

class Kru extends Model
{
    use HasFactory, SoftDeletes;


    protected $primaryKey       =   'id';
    protected $table            =   'kru';

    protected $guarded         =   ['id', 'created_at', 'updated_at', 'deleted_at'];

    protected $hidden           =   [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'alamat'
    ];

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class, 'id', 'id_sekolah');
    }

    public function pusat()
    {
        return $this->hasMany(Pusat::class, 'id_sekolah', 'id_sekolah');
    }

    public function alamat()
    {
        return $this->hasOne(KruAlamat::class, 'id_kru', 'id_user');
    }

    public function getAlamatAttribute()
    {
        return $this->alamat()->get();
    }
}
