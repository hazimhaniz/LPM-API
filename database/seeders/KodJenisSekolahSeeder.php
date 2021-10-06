<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\JenisSekolah;
use Illuminate\Database\Seeder;

class KodJenisSekolahSeeder extends Seeder
{
    public function run()
    {
        // check if table kod kemasukan is empty
        if(JenisSekolah::get()->count() == 0){

            JenisSekolah::insert([
                [
                    'id'                    => 1,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH BANTUAN KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 3,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH AGAMA BANTUAN KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 4,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH AGENSI KERAJAAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 5,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH MENENGAH AGAMA NEGERI',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 6,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH SWASTA BERDAFTAR DENGAN KPM',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 7,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH SWASTA TIDAK BERDAFTAR',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 8,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH MENENGAH AGAMA RAKYAT',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 9,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 1,
                    'keterangan'            => 'SEKOLAH INTEGRITI / ASRAMA AKHLAK / TUNAS BAKTI',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 10,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon Sekolah Menengah Agama Negeri',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 11,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon Sekolah Menengah Agama Rakyat',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 12,
                    'kod_jenis_sekolah'     => '',
                    'id_peperiksaan'        => 2,
                    'keterangan'            => 'Calon Sekolah Swasta yang berdaftar dengan Kementerian Pendidikan',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 13,
                    'kod_jenis_sekolah'     => '',
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
