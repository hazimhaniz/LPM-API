<?php

namespace App\Http\Requests\Calon;

use Illuminate\Foundation\Http\FormRequest;

class PembetulanCalonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                    => 'required',
            'id_calon'              => 'required',
            'id_jenis_pendaftaran'  => 'required',
            'maklumat_baharu'       => 'required|string',
            'maklumat_lama'         => 'required|string'
        ];
    }
}
