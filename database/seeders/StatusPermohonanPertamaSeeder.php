<?php

namespace Database\Seeders;

use App\Models\Status\StatusPermohonanPertama;
use Illuminate\Database\Seeder;

class StatusPermohonanPertamaSeeder extends Seeder
{
    public function run()
    {
        if(StatusPermohonanPertama::get()->count() == 0){

            StatusPermohonanPertama::insert([
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
