<?php

namespace Database\Seeders;

use App\Models\Dokumen\RefDokumen\JenisDokumen;
use Illuminate\Database\Seeder;

class KodJenisDokumenSeeder extends Seeder
{
    public function run()
    {
        JenisDokumen::truncate();

        JenisDokumen::insert([
            [
                'keterangan'            => 'Salinan Kad Pengenalan',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => 'Salinan Pasport',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => 'Salinan Sijil Kelahiran',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => 'Resit Bayaran Levi',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => 'Visa Pelajar',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => 'Kad Pelajar',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => 'Surat Kemasukan Sekolah',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => 'Salinan Sijil Pelajaran Malaysia (SPM)',
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => "Salinan kokurikulum Ma'ahad Bu'uth Al-Azhar Al-Syarif",
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => "Salinan surat ibu bapa",
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => "Salinan surat pengetua",
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => "Surat Doktor",
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => "Surat Akuan Ibu Bapa",
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'keterangan'            => "Sijil Kematian",
                'status'                => 1,
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
