<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class convertCsvToJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert Csv file to Json';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path           = 'public/csv/ref_peperiksaan__';
        $inputFileName  = Collection::make(['kod_ppd','kod_pusat','kod_sekolah']);
        $format         = '.csv';

        collect($inputFileName)->each(function($fileName) use($path, $format) {

            $file = Storage::get($path.$fileName.$format);
            $array = array_map("str_getcsv", explode("\n", $file));
            
            if($fileName == 'kod_ppd'){

                $items = [];
                foreach ($array as $key => $item) {
                    if($item[0] != null){
                        array_push($items, [
                            'id'        => $item[0],
                            'kod_ppd'   => $item[1] ?? null,
                            'nama_ppd'  => $item[2] ?? null,
                            'id_negeri' => $item[3] ?? null,
                            'status'    => $item[4] ?? null
                        ]);
                    }
                }
                Storage::put('public/json/data_ppd.json',  json_encode($items, JSON_PRETTY_PRINT));
            }

            if($fileName == 'kod_pusat'){
                $items = [];
                foreach ($array as $key => $item) {

                    if($item[8] == 8){
                        $id_jenis_calon = $item[3] == 7 ? 9 : $item[3];
                    }

                    if($key >= 2){
                        array_push($items, [
                            'id'                            => $item[0] ?? null,
                            'no_sekolah'                    => $item[1] ?? null,
                            'kod_pusat'                     => $item[2] ?? null,
                            'id_jenis_calon'                => $id_jenis_calon,
                            'nama_pusat'                    => $item[4] ?? null,
                            'nama_pusat_i18n'               => $item[5] ?? null,
                            'jumlah_calon'                  => $item[6] ?? null,
                            'id_sekolah'                    => $item[7] ?? null,
                            'id_tahun_peperiksaan'          => $item[8] ?? null,
                            'id_bilik_kebal'                => $item[9] == "NULL" ? 0 : 0,
                            'ids_mata_pelajaran'            => $item[10] ?? null,
                            'id_status_pendaftaran'         => 2,
                            'id_status_pendaftaran_calon'   => 3,
                            'id_status_janaan_angka_giliran'=> $item[13] ?? null,
                            'id_status_tempoh_pendaftaran'  => $item[14] ?? null,
                            'status'                        => $item[15] ?? null
                        ]);
                    }
                }
 
                Storage::put('public/json/data_pusat.json',  json_encode($items, JSON_PRETTY_PRINT));
            }

            if($fileName == 'kod_sekolah'){
                $items = [];
                foreach ($array as $key => $item) {

                    if($key >= 1){
                        array_push($items, [
                            'kod_sekolah'                   => $item[1] ?? null,
                            'nama_sekolah'                  => $item[2] ?? null,
                            'nama_pengetua'                 => $item[3] ?? null,
                            'alamat_sekolah'                => $item[4] ?? null,
                            'emel_sekolah'                  => $item[5] ?? null,
                            'no_telefon'                    => $item[6] ?? null,
                            'no_faks'                       => $item[7] ?? null,
                            'poskod'                        => $item[8] ?? null,
                            'id_jenis_sekolah'              => $item[9] ?? null,
                            'id_ppd'                        => $item[10] ?? null,
                            'id_bandar'                     => $item[11] ?? null,
                            'id_daerah'                     => $item[12] ?? null,
                            'id_negeri'                     => $item[13] ?? null,
                            'status'                        => true
                        ]);
                    }
                }
 
                Storage::put('public/json/data_sekolah.json',  json_encode($items, JSON_PRETTY_PRINT));
            }
        });
    }
}
