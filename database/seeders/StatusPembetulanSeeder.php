<?php

namespace Database\Seeders;

use App\Models\Status\StatusPembetulan;
use Illuminate\Database\Seeder;

class StatusPembetulanSeeder extends Seeder
{
    public function run()
    {
        if(StatusPembetulan::get()->count() == 0){

            StatusPembetulan::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'PERLU',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'TIDAK PERLU',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
