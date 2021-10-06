<?php

namespace Database\Seeders;

use App\Models\Constant\Agama;
use Illuminate\Database\Seeder;

class KodAgamaSeeder extends Seeder
{
    public function run()
    {
        // check if table agama is empty
        if(Agama::count() == 0){

            Agama::insert([
                [
                    'kod_agama'             => '01',
                    'keterangan'            => 'ISLAM',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '02',
                    'keterangan'            => 'KRISTIAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '03',
                    'keterangan'            => 'BUDDHA',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '04',
                    'keterangan'            => 'HINDU',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '05',
                    'keterangan'            => 'SIKHISM',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '06',
                    'keterangan'            => 'TAO',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '07',
                    'keterangan'            => 'KONFUSIANISMA',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '08',
                    'keterangan'            => 'BAHAI',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '10',
                    'keterangan'            => 'TIADA AGAMA / AITISMISME',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '98',
                    'keterangan'            => 'LAIN-LAIN AGAMA',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_agama'             => '99',
                    'keterangan'            => 'TIADA MAKLUMAT',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
