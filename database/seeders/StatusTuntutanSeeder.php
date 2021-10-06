<?php

namespace Database\Seeders;

use App\Models\Status\StatusTuntutan;
use Illuminate\Database\Seeder;

class StatusTuntutanSeeder extends Seeder
{
    public function run()
    {
        if(StatusTuntutan::get()->count() == 0){

            StatusTuntutan::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'LULUS',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'TIDAK LULUS',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
