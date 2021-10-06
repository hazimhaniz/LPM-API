<?php

namespace Database\Seeders;

use App\Models\Status\StatusSalahLaku;
use Illuminate\Database\Seeder;

class StatusSalahLakuSeeder extends Seeder
{
    public function run()
    {
        if(StatusSalahLaku::get()->count() == 0){

            StatusSalahLaku::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'BERSALAH',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'TIDAK BERSALAH',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
