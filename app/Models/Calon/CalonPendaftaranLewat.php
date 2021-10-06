<?php

namespace App\Models\Calon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CalonPendaftaranLewat extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'calon__pendaftaran_lewat';

    protected $fillable         =   [
        'id_calon',
        'no_resit',
        'tarikh_resit',
        'jumlah_bayaran',
        'catatan',
        'status_pembayaran',
    ];
}
