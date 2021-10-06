<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\JadualKerja;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JadualKerjaSeeder extends Seeder
{
    public function run()
    {
        JadualKerja::truncate();

        // stam
        collect($this->listKeterangan())
            ->each(fn($keterangan, $key) => JadualKerja::create([
                'id_tahun_peperiksaan'  => 8,
                'keterangan'            => $keterangan,
                'status'                => true,
                'tarikh_mula'           => $key == 0 ? Carbon::createFromFormat("d/m/Y", "01/01/2021") : Carbon::createFromFormat("d/m/Y", "02/03/2021"),
                'tarikh_tamat'          => $key == 0 ? Carbon::createFromFormat("d/m/Y", "01/03/2021") : Carbon::createFromFormat("d/m/Y", mt_rand(2, 28). "/" .mt_rand(3, 12). "/2021")
            ]));

        // pt3
        $datas = fopen(base_path("storage/app/public/csv/peperiksaan__jadual_kerja_pt3.csv"), "r");

        while (($data = fgetcsv($datas, 2000, ",")) !== FALSE) {
            JadualKerja::create([
                'id_tahun_peperiksaan'  => $data[0],
                'keterangan'            => $data[1],
                'status'                => $data[4],
                'tarikh_mula'           => Carbon::createFromFormat("d/m/Y h:i", $data[2]),
                'tarikh_tamat'          => Carbon::createFromFormat("d/m/Y h:i", $data[3]),
            ]);
        }
        fclose($datas);
    }

    function listKeterangan(){

        return [
            "Penyelenggaraan Data",
            "Pendaftaran Calon Sekolah",
            "Pendaftaran Calon Persendirian",
            "Pengesahan Calon Sekolah",
            "Pemprosesan dan Pengesahan Calon Persendirian",
            "Penyelenggaraan Tindakan Khas",
            "Pengecualian Kertas Lisan (Calon Tiada Kecacatan)",
            "Pengemaskinian Pendaftaran",
            "Permohonan Perpindahan Calon",
            "Permohonan Perpindahan Calon Dalam Negeri dan Ke Negeri Lain",
            "Permohonan Perpindahan Calon Dari Negeri Lain",
            "Permohonan Pindah Menumpang",
            "Pengesahan Pindah Menumpang",
            "Permohonan Pembetulan Maklumat",
            "Pengesahan Pembetulan Maklumat",
            "Permohonan Pembatalan Pendaftaran",
            "Pengesahan Pembatalan Pendaftaran",
            "Pengesahan Pemeriksa",
            "Balasan Pemeriksa",
            "Peruntuksan Skrip Pemeriksa",
            "Penilaian Pemeriksa",
            "Kemasukan Markah Pemeriksa",
            "Kemasukan Markah JPN",
            "Kemasukan Markah Sekolah",
            "Kemasukan Markah Sekolah - KBT",
            "Pengeluaran Keputusan",
            "Semakan Permohonan Online",
            "Penyelenggaraan dan Penampatan Makmal/Sidang",
            "Cetakan Permohonan Pelantikan Pemeriksan",
        ];
    }
}
