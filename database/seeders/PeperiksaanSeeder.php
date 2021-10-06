<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\Peperiksaan;
use Illuminate\Database\Seeder;

class PeperiksaanSeeder extends Seeder
{
    public function run()
    {
        // check if table kod peperiksaan is empty
        if(Peperiksaan::get()->count() == 0)
        {
            Peperiksaan::insert([
                [
                    'id'                            => 1,
                    'kod_peperiksaan'               => Peperiksaan::KOD_PEPERIKSAAN_PT3,
                    'keterangan'                    => 'PT3',
                    'keterangan_panjang'            => 'PENTAKSIRAN TINGKATAN TIGA',
                    'id_tahun_peperiksaan_semasa'   => 4,
                    'status'                        => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                    'updated_at'                    => date('Y-m-d H:i:s')
                ],
                [
                    'id'                            => 2,
                    'kod_peperiksaan'               => Peperiksaan::KOD_PEPERIKSAAN_STAM,
                    'keterangan_panjang'            => 'SIJIL TINGGI AGAMA MALAYSIA',
                    'keterangan'                    => 'STAM',
                    'id_tahun_peperiksaan_semasa'   => 8,
                    'status'                        => 1,
                    'created_at'                    => date('Y-m-d H:i:s'),
                    'updated_at'                    => date('Y-m-d H:i:s')
                ],
            ]);
        }
    }
}
