<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\JenisCalon;
use Illuminate\Database\Seeder;

class KodJenisCalonSeeder extends Seeder
{
    public function run()
    {
        // check if table jenis calon is empty
        if(JenisCalon::get()->count() == 0){

            JenisCalon::insert([

                [
                    'kod_jenis_calon'       => 'K',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Sekolah Kerajaan, Sekolah Bantuan Kerajaan dan Sekolah Agama Bantuan Kerajaan',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'L',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Sekolah di bawah agensi Kerajaan selain Kementerian Pendidikan Malaysia. Sebagai contoh: Maktab Rendah Sains MARA (MRSM)',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'M',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Sekolah Menengah Agama Negeri',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'N',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Sekolah Swasta yang berdaftar dengan Kementerian Pendidikan Malaysia',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'P',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Persendirian ',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'R',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Sekolah Menengah Agama Rakyat',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                [
                    'kod_jenis_calon'       => 'S',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Sekolah Swasta yang tidak berdaftar dengan Kementerian Pendidikan Malaysia',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'T',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'Calon Sekolah Integriti/ Asrama Akhlak/ Tunas Bakti/ Jalinan Kasih',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                [
                    'kod_jenis_calon'       => 'S',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon sekolah kerajaan, Sekolah Bantuan Kerajaan dan Sekolah Agama Bantuan Kerajaan',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'T',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon Sekolah Menengah Agama Negeri',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'V',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon Sekolah Menengah Agama Rakyat',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'W',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon Sekolah Swasta yang berdaftar dengan Kementerian Pendidikan',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_calon'       => 'X',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon persendirian',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);

        }
    }
}
