<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReplicationYearRequest;
use App\Models\Peperiksaan\TahunPeperiksaan;

class ReplicationController extends Controller
{
    public function year(ReplicationYearRequest $request){

        $tahunPeperiksaan = TahunPeperiksaan::create([

            'id_peperiksaan'       => $request->id_peperiksaan,
            'tahun'                => $request->tahun,
            'id_status_tahun'      => isset($request->aktif) ? true : false 
        ]);

        return response()->json($tahunPeperiksaan->fresh());
    }
}
