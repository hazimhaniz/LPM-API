<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class KawalanSistemRequest extends FormRequest
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
            'name'              =>  'required|string|min:5|unique:users__permission',
            'description'       =>  'required|string|min:10',
            'sub_permissions'   =>  'exists'
        ];
    }

    public function messages()
    {
        return [
            'name.required'         =>  'Nama keterangan hendaklah diisi',
            'name.unique'           =>  'Nama Keterangan telah digunakan',
            'description.required'  =>  'Nama Keterangan Panjang hendaklah diisi'
        ];
    }
}
