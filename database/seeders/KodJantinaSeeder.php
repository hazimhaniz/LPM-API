<?php

namespace Database\Seeders;

use App\Models\Constant\Jantina;
use Illuminate\Database\Seeder;

class KodJantinaSeeder extends Seeder
{
    public function run()
    {
        // check if table kod jantina is empty
        if(Jantina::get()->count() == 0){

            Jantina::insert([
                [
                    'kod_jantina'           => 1,
                    'keterangan'            => 'LELAKI',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'kod_jantina'           => 2,
                    'keterangan'            => 'PEREMPUAN',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
