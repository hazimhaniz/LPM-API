<?php

namespace Database\Seeders;

use App\Models\Status\StatusPembayaran;
use Illuminate\Database\Seeder;

class StatusPembayaranSeeder extends Seeder
{
    public function run()
    {
        if(StatusPembayaran::get()->count() == 0){

            StatusPembayaran::insert([
                [
                    'id'                    => 1,
                    'keterangan'            => 'BAYAR',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'id'                    => 2,
                    'keterangan'            => 'BELUM BAYAR',
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
