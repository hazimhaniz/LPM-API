<?php

namespace Database\Seeders;

use App\Models\Status\StatusKelulusan;
use Illuminate\Database\Seeder;

class StatusKelulusanSeeder extends Seeder
{
    public function run()
    {
        if(StatusKelulusan::get()->count() == 0){

            StatusKelulusan::insert([
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
