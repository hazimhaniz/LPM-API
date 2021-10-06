<?php

namespace App\Models\Dokumen;

use App\Models\Dokumen\RefDokumen\JenisDokumen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class DokumenCalon extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table            =   'dokumen__calon';

    protected $fillable     =   [
        'id_calon',
        'id_jenis_dokumen',
        'dokumen',
        'keterangan',
        'size',
        'id_status_pengesahan'
    ];

    protected $hidden       =   [
        'deleted_at',
    ];

    public function jenisDokumen()
    {
        return $this->hasOne(JenisDokumen::class, 'id', 'id_jenis_dokumen');
    }
}
