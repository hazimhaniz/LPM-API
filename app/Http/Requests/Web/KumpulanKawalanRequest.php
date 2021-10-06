<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class KumpulanKawalanRequest extends FormRequest
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
            'name'          => 'required|string|min:5|unique:users__roles,name',
            'description'   => 'required|string|min:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Keterangan hendaklah diisi',
            'name.unique'           => 'Nama Keterangan ini telah digunakan',
            'description.required'  => 'Keterangan panjang hendaklah diisi'
        ];
    }
}
