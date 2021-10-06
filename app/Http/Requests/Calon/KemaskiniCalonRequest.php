<?php

namespace App\Http\Requests\Calon;

use Illuminate\Foundation\Http\FormRequest;

class KemaskiniCalonRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {

        return [

            'id_calon'                                      => 'required|exists:calon,id',
            'calon'                                         => 'required|array|between:21,22',
            'calon.no_kad_pengenalan'                       => 'sometimes|nullable|regex:/^\d{12}$/|unique:calon,id,'. $this->id_calon .',id',
            'calon.no_pengenalan_lain'                      => 'sometimes|nullable',
            'calon.no_janaan_lp'                            => 'required_if:calon.no_kad_pengenalan, null',
            'calon.nama'                                    => 'required|min:5|max:255|string',
            'calon.nama_i18n'                               => 'required|min:5|max:255|string',
            'calon.emel'                                    => 'required|email:rfc,dns|string',
            'calon.tarikh_lahir'                            => 'required|date_format:Y-m-d',
            'calon.no_telefon'                              => 'required|string|min:10|max:11|regex:/^[(]?[0-9]{3}[)]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'calon.id_keperluan_khas'                       => 'sometimes|nullable|string',
            'calon.no_kad_oku'                              => 'required_with:calon.id_keperluan_khas|nullable|string',
            'calon.id_jantina'                              => 'required|in:1,2',
            'calon.id_agama'                                => 'required',
            'calon.id_keturunan'                            => 'required',
            'calon.id_warganegara'                          => 'required|in:1,2',
            'calon.tahun_peperiksaan_terakhir'              => 'required_if:calon.permohonan.id_kemasukan,11|nullable',
            'calon.angka_giliran_terakhir'                  => 'required_if:calon.permohonan.id_kemasukan,11|nullable',
            'calon.alamat'                                  => 'required|min:5|max:255|string',
            'calon.poskod'                                  => 'required|min:5|max:5',
            'calon.id_negeri'                               => 'required|in:0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,15,16',
            'calon.id_bandar'                               => 'required',
            'calon.permohonan'                              => 'required|array|size:6',
            'calon.permohonan.id_pusat'                     => 'required',
            'calon.permohonan.id_sekolah'                   => 'sometimes|nullable|string',
            'calon.permohonan.id_kemasukan'                 => 'required|in:1,2,3,4,5,6,7,8,9,10,11,12',
            'calon.permohonan.id_jenis_pendaftaran'         => 'required|integer|in:1,2,3,4,5,6,7,8',
            'calon.permohonan.tahun_peperiksaan_spm'        => 'required|string|min:4|max:4',
            'calon.permohonan.angka_giliran_spm'            => 'required|string|min:3|max:10',
        ];
    }

    // public function messages()
    // {

    //     return [

    //     ];

    // }

    public function all($keys = null) {

        return array_merge(parent::all(), $this->route()->parameters());
    }
}
