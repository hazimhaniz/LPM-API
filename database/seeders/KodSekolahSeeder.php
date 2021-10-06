<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class KodSekolahSeeder extends Seeder
{
    public function run()
    {
        $data = Storage::get('public/json/data_sekolah.json');
        logger($data);
        // check if table pusat is empty
        if(Sekolah::first()){
            collect(json_decode($data))->each(fn($sekolah) =>  

                Sekolah:: updateOrCreate([
                    'id' => $sekolah->id
                ],[
                    'kod_sekolah'                   => $sekolah->kod_sekolah,
                    'nama_sekolah'                  => $sekolah->nama_sekolah,
                    'nama_pengetua'                 => $sekolah->nama_pengetua,
                    'alamat_sekolah'                => $sekolah->alamat_sekolah,
                    'emel_sekolah'                  => $sekolah->emel_sekolah,
                    'no_telefon'                    => $sekolah->no_telefon,
                    'no_faks'                       => $sekolah->no_faks,
                    'poskod'                        => $sekolah->poskod,
                    'id_jenis_sekolah'              => $sekolah->id_jenis_sekolah,
                    'id_ppd'                        => $sekolah->id_ppd,
                    'id_bandar'                     => $sekolah->id_bandar,
                    'id_daerah'                     => $sekolah->id_daerah,
                    'id_negeri'                     => $sekolah->id_negeri,
                    'status'                        => $sekolah->status,
                ])
            );
        }else {

            // stam only
            collect(json_decode($data))->each(fn($sekolah) => Sekolah::create(collect($sekolah)->toArray()));
        }
    }
}
