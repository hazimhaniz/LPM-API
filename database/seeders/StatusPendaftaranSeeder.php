<?php

namespace Database\Seeders;

use App\Models\Status\StatusPendaftaran;
use Illuminate\Database\Seeder;

class StatusPendaftaranSeeder extends Seeder
{
    public function run()
    {
        if(StatusPendaftaran::get()->count() == 0){

            StatusPendaftaran::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'TELAH DAFTAR',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'BELUM DAFTAR',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
