<?php

namespace Database\Seeders;

use App\Models\Status\StatusAgihan;
use Illuminate\Database\Seeder;

class StatusAgihanSeeder extends Seeder
{
    public function run()
    {
        if(StatusAgihan::get()->count() == 0){

            StatusAgihan::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'Ya',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'TIDAK',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
