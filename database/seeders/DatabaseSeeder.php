<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                PeperiksaanSeeder::class,
                TahunPeperiksaanSeeder::class,
                KodAgamaSeeder::class,
                KodJantinaSeeder::class,
                KodKemasukanSeeder::class,
                KodKeturunanSeeder::class,
                KodJenisCalonSeeder::class,
                KodMataPelajaranSeeder::class,
                KodWarganegaraSeeder::class,
                KodJenisBayaranSeeder::class,
                KodKeperluanKhasSeeder::class,
                NegaraSeeder::class,
                DaerahSeeder::class,
                BandarSeeder::class,
                DUNSeeder::class,
                ParlimenSeeder::class,
                NegeriSeeder::class,
                PPDSeeder::class,
                KodPusatSeeder::class,
                KodSekolahSeeder::class,
                JenisPendaftaranSeeder::class,
                KodJenisSekolahSeeder::class,
                KodPusatSeeder::class,
                KodJenisDokumenSeeder::class,
                JadualKerjaSeeder::class,
                StatusAgihanSeeder::class,
                StatusJanaanSeeder::class,
                StatusKelayakanSeeder::class,
                StatusKeputusanSemakSeeder::class,
                StatusLengkapSeeder::class,
                StatusPelawaanSeeder::class,
                StatusPembayaranSeeder::class,
                StatusPembetulanSeeder::class,
                StatusPemeriksaLainSeeder::class,
                StatusPendaftaranSeeder::class,
                StatusPengesahanSeeder::class,
                StatusPermohonanPertamaSeeder::class,
                StatusPermohonanSeeder::class,
                StatusSalahLakuSeeder::class,
                StatusSeeder::class,
                StatusTahunSeeder::class,
                StatusTuntutanSeeder::class,
                StatusKelulusanSeeder::class,
                StatusTempohPendaftaranSeeder::class,
                UsersPermissionsSeeder::class,
                UsersRolesSeeder::class,
                UsersSeeder::class

            ]
        );
    }
}
