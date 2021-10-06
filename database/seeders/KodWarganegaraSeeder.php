<?php

namespace Database\Seeders;

use App\Models\Constant\Warganegara;
use Illuminate\Database\Seeder;

class KodWarganegaraSeeder extends Seeder
{
    public function run()
    {
        // check if table kod warganegara is empty
        if (Warganegara::get()->count() == 0) {

            Warganegara::insert([
                ['kod_warganegara' => '01', 'keterangan' => 'Warganegara', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_warganegara' => '01', 'keterangan' => 'Bukan Warganegara', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ]);
        }
    }
}
