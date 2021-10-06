<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaRequest extends FormRequest
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
            'select_peranan'                => 'required',
            'id_pengguna'                   => 'required|alpha_num|unique:users,id_pengguna,null,id,id_pengguna,'.$this->id_peperiksaan,
            'email'                         => 'required|email|unique:users,email',
            'password_1'                    => 'min:6|required_with:password_2|same:password_2',
            'password_2'                    => 'min:6',
            'name'                          => 'required|min:6',
            'ic'                            => 'required|regex:/^\d{12}$/|unique:kru,no_kad_pengenalan',
            'phone'                         => 'required|regex:/^[(]?[0-9]{3}[)]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'address'                       => 'required|min:10',
            'postcode'                      => 'required|max:5|regex:/\b\d{5}\b/',
            'select_pengguna_negeri'        => 'required',
            'select_pengguna_bandar'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'select_peranan.required'                   => 'Ruangan peranan mesti dipilih',
            'id_pengguna.required'                      => 'Ruangan kata nama mesti diisi',
            'id_pengguna.alpha_num'                     => 'Kata nama hanya huruf dan nombor sahaja dibenarkan. Tanda space tidak dibenarkan',
            'id_pengguna.unique'                        => 'Kata nama yang dimasukkan telah wujud di dalam pangkalan data. Sila pilih kata nama lain',
            'email.required'                            => 'Ruangan email mesti diisi',
            'email.email'                               => 'Alamat email yang dimasukkan tidah sah',
            'password_1.required_with'                  => 'Ruangan kata laluan mesti diisi',
            'password_1.same'                           => 'Kata laluan dimasukkan tidak sepadan dengan yang ditaip semula. Sahkan kemasukkan',
            'name.required'                             => 'Ruangan nama mesti diisi',
            'ic.required'                               => 'Ruangan no kad pengenalan mesti diisi',
            'ic.digits'                                 => 'Ruangan no kad pengenalan hendaklah diisi dalam bilangan 12 angka tanpa huruf atau simbol Cth: 960112011234',
            'ic.unique'                                 => 'No kad pengenalan telah wujud dengan Sistem Maklumat Perpaduan.',
            'phone.required'                            => 'Ruangan no telefon mesti diisi',
            'phone.digits_between'                      => 'uangan no telefon hendaklah dalam bilangan antara 10 hingga 12 angka tanpa huruf atau simbol',
            'address.required'                          => 'Alamat 1 mesti diisi',
            'postcode.required'                         => 'Ruangan Poskod mestilah diisi',
            'postcode.max'                              => 'Ruangan Poskod mestilah tidak melebihi 5 digit',
            'postcode.regex'                            => 'Ruangan Poskod mestilah dalam bentuk digit dan tidak melebihi 5 digit',
            'select_pengguna_negeri.required'           => 'Sila pillih negeri',
            'select_pengguna_bandar.required'           => 'Sila pilih bandar',
        ];
    }
}
