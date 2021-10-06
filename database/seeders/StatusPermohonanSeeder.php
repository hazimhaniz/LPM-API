<?php

namespace Database\Seeders;

use App\Models\Status\StatusPermohonan;
use Illuminate\Database\Seeder;

class StatusPermohonanSeeder extends Seeder
{
    public function run()
    {
        if(StatusPermohonan::get()->count() == 0){

            StatusPermohonan::insert([
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
