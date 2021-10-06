<?php

namespace Database\Seeders;

use App\Models\Status\StatusKelayakan;
use Illuminate\Database\Seeder;

class StatusKelayakanSeeder extends Seeder
{
    public function run()
    {
        if(StatusKelayakan::get()->count() == 0){

            StatusKelayakan::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'LAYAK',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'TIDAK LAYAK',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
