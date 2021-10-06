<?php

namespace App\Http\Requests\Calon;

use App\Models\Constant\Negeri;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class DaftarCalonPersendirianRequest extends FormRequest
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
    public function rules() {
       
        if (app()->environment('local', 'development', 'staging')) {
            $emailRules = ['emel' => 'required|email:rfc,dns'];
        } else {
            $emailRules = ['emel' => 'required|email:rfc,dns|unique:calon,emel'];
        }

        $rules = array_merge($emailRules, [
            'no_kad_pengenalan'                       => 'sometimes|nullable|unique:users,id_pengguna|regex:/^\d{12}$/',
            'nama'                                    => 'required|min:6|max:255',
            'no_janaan_lp'                            => 'sometimes|nullable|unique:users,id_pengguna',
            'no_passport'                             => 'sometimes|nullable|regex:/^[A-PR-WYa-pr-wy][1-9]\d\s?\d{4}[1-9]$/|unique:calon,no_pengenalan_lain',
            'id_negeri'                               => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,15',
            'no_telefon'                              => 'required|regex:/^[(]?[0-9]{3}[)]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'password'                                => 'required|confirmed|min:8',Password::defaults(),
            'concern'                                 => 'required'
        ]);

        return $rules;
    }

    public function messages() {

        return [
            'no_kad_pengenalan.required'              => 'No. Kad Pengenalan hendaklah diisi',
            'no_kad_pengenalan.unique'                => 'No. Kad Pengenalan sudah wujud',
            'no_kad_pengenalan.regex'                 => 'No. Kad Pengenalan tidak mengikut format',
            'nama.required'                           => 'Nama Calon hendaklah diisi',
            'emel.required'                           => 'Emel Calon hendaklah diisi',
            'emel.unique'                             => 'Emel Calon sudah didaftarkan',
            'emel.email'                              => 'Emel hendaklah emel yang sah dan boleh digunakan',
            'id_negeri.required'                      => 'Negeri tempat peperiksaan hendaklah dipilih',
            'no_telefon.regex'                        => 'No. Telefon tidak megikut format',
            'no_telefon.required'                     => 'No. Telefon Calon hendaklah diisi',
            'password.required'                       => 'Kata Laluan hendaklah diisi',
            'password.confirmed'                      => 'Kata Laluan tidak sama',
            'password.min'                            => 'Kata Laluan tidak melebihi minimum 8 karakter',
            'concern.required'                        => 'Anda perlu tick pada check box yang disedia kan'
        ];
    }

    public function all($keys = null) {

        return array_merge(parent::all(), $this->route()->parameters());
    }
}
