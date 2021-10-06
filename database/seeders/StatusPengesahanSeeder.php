<?php

namespace Database\Seeders;

use App\Models\Status\StatusPengesahan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPengesahanSeeder extends Seeder
{
    public function run()
    {

        DB::table('status__status_pengesahan')->truncate();
        StatusPengesahan::insert([
            [
                'id'                    => 1,
                'keterangan'            => 'SAH',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 2,
                'keterangan'            => 'BELUM DISAHKAN',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 3,
                'keterangan'            => 'DALAM PENGESAHAN',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 4,
                'keterangan'            => 'DALAM PENGESAHAN JPN',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 5,
                'keterangan'            => 'DALAM PENGESAHAN PENGARAH JPN',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 6,
                'keterangan'            => 'DALAM PENGESAHAN PENGETUA SEKOLAH',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 7,
                'keterangan'            => 'DALAM PENGESAHAN UMPK',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 8,
                'keterangan'            => 'DALAM PENGESAHAN JPN ASAL',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 9,
                'keterangan'            => 'DALAM PENGESAHAN JPN BARU',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 10,
                'keterangan'            => 'DALAM PENGESAHAN SUP BARU',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
            [
                'id'                    => 11,
                'keterangan'            => 'DALAM PENGESAHAN KPP UPU',
                'created_at'            => date('Y-m-d H:i:s'),
                'updated_at'            => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
