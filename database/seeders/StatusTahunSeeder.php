<?php

namespace Database\Seeders;

use App\Models\Status\StatusTahun;
use Illuminate\Database\Seeder;

class StatusTahunSeeder extends Seeder
{
    public function run()
    {
        if(StatusTahun::get()->count() == 0){

            StatusTahun::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'SEMASA',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'LEPAS',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 3,
                    'keterangan'            => 'AKAN DATANG',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
