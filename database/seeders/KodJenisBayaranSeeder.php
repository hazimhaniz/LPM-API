<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\JenisBayaran;
use Illuminate\Database\Seeder;

class KodJenisBayaranSeeder extends Seeder
{
    public function run()
    {
        // check if table jenis bayaran is empty
        if(JenisBayaran::get()->count() == 0){

            JenisBayaran::insert([

                // Pindah Pusat Peperiksaan
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'PPP',
                    'keterangan'            => 'Pindah Pusat Peperiksaan',
                    'jumlah'                => 25,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Yuran Peperiksaan
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'YP_BA',
                    'keterangan'            => 'Yuran Peperiksaan - Bayaran Asas',
                    'jumlah'                => 50,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'YP_MP',
                    'keterangan'            => 'Yuran Peperiksaan - Mata Pelajaran',
                    'jumlah'                => 25,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'YP_BP',
                    'keterangan'            => 'Yuran Peperiksaan - Bayaran Pengurusan (Luar Negara)',
                    'jumlah'                => 200,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Pembetulan Maklumat Calon
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'PMC',
                    'keterangan'            => 'Pembetulan Maklumat Calon',
                    'jumlah'                => 30,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Pembetulan Maklumat Mata Pelajaran
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'PMMP',
                    'keterangan'            => 'Pembetulan Maklumat Mata Pelajaran',
                    'jumlah'                => 30,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Semakan Semuala Mata Pelajaran
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'SSMP',
                    'keterangan'            => 'Semakan Semuala Mata Pelajaran',
                    'jumlah'                => 100,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Salinan Keputusan Peperiksaan
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'SKP',
                    'keterangan'            => 'Salinan Keputusan Peperiksaan',
                    'jumlah'                => 30,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Bayaran Salinan Terjemahan Keptusan Ke bahasa Inggeris
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'BSTKKBI',
                    'keterangan'            => 'Bayaran Salinan Terjemahan Keptusan Ke bahasa Inggeris',
                    'jumlah'                => 10,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Bayaran Calon Lewat Daftar
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'BCLD',
                    'keterangan'            => 'Bayaran Calon Lewat Daftar',
                    'jumlah'                => 30,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Bayaran Pengesahan Keputusan peperiksaan
                [
                    'id_peperiksaan'        => 2,
                    'kod_jenis_bayaran'     => 'BPKP',
                    'keterangan'            => 'Bayaran Pengesahan Keputusan peperiksaan',
                    'jumlah'                => 50,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                 // Yuran Peperiksaan pt3
                 [
                    'id_peperiksaan'        => 1,
                    'kod_jenis_bayaran'     => 'YP_BA',
                    'keterangan'            => 'Yuran Peperiksaan - Bayaran Asas',
                    'jumlah'                => 65,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                 // Bayaran Calon Lewat Daftar pt3
                 [
                    'id_peperiksaan'        => 1,
                    'kod_jenis_bayaran'     => 'BCLD',
                    'keterangan'            => 'Bayaran Calon Lewat Daftar',
                    'jumlah'                => 150,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                 // Pembetulan Maklumat Calon pt3
                [
                    'id_peperiksaan'        => 1,
                    'kod_jenis_bayaran'     => 'PMC',
                    'keterangan'            => 'Pembetulan Maklumat Calon',
                    'jumlah'                => 30,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                // Pembetulan Maklumat Mata Pelajaran pt3
                [
                    'id_peperiksaan'        => 1,
                    'kod_jenis_bayaran'     => 'PMMP',
                    'keterangan'            => 'Pembetulan Maklumat Mata Pelajaran',
                    'jumlah'                => 30,
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

            ]);

        }
    }
}
