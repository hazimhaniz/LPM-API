<?php

namespace App\Http\Requests\Pusat;

use Illuminate\Foundation\Http\FormRequest;

class PengesahanPusatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_pusat'                          => ['required', 'numeric', 'exists:ref_peperiksaan__kod_pusat,id'],
            'nama_pusat'                        => ['required'],
            'id_status_pendaftaran'             => ['required', 'numeric'],
        ];
    }

    public function messages()
    {

        return [
            'id_pusat.required'                 => ':attribute MESTI diisi',
            'id_pusat.numeric'                  => ':attribute MESTI Number',
            'id_pusat.exists'                   => ':attribute Tidak Wujud',

            'nama_pusat.required'               => ':attribute MESTI diisi',

            'id_status_pendaftaran.required'    => ':attribute MESTI diisi',
            'id_status_pendaftaran.numeric'     => ':attribute MESTI Number',
        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
