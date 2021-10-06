<?php

namespace App\Rules\Pusat;

use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use Illuminate\Contracts\Validation\Rule;

class PengesahanPermohonanRule implements Rule
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function passes($attribute, $value)
    {

        $request = $this->request;

        $query = Pusat::whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($request) {
            $query->where('id'  , $request->peperiksaan->id);
        })
        ->where('id_tahun_peperiksaan'  , $request->peperiksaan->id_tahun_peperiksaan_semasa)
        ->where('kod_pusat'             , $request->kod_pusat)
        ->first();

        return true;
        // return $query === null;
    }

    public function message()
    {
        return 'Kod Pusat ini Sudah Wujud';
    }
}
