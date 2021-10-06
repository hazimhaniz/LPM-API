<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CalonPembetulanMaklumat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'calon__pembetulan_maklumat';

    protected $fillable         =   [
        'id_calon',
        'id_jenis_pembetulan',
        'id_penjenisan_bayaran',
        'id_jenis_pendaftaran',
        'id_peperiksaan',
        'maklumat_asal',
        'maklumat_baharu',
        'status_pembayaran',
        'id_status_permohonan',
        'no_resit',
        'tarikh_resit',
        'jumlah_bayaran',
        'url_bayaran',
        'url_status'
    ];

    protected $casts = [
        'maklumat_asal' => 'array',
        'maklumat_baru' => 'array'
    ];

    public function calon(){

        return $this->hasOne(Calon::class, 'id', 'id_calon');
    }
}
