<?php

namespace App\Http\Requests\Pusat;

use Illuminate\Foundation\Http\FormRequest;

class SemakPermohonanPusatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_permohonan_pusat'               => ['required', 'numeric', 'exists:permohonan__pusat,id'],
        ];
    }

    public function messages()
    {

        return [
            'id_permohonan_pusat.required'      => ':attribute MESTI diisi',
            'id_permohonan_pusat.numeric'       => ':attribute MESTI number',
            'id_permohonan_pusat.exists'        => ':attribute tidak wujud'
        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
