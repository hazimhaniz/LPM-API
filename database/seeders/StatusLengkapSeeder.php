<?php

namespace Database\Seeders;

use App\Models\Status\StatusLengkap;
use Illuminate\Database\Seeder;

class StatusLengkapSeeder extends Seeder
{
    public function run()
    {
        if(StatusLengkap::get()->count() == 0){

            StatusLengkap::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'LENGKAP',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'TIDAK LENGKAP',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
