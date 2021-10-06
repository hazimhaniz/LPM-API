<?php

namespace App\Repositories;

use App\Models\Bayaran\BayaranPendaftaranCalon;
use App\Models\Bayaran\BayaranPendaftaranCalonSekolah;
class PembayaranRepository extends BaseRepository
{

    private $bayaranPendaftaranCalonSekolah;
    private $bayaranPendaftaranCalon;

    public function __construct(
        BayaranPendaftaranCalonSekolah $bayaranPendaftaranCalonSekolah,
        BayaranPendaftaranCalon $bayaranPendaftaranCalon
    ) {
        $this->bayaranPendaftaranCalonSekolah   = $bayaranPendaftaranCalonSekolah;
        $this->bayaranPendaftaranCalon          = $bayaranPendaftaranCalon;
    }
}
