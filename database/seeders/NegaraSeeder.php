<?php

namespace Database\Seeders;

use App\Models\Constant\Negara;
use Illuminate\Database\Seeder;

class NegaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Negara::truncate();

        foreach ($this->listNegara() as $key => $negara) {
            Negara::create([
                'kod_negara' => $key < 10 ? str_pad($key, 2, '0', STR_PAD_LEFT) : $key,
                'keterangan' => $negara,
                'status'     => true
            ]);
        }
    }

    public function listNegara(){
        return [
            'MALAYSIA',
            'BRUNEI',
            'FILIPINA',
            'INDONESIA',
            'KEMBOJA',
            'LAOS',
            'MYANMAR',
            'SINGAPURA',
            'THAILAND',
            'VIETNAM',
            'REPUBLIK CHINA',
            'IRAN',
            'SOMALIA',
            'ALGERIA',
            'SYRIA'
        ];
    }
}

