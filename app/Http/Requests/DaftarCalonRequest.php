<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaftarCalonRequest extends FormRequest
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

            /*
                Daftar Calon
            */

            // 'calon.tahun'                                   => 'required',
            // 'calon.kod_peperiksaan'                         => 'required',
            // 'calon.nama'                                    => 'required',
            // 'calon.nama_i18n'                               => 'required',
            // 'calon.no_kad_pengenalan'                       => 'required',
            // 'calon.no_pengenalan_lain'                      => 'required',
            // 'calon.dob'                                     => 'required',
            // 'calon.kod_jantina'                             => 'required',
            // 'calon.kod_keturunan'                           => 'required',
            // 'calon.kod_agama'                               => 'required',
            // 'calon.kod_warganegara'                         => 'required',
            // 'calon.alamat'                                  => 'required',
            // 'calon.poskod'                                  => 'required',
            // 'calon.bandar_id'                               => 'required',
            // 'calon.negeri_id'                                => 'required',
            // 'calon.no_telefon'                              => 'required',
            // 'calon.email'                                   => 'required',
            // 'calon.kod_kemasukan'                           => 'required',
            // 'calon.peperiksaan_terakhir'                    => 'required',
            // 'calon.kod_calon'                               => 'required',
            // 'calon.jenis_kecacatan_id'                      => 'required',
            // 'calon.tahun_peperiksaan_spm_terakhir'          => 'required',
            // 'calon.angka_giliran_spm_terakhir'              => 'required',

            /*
                Daftar Mata Palajaran
            */

            // 'mata_pelajaran.*.kod_mata_pelajaran'           => 'required',
            // 'mata_pelajaran.*.mata_pelajaran'               => 'required',

            /*
                Maklumat Pembayaran
            */

            // 'bayaran.maklumat_bayaran.nama_peperiksaan'     => 'required',
            // 'bayaran.maklumat_bayaran.bayaran_asas'         => 'required',
            // 'bayaran.maklumat_bayaran.mata_pelajaran'       => 'required',
            // 'bayaran.maklumat_bayaran.jumlah_bayar'         => 'required',
            // 'bayaran.jenis_bayaran'                         => 'required',

        ];
    }
}
