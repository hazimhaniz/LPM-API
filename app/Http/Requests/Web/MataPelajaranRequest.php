<?php

namespace App\Http\Requests\Web;

use App\Http\Responses\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class MataPelajaranRequest extends FormRequest
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
            'kod_mata_pelajaran'        =>  'required',
            'nama_mata_pelajaran'       =>  'required',
            'nama_mata_pelajaran_opt'   =>  'required',
            'calon_yang_dibenarkan'     =>  'sometimes',
            'jenis_calon'               =>  'sometimes',
            'markah_maksimum'           =>  'sometimes',
            'cara_penentuan_gred'       =>  'sometimes',
            'jenis_bayaran'             =>  'sometimes',
            'format_pentaksiran'        =>  'sometimes',
            'pentaksiran_opt'           =>  'sometimes',
            'kerja_kursus'              =>  'sometimes',
            'mata_pelajaran_opt'        =>  'sometimes',
            'catatan'                   =>  'sometimes',
            'status'                    =>  'required',

            // kertas peperiksaan
            'no_kertas_peperiksaan'     => 'sometimes',
            'kod_kertas_peperiksaan'    => 'required_with:no_kertas_peperiksaan',
            'nama_kertas_peperiksaan'   => 'required_with:no_kertas_peperiksaan',
            'markah_maksimum_kertas'    => 'required_with:no_kertas_peperiksaan',
            'skala_kertas'              => 'required_with:no_kertas_peperiksaan',
            'jenis_kertas'              => 'required_with:no_kertas_peperiksaan',
            'status_pilihan_kertas'     => 'required_with:no_kertas_peperiksaan',
            'kertas_hurdle_opt'         => 'required_with:no_kertas_peperiksaan',
            'kertas_matriks_opt'        => 'required_with:no_kertas_peperiksaan',
            'gred_kertas_opt'           => 'required_with:no_kertas_peperiksaan',
            'masa_mula_peperiksaan'     => 'required_with:no_kertas_peperiksaan',
            'masa_tamat_peperiksaan'    => 'required_with:no_kertas_peperiksaan|after:masa_mula_peperiksaan',
            'bahasa_kertas_opt'         => 'required_with:no_kertas_peperiksaan',
            'jenis_semakan_opt'         => 'required_with:no_kertas_peperiksaan',
            'jenis_mesyuarat_opt'       => 'required_with:no_kertas_peperiksaan',
            'penentuan_standard_opt'    => 'required_with:no_kertas_peperiksaan',
            'kegunaan_lpm'              => 'required_with:no_kertas_peperiksaan',
            'calon'                     => 'required_with:no_kertas_peperiksaan',
            'catatan_kertas'            => 'required_with:no_kertas_peperiksaan',
        ];
    }

    public function response(array $errors)
    {
        return new JsonResponse(['errors' => $errors],200);
    }
}
