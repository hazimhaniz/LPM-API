<?php

namespace App\Http\Requests\Calon;

use Illuminate\Foundation\Http\FormRequest;

class DaftarSenaraiCalonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {

        $id_peperiksaan = $this->peperiksaan->id == 1 ? 2 : 1;

        return [


            /*
                Maklumat Permohonan
            */

            'permohonan.id_kemasukan'                       => 'required',
            'permohonan.id_pusat'                           => ['required','exists:ref_peperiksaan__kod_pusat,id'],
            'permohonan.id_sekolah'                         => 'required',
            'permohonan.id_jenis_pendaftaran'               => 'required',

            /*
                Maklumat Calon
            */

            'senarai_calon.*.calon.no_kad_pengenalan'      => ['required', 'unique:calon,no_kad_pengenalan,'.$id_peperiksaan.',id_peperiksaan'],
            'senarai_calon.*.calon.nama'                   => 'required',
            // 'calon.nama_i18n'                               => 'required',
            // 'calon.no_pengenalan_lain'                      => 'required',
            // 'calon.tarikh_lahir'                            => 'required',
            // 'calon.id_jantina'                              => 'required',
            // 'calon.id_keturunan'                            => 'required',
            // 'calon.id_agama'                                => 'required',
            // 'calon.id_warganegara'                          => 'required',
            // 'calon.alamat'                                  => 'required',
            // 'calon.poskod'                                  => 'required',
            // 'calon.id_bandar'                               => 'required',
            // 'calon.id_negeri'                               => 'required',
            // 'calon.no_telefon'                              => 'required',
            // 'calon.emel'                                    => 'required',
            // 'calon.tahun_peperiksaan_terakhir'              => 'required',
            // 'calon.id_jenis_kecacatan'                      => 'required',
            // 'calon.tahun_peperiksaan_spm_terakhir'          => 'required',
        ];
    }

    public function messages()
    {

        $messages =  [

            'permohonan.id_kemasukan.required'                      => 'ID Kemasukan MESTI diisi',
            'permohonan.id_pusat.required'                          => 'ID Pusat MESTI diisi',
            'permohonan.id_pusat.exists'                            => 'ID Pusat Tidak Wujud',
            'permohonan.id_sekolah.required'                        => 'ID Sekolah MESTI diisi',
            'permohonan.id_jenis_pendaftaran.required'              => 'ID jenis pendaftaran MESTI diisi',

            'senarai_calon.*.calon.no_kad_pengenalan.required'      => 'No. Kad Pengenalan MESTI diisi',
            'senarai_calon.*.calon.no_kad_pengenalan.unique'        => 'No. Kad Pengenalan :input Sudah Daftar',

            'senarai_calon.*.calon.nama.required'                   => 'Nama Calon MESTI diisi',

        ];

        // foreach ($this->get('senarai_calon') as $key => $val) {
        //     $messages["senarai_calon.*.calon.no_kad_pengenalan"] = "$val is not a valid active url";
        // }

        // dd($messages);
        return $messages;
    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }
}
