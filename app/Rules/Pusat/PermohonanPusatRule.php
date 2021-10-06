<?php

namespace App\Rules\Pusat;

use App\Models\Permohonan\PermohonanPusat;
use App\Models\Status\StatusPengesahan;
use Illuminate\Contracts\Validation\Rule;

class PermohonanPusatRule implements Rule
{
    private $peperiksaan;

    public function __construct($peperiksaan)
    {
        $this->peperiksaan = $peperiksaan;
    }

    public function passes($attribute, $value)
    {

        $peperiksaan = $this->peperiksaan;

        $semakPermohonan = PermohonanPusat::whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
            $query->where('id', $peperiksaan->id);
        })
        ->where('id_tahun_peperiksaan'  , $peperiksaan->id_tahun_peperiksaan_semasa)
        ->where('id_status_pengesahan'  , StatusPengesahan::DALAM_PENGESAHAN)
        ->first();

        return true;
        // return $semakPermohonan === null;
    }

    public function message()
    {
        return 'Permohonan Pusat di Sekolah masih dalam proses';
    }
}
