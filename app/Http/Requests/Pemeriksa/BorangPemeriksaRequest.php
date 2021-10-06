<?php

namespace App\Http\Requests\Pemeriksa;

use Illuminate\Foundation\Http\FormRequest;

class BorangPemeriksaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_kru'                            => ['required', 'numeric'],
            'id_user'                           => ['required', 'numeric'],
            'id_pemeriksa'                      => ['required', 'numeric'],
            'kod_kertas'                        => ['required', 'numeric'],
            'ic_no'                             => ['required'],
            'kod_sek'                           => ['required'],
            'alamat_sek_1'                      => ['required'],
            'poskod'                            => ['required'],
            'no_tel_sek'                        => ['required'],
            'alamat_rmh_1'                      => ['required'],
            'no_tel'                            => ['required'],
            'kelulusan_akademik'                => ['required'],
            'gred_jawatan'                      => ['required'],
            'pengalaman_memeriksa'              => ['required'],
            'subject_ngajar'                    => ['required','array'],
            'subject_lain'                      => ['required'],
            'tahun_ngajar'                      => ['required'],
            'status'                            => ['required'],
        ];
    }

    public function messages()
    {

        return [
            'id_kru.required'                   => ':attribute MESTI diisi',
            'id_kru.numeric'                    => ':attribute MESTI number',

            'id_user.required'                   => ':attribute MESTI diisi',
            'id_user.numeric'                    => ':attribute MESTI number',

            'id_pemeriksa.required'              => ':attribute MESTI diisi',
            'id_pemeriksa.numeric'               => ':attribute MESTI number',

            'kod_kertas.required'                => ':attribute MESTI diisi',
            'kod_kertas.numeric'                 => ':attribute MESTI number',

            'ic_no.required'                   => ':attribute MESTI diisi',
            'kod_sek.required'                 => ':attribute MESTI diisi',
            'alamat_sek_1.required'            => ':attribute MESTI diisi',
            'poskod.required'                  => ':attribute MESTI diisi',
            'no_tel_sek.required'              => ':attribute MESTI diisi',
            'alamat_rmh_1.required'            => ':attribute MESTI diisi',
            'no_tel.required'                  => ':attribute MESTI diisi',
            'kelulusan_akademik.required'      => ':attribute MESTI diisi',
            'gred_jawatan.required'            => ':attribute MESTI diisi',
            'pengalaman_memeriksa.required'    => ':attribute MESTI diisi',
            'subject_ngajar.required'          => ':attribute MESTI diisi',
            'subject_ngajar.array'             => ':attribute MESTI array',
            'subject_lain.required'            => ':attribute MESTI diisi',
            'tahun_ngajar.required'            => ':attribute MESTI diisi',
            'status.required'                  => ':attribute MESTI diisi',

        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
