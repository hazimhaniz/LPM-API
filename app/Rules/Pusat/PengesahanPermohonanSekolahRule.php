<?php

namespace App\Rules\Pusat;

use App\Models\Permohonan\PermohonanPusat;
use Illuminate\Contracts\Validation\Rule;

class PengesahanPermohonanSekolahRule implements Rule
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {

        $request = $this->request;

        $query = PermohonanPusat::whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($request) {
            $query->where('id'  , $request->peperiksaan->id);
        })
        ->where('id_tahun_peperiksaan'  , $request->peperiksaan->id_tahun_peperiksaan_semasa)
        ->where('id'                    , $request->id_permohonan_pusat)
        ->where('id_sekolah'            , $request->id_sekolah)
        ->first();

        return $query !== null;
    }

    public function message()
    {
        return 'Id Sekolah Tidak Sah';
    }
}
