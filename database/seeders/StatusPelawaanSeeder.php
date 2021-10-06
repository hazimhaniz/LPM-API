<?php

namespace Database\Seeders;

use App\Models\Status\StatusPelawaan;
use Illuminate\Database\Seeder;

class StatusPelawaanSeeder extends Seeder
{
    public function run()
    {
        if(StatusPelawaan::get()->count() == 0){

            StatusPelawaan::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'MENERIMA',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'MENOLAK',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
