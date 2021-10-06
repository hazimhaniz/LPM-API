<?php

namespace App\Http\Requests\Pemeriksa;

use Illuminate\Foundation\Http\FormRequest;

class PermohonanPemeriksaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_kru'                            => ['required', 'numeric'],
            'id_user'                           => ['required', 'numeric'],
            'tahun'                             => ['required', 'numeric'],
            'jawapan_poskod'                    => ['required','numeric'],
            'jawapan_id_bandar'                 => ['required','numeric'],
            'jawapan_id_negeri'                 => ['required', 'numeric'],
            'rumah_poskod'                      => ['required','numeric'],
            'rumah_id_bandar'                   => ['required','numeric'],
            'rumah_id_negeri'                   => ['required', 'numeric'],
        ];
    }

    public function messages()
    {

        return [
            'id_kru.required'                   => ':attribute MESTI diisi',
            'id_kru.numeric'                    => ':attribute MESTI number',

            'id_user.required'                   => ':attribute MESTI diisi',
            'id_user.numeric'                    => ':attribute MESTI number',

            'tahun.required'                   => ':attribute MESTI diisi',
            'tahun.numeric'                    => ':attribute MESTI number',

            'jawapan_poskod.required'          => ':attribute MESTI diisi',
            'jawapan_poskod.numeric'           => ':attribute MESTI number',

            'jawapan_id_bandar.required'       => ':attribute MESTI diisi',
            'jawapan_id_bandar.numeric'        => ':attribute MESTI number',

            'jawapan_id_negeri.required'       => ':attribute MESTI diisi',
            'jawapan_id_negeri.numeric'        => ':attribute MESTI number',

            'rumah_poskod.required'            => ':attribute MESTI diisi',
            'rumah_poskod.numeric'             => ':attribute MESTI number',

            'rumah_id_bandar.required'         => ':attribute MESTI diisi',
            'rumah_id_bandar.numeric'          => ':attribute MESTI number',

            'rumah_id_negeri.required'         => ':attribute MESTI diisi',
            'rumah_id_negeri.numeric'         => ':attribute MESTI number',

        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
