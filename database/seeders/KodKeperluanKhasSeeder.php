<?php

namespace Database\Seeders;

use App\Models\Calon\RefCalon\JenisKeperluanKhas;
use Illuminate\Database\Seeder;

class KodKeperluanKhasSeeder extends Seeder
{
    public function run()
    {
        // check if table kod calon keperluan khas is empty
        if(JenisKeperluanKhas::get()->count() == 0){

            JenisKeperluanKhas::insert([
                [
                    'kod_jenis_keperluan_khas'  => 'A',
                    'keterangan'                => 'MASALAH PEMBELAJARAN',
                    'status'                    => 1,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_keperluan_khas'  => 'B',
                    'keterangan'                => 'KURANG UPAYA PENGLIHATAN (BUTA)',
                    'status'                    => 1,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_keperluan_khas'  => 'C',
                    'keterangan'                => 'KURANG UPAYA PELBAGAI',
                    'status'                    => 1,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_keperluan_khas'  => 'D',
                    'keterangan'                => 'KURANG UPAYA PERTUTURAN',
                    'status'                    => 1,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_keperluan_khas'  => 'F',
                    'keterangan'                => 'KURANG UPAYA FIZIKAL',
                    'status'                    => 1,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_keperluan_khas'  => 'P',
                    'keterangan'                => 'KURANG UPAYA PENDENGARAN',
                    'status'                    => 1,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jenis_keperluan_khas'  => 'R',
                    'keterangan'                => 'KURANG UPAYA PENGLIHATAN (RABUN)',
                    'status'                    => 1,
                    'created_at'                => date('Y-m-d H:i:s'),
                    'updated_at'                => date('Y-m-d H:i:s')
                ],

            ]);
        }
    }
}
