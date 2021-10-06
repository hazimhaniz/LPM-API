<?php

namespace Database\Seeders;

use App\Models\Status\StatusTempohPendaftaran;
use Illuminate\Database\Seeder;

class StatusTempohPendaftaranSeeder extends Seeder
{
    public function run()
    {
        if(StatusTempohPendaftaran::get()->count() == 0){

            StatusTempohPendaftaran::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'PENDAFTARAN DALAM TEMPOH',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'PENDAFTARAN LUAR TEMPUH',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
