<?php

namespace App\Http\Requests\Pusat;

use Illuminate\Foundation\Http\FormRequest;

class KemaskiniPusatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_pusat'                          => ['required', 'numeric', 'exists:ref_peperiksaan__kod_pusat,id'],
            'id_sekolah'                        => ['required', 'numeric', 'exists:ref_peperiksaan__kod_sekolah,id'],
            'kod_pusat'                         => ['required'],
            'nama_pusat'                        => ['required', 'string'],
            'jumlah_calon'                      => ['required', 'numeric'],
            'ids_mata_pelajaran'                => ['required', 'array'],
            'id_status_pendaftaran'             => ['required'],
        ];
    }

    public function messages()
    {

        return [
            'id_pusat.required'                 => ':attribute MESTI diisi',
            'id_pusat.numeric'                  => ':attribute MESTI number',
            'id_pusat.exists'                   => ':attribute tidak wujud',

            'id_sekolah.required'               => ':attribute MESTI diisi',
            'id_sekolah.numeric'                => ':attribute MESTI number',
            'id_sekolah.exists'                 => ':attribute tidak wujud',

            'kod_pusat.required'                => ':attribute MESTI diisi',
            'kod_pusat.unique'                  => ':attribute Sudah Wujud',

            'nama_pusat.required'               => ':attribute MESTI diisi',

            'jumlah_calon.required'             => ':attribute MESTI diisi',
            'jumlah_calon.numeric'              => ':attribute MESTI number',

            'ids_mata_pelajaran.required'       => ':attribute MESTI diisi',
            'ids_mata_pelajaran.array'          => ':attribute MESTI jenis array',

            'id_status_pendaftaran.required'    => ':attribute MESTI diisi',
        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
