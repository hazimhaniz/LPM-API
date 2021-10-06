<?php

namespace App\Http\Requests\Pusat;

use App\Rules\Pusat\PermohonanPusatRule;
use Illuminate\Foundation\Http\FormRequest;

class PermohonanPusatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_sekolah'                => ['required', 'numeric', new PermohonanPusatRule($this->peperiksaan)],
        ];
    }

    public function messages()
    {
        return [
            'id_sekolah.required'       => ':attribute MESTI diisi',
            'id_sekolah.numeric'        => ':attribute MESTI number',
        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
