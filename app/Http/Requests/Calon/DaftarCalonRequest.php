<?php

namespace App\Http\Requests\Calon;

use Illuminate\Foundation\Http\FormRequest;
use Log;

class DaftarCalonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_jenis_peperiksaan'                    => 'sometimes|nullable',
            'permohonan'                              => 'required|array|between:4,6',
            'permohonan.id_kemasukan'                 => 'required||integer|size:12',
            'permohonan.id_pusat'                     => 'required',
            'permohonan.id_sekolah'                   => 'required',
            'permohonan.id_jenis_pendaftaran'         => 'required|integer|in:1,2,3,4,5,6,7,8',
            'permohonan.tahun_peperiksaan_spm'        => 'exclude_unless:id_jenis_peperiksaan,true|required|string|min:4|max:4',
            'permohonan.angka_giliran_spm'            => 'exclude_unless:id_jenis_peperiksaan,true|required|string|min:3|max:10',
            'calon'                                   => 'required|array|between:18,21',
            'calon.no_kad_pengenalan'                 => 'sometimes|nullable|regex:/^\d{12}$/|unique:calon,id,'. $this->id_calon .',id',
            'calon.no_pengenalan_lain'                => 'sometimes|nullable|unique:calon,no_pengenalan_lain',
            'calon.no_janaan_lp'                      => 'sometimes|nullable',
            'calon.nama'                              => 'required|min:5|max:255|string',
            'calon.nama_i18n'                         => 'exclude_unless:id_jenis_peperiksaan,true|required|min:5|max:255|string',
            'calon.emel'                              => 'required|email:rfc,dns|string',
            'calon.tarikh_lahir'                      => 'required|date_format:Y-m-d',
            'calon.no_telefon'                        => 'required|string|min:10|max:11|regex:/^[(]?[0-9]{3}[)]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/',
            'calon.id_keperluan_khas'                 => 'sometimes|nullable|string',
            'calon.no_kad_oku'                        => 'required_with:calon.id_keperluan_khas|nullable|string',
            'calon.id_jantina'                        => 'required|in:1,2',
            'calon.id_agama'                          => 'required',
            'calon.id_keturunan'                      => 'required',
            'calon.id_warganegara'                    => 'required|in:1,2',
            'calon.tahun_peperiksaan_terakhir'        => 'exclude_unless:id_jenis_peperiksaan,true|required_if:calon.permohonan.id_kemasukan,11|nullable',
            'calon.angka_giliran_terakhir'            => 'exclude_unless:id_jenis_peperiksaan,true|required_if:calon.permohonan.id_kemasukan,11|nullable',
            'calon.alamat'                            => 'required|min:5|max:255|string',
            'calon.poskod'                            => 'required|min:5|max:5',
            'calon.id_negeri'                         => 'required|in:0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,15,16',
            'calon.id_bandar'                         => 'required',
        ];
    }

    public function messages()
    {

        return [

            'permohonan.id_kemasukan.required'              => 'ID Kemasukan MESTI diisi',
            'permohonan.id_pusat.required'                  => 'ID Pusat MESTI diisi',
            'permohonan.id_sekolah.required'                => 'ID Sekolah MESTI diisi',
            'permohonan.id_jenis_pendaftaran.required'      => 'ID jenis pendaftaran MESTI diisi',

            'calon.no_kad_pengenalan.required'              => 'No. Kad Pengenalan MESTI diisi',
            'calon.no_kad_pengenalan.unique'                => 'No. Kad Pengenalan :input Sudah Daftar',

            'calon.nama.required'                           => 'Nama Calon MESTI diisi',

        ];

    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
