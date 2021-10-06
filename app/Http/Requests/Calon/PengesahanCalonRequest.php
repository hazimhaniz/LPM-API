<?php

namespace App\Http\Requests\Calon;

use Illuminate\Foundation\Http\FormRequest;

class PengesahanCalonRequest extends FormRequest
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

            /*
                Daftar Akaun Calon Persendirian
            */

            'id_calon'                                => ['required', 'exists:calon,id'],
        ];
    }

    public function messages()
    {

        return [
            'id_calon.required'                       => 'ID Calon MESTI diisi',
            'id_calon.exists'                         => 'ID Calon Tidak Wujud',

        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
