<?php

namespace Database\Seeders;

use App\Models\Constant\Negeri;
use Illuminate\Database\Seeder;

class NegeriSeeder extends Seeder
{
    public function run()
    {
        // check if table negeri is empty
        if(Negeri::get()->count() == 0){

            Negeri::insert([
                [
                    'id' => 1,
                    'kod_negeri' => 'jhr',
                    'keterangan' => 'JOHOR',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'kod_negeri' => 'kdh',
                    'keterangan' => 'KEDAH',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'kod_negeri' => 'ktn',
                    'keterangan' => 'KELANTAN',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'kod_negeri' => 'mlk',
                    'keterangan' => 'MELAKA',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'kod_negeri' => 'nsn',
                    'keterangan' => 'NEGERI SEMBILAN',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'kod_negeri' => 'phg',
                    'keterangan' => 'PAHANG',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'kod_negeri' => 'png',
                    'keterangan' => 'PULAU PINANG',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 8,
                    'kod_negeri' => 'prk',
                    'keterangan' => 'PERAK',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 9,
                    'kod_negeri' => 'pls',
                    'keterangan' => 'PERLIS',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 10,
                    'kod_negeri' => 'sgr',
                    'keterangan' => 'SELANGOR',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 11,
                    'kod_negeri' => 'trg',
                    'keterangan' => 'TERENGGANU',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 12,
                    'kod_negeri' => 'sbh',
                    'keterangan' => 'SABAH',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 13,
                    'kod_negeri' => 'swk',
                    'keterangan' => 'SARAWAK',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 14,
                    'kod_negeri' => 'kul',
                    'keterangan' => 'W.P KUALA LUMPUR',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 15,
                    'kod_negeri' => 'lbn',
                    'keterangan' => 'W.P LABUAN',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 16,
                    'kod_negeri' => 'pjy',
                    'keterangan' => 'W.P PUTRAJAYA',
                    'status' => true,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]
            ]);

        }
    }
}
