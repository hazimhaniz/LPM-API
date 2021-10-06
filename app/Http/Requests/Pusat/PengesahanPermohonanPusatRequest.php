<?php

namespace App\Http\Requests\Pusat;

use App\Rules\Pusat\PengesahanPermohonanRule;
use App\Rules\Pusat\PengesahanPermohonanSekolahRule;
use Illuminate\Foundation\Http\FormRequest;

class PengesahanPermohonanPusatRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_permohonan_pusat'               => ['required', 'numeric', 'exists:permohonan__pusat,id', new PengesahanPermohonanRule($this)],
            'id_sekolah'                        => ['required', 'numeric', 'exists:ref_peperiksaan__kod_sekolah,id', new PengesahanPermohonanSekolahRule($this)],
        ];
    }

    public function messages()
    {

        return [
            'id_permohonan_pusat.required'      => ':attribute MESTI diisi',
            'id_permohonan_pusat.numeric'       => ':attribute MESTI number',
            'id_permohonan_pusat.exists'        => ':attribute tidak wujud',

            'id_sekolah.required'               => ':attribute MESTI diisi',
            'id_sekolah.numeric'                => ':attribute MESTI number',
            'id_sekolah.exists'                 => ':attribute tidak wujud',
        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
