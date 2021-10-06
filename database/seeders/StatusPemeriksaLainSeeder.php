<?php

namespace Database\Seeders;

use App\Models\Status\StatusPemeriksaLain;
use Illuminate\Database\Seeder;

class StatusPemeriksaLainSeeder extends Seeder
{
    public function run()
    {
        if(StatusPemeriksaLain::get()->count() == 0){

            StatusPemeriksaLain::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'YA',
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
