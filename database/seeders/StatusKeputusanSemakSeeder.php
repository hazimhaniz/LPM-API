<?php

namespace Database\Seeders;

use App\Models\Status\StatusKeputusanSemak;
use Illuminate\Database\Seeder;

class StatusKeputusanSemakSeeder extends Seeder
{
    public function run()
    {
        if(StatusKeputusanSemak::get()->count() == 0){

            StatusKeputusanSemak::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'KEKAL',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'BERUBAH',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
