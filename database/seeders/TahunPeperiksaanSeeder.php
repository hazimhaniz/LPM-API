<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Peperiksaan\TahunPeperiksaan;
use Illuminate\Database\Seeder;

class TahunPeperiksaanSeeder extends Seeder
{
    public function run()
    {
        // check if table app is empty
        if(TahunPeperiksaan::get()->count() == 0)
        {
            TahunPeperiksaan::insert([
                [
                    'id_peperiksaan' => 1,
                    'id_status_tahun' => 2,
                    'tahun' => 2018,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan' => 1,
                    'id_status_tahun' => 2,
                    'tahun' => 2019,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan' => 1,
                    'id_status_tahun' => 2,
                    'tahun' => 2020,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan' => 1,
                    'id_status_tahun' => 1,
                    'tahun' => 2021,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan' => 2,
                    'id_status_tahun' => 2,
                    'tahun' => 2018,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan' => 2,
                    'id_status_tahun' => 2,
                    'tahun' => 2019,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan' => 2,
                    'id_status_tahun' => 2,
                    'tahun' => 2020,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'id_peperiksaan' => 2,
                    'id_status_tahun' => 1,
                    'tahun' => 2021,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
            ]);

        }
    }
}
