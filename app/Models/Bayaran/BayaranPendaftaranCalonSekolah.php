<?php

namespace App\Models\Bayaran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BayaranPendaftaranCalonSekolah extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    use HasFactory;

    protected $primaryKey       =   'id';
    protected $table            =   'bayaran__pendaftaran_calon_sekolah';

    protected $fillable         =   [
        'id_tahun_peperiksaan',
        'id_jenis_pengguna',
        'id_user',
        'id_pusat',
        'id_calon',
        'no_resit',
        'tarikh_resit',
        'jumlah_bayaran',
        'jumlah_calon',
        'id_penjenisan_bayaran',
        'id_status_permohonan',
        'id_status_pembayaran',
        'url_bayaran',
        'url_status',
    ];
}
