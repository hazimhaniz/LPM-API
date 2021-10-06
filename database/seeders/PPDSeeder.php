<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\PPD;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PPDSeeder extends Seeder
{
    public function run()
    {
        $data = Storage::get('public/json/data_ppd.json');

        if(PPD::first()){
            collect(json_decode($data))->each(fn($ppd) =>  
                PPD:: updateOrCreate([
                    'id' => $ppd->id
                ],[
                    'kod_ppd'       => $ppd->kod_ppd,
                    'nama_ppd'      => $ppd->nama_ppd,
                    'id_negeri'     => $ppd->id_negeri,
                    'status'        => $ppd->status,
                    'created_at'    => now(),
                    'updated_at'    => now()
                ])
            );
        }else{
            collect(json_decode($data))->each(fn($ppd) => PPD::create(collect($ppd)->toArray()));
        }
    }
}
