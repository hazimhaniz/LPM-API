<?php

namespace App\Http\Requests\Calon;

use Illuminate\Foundation\Http\FormRequest;

class PembatalanCalonRequest extends FormRequest
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
            'angka_giliran'         => 'required|string',
            'nama'                  => 'required|string',
            'no_kad_pengenalan'     => 'required_if:no_pengenalan_lain, null|string',
            'no_pengenalan_lain'     => 'required_if:no_kad_pengenalan, null|string',
            'id_jenis_pendaftaran'  => 'required|string',
            'sebab_pembatalan'      => 'required|string',
            'id'                    => 'required'
        ];
    }
}
