<?php

namespace Database\Seeders;

use App\Models\Status\StatusJanaan;
use Illuminate\Database\Seeder;

class StatusJanaanSeeder extends Seeder
{
    public function run()
    {
        if(StatusJanaan::get()->count() == 0){

            StatusJanaan::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'TELAH DIJANA',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'BELUM DIJANA',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
