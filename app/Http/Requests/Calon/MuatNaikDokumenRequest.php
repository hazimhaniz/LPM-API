<?php

namespace App\Http\Requests\Calon;

use Illuminate\Foundation\Http\FormRequest;

class MuatNaikDokumenRequest extends FormRequest
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
            'dokumen'               => 'required|mimes:pdf',
            'id_calon'              => 'required',
            'size'                  => 'required|max:100000',
            'id_jenis_dokumen'      => 'required',
            'id_status_pengesahan'  => 'required'
        ];
    }
}
