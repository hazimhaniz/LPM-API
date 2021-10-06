<?php

namespace Database\Seeders;

use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KodMataPelajaranSeeder extends Seeder
{
    public function run()
    {
        // check if table kod mata pelajaran is empty
        if(MataPelajaran::first()){
            DB::table('ref_peperiksaan__kod_mata_pelajaran')->truncate();
        }else{
            MataPelajaran::insert([
                ['kod_mata_pelajaran' => '02', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA MELAYU (UJIAN BERTULIS)', 'keterangan' => 'BAHASA MELAYU (UJIAN BERTULIS)', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '03', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA MELAYU (UJIAN LISAN)', 'keterangan' => 'BAHASA MELAYU (UJIAN LISAN)', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '04', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA MELAYU (UJIAN KOMUNIKASI)', 'keterangan' => 'BAHASA MELAYU (UJIAN KOMUNIKASI)', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '12', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA INGGERIS', 'keterangan' => 'BAHASA INGGERIS', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '14', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA INGGERIS (UJIAN KOMUNIKASI)', 'keterangan' => 'BAHASA INGGERIS (UJIAN KOMUNIKASI)', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '21', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'SEJARAH', 'keterangan' => 'SEJARAH', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '23', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'GEOGRAFI', 'keterangan' => 'GEOGRAFI', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '31', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA ARAB', 'keterangan' => 'BAHASA ARAB', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '32', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA CINA', 'keterangan' => 'BAHASA CINA', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '33', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA TAMIL', 'keterangan' => 'BAHASA TAMIL', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '34', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA PUNJABI', 'keterangan' => 'BAHASA PUNJABI', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '37', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA IBAN', 'keterangan' => 'BAHASA IBAN', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '38', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA KADAZABDUSUN', 'keterangan' => 'BAHASA KADAZABDUSUN', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '39', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'BAHASA SEMAI', 'keterangan' => 'BAHASA SEMAI', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '45', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'PENDIDIKAN ISLAM', 'keterangan' => 'PENDIDIKAN ISLAM', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '50', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'MATEMATIK', 'keterangan' => 'MATEMATIK', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '55', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'SAINS', 'keterangan' => 'SAINS', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '62', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'SENI VISUAL', 'keterangan' => 'SENI VISUAL', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '63', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'SENI TARI', 'keterangan' => 'SENI TARI', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '64', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'SENI MUZIK', 'keterangan' => 'SENI MUZIK', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '65', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'SENI TEATER', 'keterangan' => 'SENI TEATER', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '70', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'ASAS SAINS KOMPUTER', 'keterangan' => 'ASAS SAINS KOMPUTER', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '71', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'REKA BENTUK DAN TEKNOLOGI', 'keterangan' => 'REKA BENTUK DAN TEKNOLOGI', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '90', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'HIFZ AL-QURAN', 'keterangan' => 'HIFZ AL-QURAN', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '91', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'MAHARAT AL-QURAN', 'keterangan' => 'MAHARAT AL-QURAN', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '96', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'USUL AL-DIN', 'keterangan' => 'USUL AL-DIN', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '97', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'AL-SYARIAH', 'keterangan' => 'AL-SYARIAH', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '98', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'AL-LUGHAH AL-ARABIAH AL-MU\'ASIRAH (BERTULIS)', 'keterangan' => 'AL-LUGHAH AL-ARABIAH AL-MU\'ASIRAH (BERTULIS)', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => '99', 'id_peperiksaan' => 1, 'nama_mata_pelajaran' => 'AL-LUGHAH AL-ARABIAH AL-MU\'ASIRAH (LISAN)', 'keterangan' => 'AL-LUGHAH AL-ARABIAH AL-MU\'ASIRAH (LISAN)', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S101', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'HIFZ AL-QURAN DAN TAJWID', 'keterangan' => 'HIFZ AL-QURAN DAN TAJWID', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S102', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'FIQH', 'keterangan' => 'FIQH', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S103', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'TAUHID DAN MANTIQ', 'keterangan' => 'TAUHID DAN MANTIQ', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S104', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'TAFSIR DAN ULUMUHU', 'keterangan' => 'TAFSIR DAN ULUMUHU', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S105', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'HADITH DAN MUSTOLAH', 'keterangan' => 'HADITH DAN MUSTOLAH', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S106', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'NAHU DAN SARF', 'keterangan' => 'NAHU DAN SARF', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S107', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'INSYA\' DAN MUTALA\'AH', 'keterangan' => 'INSYA\' DAN MUTALA\'AH', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S108', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'ADAB DAN NUSUS', 'keterangan' => 'ADAB DAN NUSUS', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S109', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => '\'ARUDH DAN QAFIYAH', 'keterangan' => '\'ARUDH DAN QAFIYAH', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['kod_mata_pelajaran' => 'S110', 'id_peperiksaan' => 2, 'nama_mata_pelajaran' => 'BALAGHAH', 'keterangan' => 'BALAGHAH', 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
            ]);
        }
    }
}
