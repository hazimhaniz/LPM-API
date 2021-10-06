<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class KodPusatSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // STAM
        $data = Storage::get('public/json/data_pusat.json');

        // check if table pusat is empty
        if(Pusat::first()){
            collect(json_decode($data))->each(fn($pusat) =>  
                Pusat:: updateOrCreate([
                    'id' => $pusat->id
                ],[
                    "no_sekolah"                        => $pusat->no_sekolah,
                    "kod_pusat"                         => $pusat->kod_pusat,
                    "id_jenis_calon"                    => $pusat->id_jenis_calon,
                    "nama_pusat"                        => $pusat->nama_pusat,
                    "nama_pusat_i18n"                   => codepoint_decode($pusat->nama_pusat_i18n),
                    "jumlah_calon"                      => $pusat->jumlah_calon,
                    "id_sekolah"                        => $pusat->id_sekolah,
                    "id_tahun_peperiksaan"              => $pusat->id_tahun_peperiksaan,
                    "id_bilik_kebal"                    => (int) $pusat->id_bilik_kebal ?? null,
                    "ids_mata_pelajaran"                => $pusat->ids_mata_pelajaran,
                    "id_status_pendaftaran"             => $pusat->id_status_pendaftaran,
                    "id_status_pendaftaran_calon"       => $pusat->id_status_pendaftaran_calon,
                    "id_status_janaan_angka_giliran"    => $pusat->id_status_janaan_angka_giliran,
                    "id_status_tempoh_pendaftaran"      => $pusat->id_status_tempoh_pendaftaran,
                    "status"                            => $pusat->status,
                    "created_at"                        => now(),
                    "updated_at"                        => now()
                ])
            );
        } else {
            // stam only
            collect(json_decode($data))->each(fn($pusat) => Pusat::create(collect($pusat)->toArray()));

            // for pt3 still using manual way
            Pusat::insert([
                // PT3
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JB558",
                    'id_jenis_calon'        => 11,
                    'nama_pusat'            => "ACADEMY DARUL HUFFAZ JOHOR",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 250,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JB509",
                    'id_jenis_calon'        => 11,
                    'nama_pusat'            => "MADRASAH TAHFIZ AL-IMAN",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 300,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JB521",
                    'id_jenis_calon'        => 11,
                    'nama_pusat'            => "MADRASAH TAHFIZ HUDA AL-ISLAM",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 63,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JK145",
                    'id_jenis_calon'        => 9,
                    'nama_pusat'            => "MAKTAB RENDAH SAINS MARA JOHOR BAHRU",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 15,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JE033",
                    'id_jenis_calon'        => 9,
                    'nama_pusat'            => "MAKTAB RENDAH SAINS MARA, MERSING",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 435,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JF111",
                    'id_jenis_calon'        => 9,
                    'nama_pusat'            => "MAKTAB RENDAH SAINS MARA, MUAR",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 321,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JG057",
                    'id_jenis_calon'        => 9,
                    'nama_pusat'            => "MAKTAB RENDAH SAINS MARA, TUN DR ISMAIL PONTIAN",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 321,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JB021",
                    'id_jenis_calon'        => 7,
                    'nama_pusat'            => "MAKTAB SULTAN ABU BAKAR",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 321,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JA093",
                    'id_jenis_calon'        => 9,
                    'nama_pusat'            => "MRSM BATU PAHAT",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 431,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JR001",
                    'id_jenis_calon'        => 10,
                    'nama_pusat'            => "PUSAT PERSENDIRIAN PT3 NEGERI JOHOR",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 20,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'=> '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JK125",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SABK MADRASAH ALATTAS ALARABIAH JOHOR",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 213,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JA111",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SEK MEN AGAMA ATTARBIAH AL-ISLAMIAH BATU PAHAT",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 143,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JB549",
                    'id_jenis_calon'        => 6,
                    'nama_pusat'            => "SEK MEN SRI TENBY SETIA ECO GARDENS",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 431,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JG049",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SEKOLAH MAAHAD PONTIAN",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 130,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JG069",
                    'id_jenis_calon'        => 11,
                    'nama_pusat'            => "SEKOLAH MENENGAH (ARAB) BUGISIAH, TAMPOK",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 131,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JF101",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SEKOLAH MENENGAH AGAMA ADDINIAH PARIT SUBARI",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 99,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JE041",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SEKOLAH MENENGAH AGAMA AL-KHAIRIAH AL-ISLAMIAH MERSING",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 154,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JH097",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SEKOLAH MENENGAH AGAMA AL-KHAIRIAH SEGAMAT",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 550,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JB285",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SEKOLAH MENENGAH AGAMA AL-QURAN WADDIN",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 351,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JC501",
                    'id_jenis_calon'        => 8,
                    'nama_pusat'            => "SEKOLAH MENENGAH AGAMA ARABIAH KLUANG",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 432,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "JB566",
                    'id_jenis_calon'        => 13,
                    'nama_pusat'            => "SEKOLAH INTEGRITI KLUANG",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 56,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],

                //selangor
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "BD508",
                    'id_jenis_calon'        => 2,
                    'nama_pusat'            => "AKADEMI DARUL HUFFAZ",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 50,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 45, 50, 55, 71]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "BA505",
                    'id_jenis_calon'        => 7,
                    'nama_pusat'            => "BEACONHOUSE SRI LETHIA",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 50,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 17, 15]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "BA503",
                    'id_jenis_calon'        => 1,
                    'nama_pusat'            => "MA'AHAD TAHFIZ AT TIJARAH",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 50,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 17, 15]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ],
                [
                    'no_sekolah'            => 1,
                    'kod_pusat'             => "BA500",
                    'id_jenis_calon'        => 1,
                    'nama_pusat'            => "MAAHAD IHYA AL-AHMADI",
                    'nama_pusat_i18n'       => null,
                    'id_sekolah'            => 0,
                    'jumlah_calon'          => 50,
                    'id_tahun_peperiksaan'  => 4,
                    'ids_mata_pelajaran'    => '[2, 3, 4, 12, 14, 21, 23, 17, 15]',
                    'status'                => 1,
                    'created_at'            => date('Y-m-d H:i:s'),
                    'updated_at'            => date('Y-m-d H:i:s')
                ]
            ]);
        }
    }
}
