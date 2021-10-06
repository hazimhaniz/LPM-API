<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PusatPermohonan extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'pusat'                 => $request->id_pusat,
            'sekolah'               => $request->id_sekolah,
            'jenis_calon'           => $request->id_jenis_calon,
            'tahun_peperiksaan'     => $request->id_tahun_peperiksaan,
            'status_permohonan'     => $request->status_permohonan,
        ];
    }
}
