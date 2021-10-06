<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\JenisKemasukan;
use Illuminate\Database\Seeder;

class KodKemasukanSeeder extends Seeder
{
    public function run()
    {
        // check if table kod kemasukan is empty
        if(JenisKemasukan::get()->count() == 0){

            JenisKemasukan::insert([
                [
                    'id'                    => 1,
                    'kod_kemasukan'         => 'K',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'kod_kemasukan'         => 'K',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH BANTUAN KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 3,
                    'kod_kemasukan'         => 'K',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH AGAMA BANTUAN KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 4,
                    'kod_kemasukan'         => 'L',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH AGENSI KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 5,
                    'kod_kemasukan'         => 'M',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH MENENGAH AGAMA NEGERI',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 6,
                    'kod_kemasukan'         => 'N',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH SWASTA BERDAFTAR DENGAN KPM',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 7,
                    'kod_kemasukan'         => 'S',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH SWASTA TIDAK BERDAFTAR',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 8,
                    'kod_kemasukan'         => 'R',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH MENENGAH AGAMA RAKYAT',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 9,
                    'kod_kemasukan'         => 'T',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH INTEGRITI / ASRAMA AKHLAK / TUNAS BAKTI',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 10,
                    'kod_kemasukan'         => 'P',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'CALON PERSENDIRIAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 11,
                    'kod_kemasukan'         => '8',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'CALON MENGULANG',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 12,
                    'kod_kemasukan'         => '9',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'CALON BAHARU',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ]
            ]);

        }
    }
}
