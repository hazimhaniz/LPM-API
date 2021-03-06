<?php

namespace Database\Seeders;

use App\Models\Constant\Daerah;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    public function run()
    {
        // check if table daerah is empty
        if (Daerah::get()->count() == 0) {

            Daerah::insert([
                ['id' => 1, 'kod_daerah' => '0101', 'keterangan' => 'BATU PAHAT', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 2, 'kod_daerah' => '0102', 'keterangan' => 'JOHOR BAHRU', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 3, 'kod_daerah' => '0103', 'keterangan' => 'KLUANG', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 4, 'kod_daerah' => '0104', 'keterangan' => 'KOTA TINGGI', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 5, 'kod_daerah' => '0105', 'keterangan' => 'MERSING', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 6, 'kod_daerah' => '0106', 'keterangan' => 'MUAR', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 7, 'kod_daerah' => '0107', 'keterangan' => 'PONTIAN', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 8, 'kod_daerah' => '0108', 'keterangan' => 'SEGAMAT', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 9, 'kod_daerah' => '0121', 'keterangan' => 'KULAI', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 10, 'kod_daerah' => '0122', 'keterangan' => 'TANGKAK', 'id_negeri' => 1, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 11, 'kod_daerah' => '0201', 'keterangan' => 'KOTA SETAR', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 12, 'kod_daerah' => '0202', 'keterangan' => 'KUBANG PASU', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 13, 'kod_daerah' => '0203', 'keterangan' => 'PADANG TERAP', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 14, 'kod_daerah' => '0204', 'keterangan' => 'LANGKAWI', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 15, 'kod_daerah' => '0205', 'keterangan' => 'KUALA MUDA', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 16, 'kod_daerah' => '0206', 'keterangan' => 'YAN', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 17, 'kod_daerah' => '0207', 'keterangan' => 'SIK', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 18, 'kod_daerah' => '0208', 'keterangan' => 'BALING', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 19, 'kod_daerah' => '0209', 'keterangan' => 'KULIM', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 20, 'kod_daerah' => '0210', 'keterangan' => 'BANDAR BAHARU', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 21, 'kod_daerah' => '0211', 'keterangan' => 'PENDANG', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 22, 'kod_daerah' => '0212', 'keterangan' => 'POKOK SENA', 'id_negeri' => 2, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 23, 'kod_daerah' => '0301', 'keterangan' => 'BACHOK', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 24, 'kod_daerah' => '0302', 'keterangan' => 'KOTA BHARU', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 25, 'kod_daerah' => '0303', 'keterangan' => 'MACHANG', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 26, 'kod_daerah' => '0304', 'keterangan' => 'PASIR MAS', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 27, 'kod_daerah' => '0305', 'keterangan' => 'PASIR PUTEH', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 28, 'kod_daerah' => '0306', 'keterangan' => 'TANAH MERAH', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 29, 'kod_daerah' => '0307', 'keterangan' => 'TUMPAT', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 30, 'kod_daerah' => '0308', 'keterangan' => 'GUA MUSANG', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 31, 'kod_daerah' => '0310', 'keterangan' => 'KUALA KRAI', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 32, 'kod_daerah' => '0311', 'keterangan' => 'JELI', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 33, 'kod_daerah' => '0312', 'keterangan' => 'KECIL LOJING', 'id_negeri' => 3, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 34, 'kod_daerah' => '0401', 'keterangan' => 'MELAKA TENGAH', 'id_negeri' => 4, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 35, 'kod_daerah' => '0402', 'keterangan' => 'JASIN', 'id_negeri' => 4, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 36, 'kod_daerah' => '0403', 'keterangan' => 'ALOR GAJAH', 'id_negeri' => 4, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 37, 'kod_daerah' => '0501', 'keterangan' => 'JELEBU', 'id_negeri' => 5, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 38, 'kod_daerah' => '0502', 'keterangan' => 'KUALA PILAH', 'id_negeri' => 5, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 39, 'kod_daerah' => '0503', 'keterangan' => 'PORT DICKSON', 'id_negeri' => 5, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 40, 'kod_daerah' => '0504', 'keterangan' => 'REMBAU', 'id_negeri' => 5, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 41, 'kod_daerah' => '0505', 'keterangan' => 'SEREMBAN', 'id_negeri' => 5, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 42, 'kod_daerah' => '0506', 'keterangan' => 'TAMPIN', 'id_negeri' => 5, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 43, 'kod_daerah' => '0507', 'keterangan' => 'JEMPOL', 'id_negeri' => 5, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 44, 'kod_daerah' => '0601', 'keterangan' => 'BENTONG', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 45, 'kod_daerah' => '0602', 'keterangan' => 'CAMERON HIGHLANDS', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 46, 'kod_daerah' => '0603', 'keterangan' => 'JERANTUT', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 47, 'kod_daerah' => '0604', 'keterangan' => 'KUANTAN', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 48, 'kod_daerah' => '0605', 'keterangan' => 'LIPIS', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 49, 'kod_daerah' => '0606', 'keterangan' => 'PEKAN', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 50, 'kod_daerah' => '0607', 'keterangan' => 'RAUB', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 51, 'kod_daerah' => '0608', 'keterangan' => 'TEMERLOH', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 52, 'kod_daerah' => '0609', 'keterangan' => 'ROMPIN', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 53, 'kod_daerah' => '0610', 'keterangan' => 'MARAN', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 54, 'kod_daerah' => '0611', 'keterangan' => 'BERA', 'id_negeri' => 6, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 55, 'kod_daerah' => '0801', 'keterangan' => 'BATANG PADANG', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 56, 'kod_daerah' => '0802', 'keterangan' => 'MANJUNG', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 57, 'kod_daerah' => '0803', 'keterangan' => 'KINTA', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 58, 'kod_daerah' => '0804', 'keterangan' => 'KERIAN', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 59, 'kod_daerah' => '0805', 'keterangan' => 'KUALA KANGSAR', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 60, 'kod_daerah' => '0806', 'keterangan' => 'LARUT & MATANG', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 61, 'kod_daerah' => '0807', 'keterangan' => 'HILIR PERAK', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 62, 'kod_daerah' => '0808', 'keterangan' => 'HULU PERAK', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 63, 'kod_daerah' => '0809', 'keterangan' => 'SELAMA', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 64, 'kod_daerah' => '0810', 'keterangan' => 'PERAK TENGAH', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 65, 'kod_daerah' => '0811', 'keterangan' => 'KAMPAR', 'id_negeri' => 8, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 66, 'kod_daerah' => '0901', 'keterangan' => 'PERLIS', 'id_negeri' => 9, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 67, 'kod_daerah' => '0701', 'keterangan' => 'SEBERANG PERAI TENGAH', 'id_negeri' => 7, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 68, 'kod_daerah' => '0702', 'keterangan' => 'SEBERANG PERAI UTARA', 'id_negeri' => 7, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 69, 'kod_daerah' => '0703', 'keterangan' => 'SEBERANG PERAI SELATAN', 'id_negeri' => 7, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 70, 'kod_daerah' => '0704', 'keterangan' => 'TIMOR LAUT', 'id_negeri' => 7, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 71, 'kod_daerah' => '0705', 'keterangan' => 'BARAT DAYA', 'id_negeri' => 7, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 72, 'kod_daerah' => '1201', 'keterangan' => 'KOTA KINABALU', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 73, 'kod_daerah' => '1202', 'keterangan' => 'PAPAR', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 74, 'kod_daerah' => '1203', 'keterangan' => 'KOTA BELUD', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 75, 'kod_daerah' => '1204', 'keterangan' => 'TUARAN', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 76, 'kod_daerah' => '1205', 'keterangan' => 'KUDAT', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 77, 'kod_daerah' => '1206', 'keterangan' => 'RANAU', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 78, 'kod_daerah' => '1207', 'keterangan' => 'SANDAKAN', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 79, 'kod_daerah' => '1208', 'keterangan' => 'LABUK & SUGUT', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 80, 'kod_daerah' => '1209', 'keterangan' => 'KINABATANGAN', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 81, 'kod_daerah' => '1210', 'keterangan' => 'TAWAU', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 82, 'kod_daerah' => '1211', 'keterangan' => 'LAHAD DATU', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 83, 'kod_daerah' => '1212', 'keterangan' => 'SEMPORNA', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 84, 'kod_daerah' => '1213', 'keterangan' => 'KENINGAU', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 85, 'kod_daerah' => '1214', 'keterangan' => 'TAMBUNAN', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 86, 'kod_daerah' => '1215', 'keterangan' => 'PENSIANGAN', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 87, 'kod_daerah' => '1216', 'keterangan' => 'TENOM', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 88, 'kod_daerah' => '1217', 'keterangan' => 'BEAUFORT', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 89, 'kod_daerah' => '1218', 'keterangan' => 'KUALA PENYU', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 90, 'kod_daerah' => '1219', 'keterangan' => 'SIPITANG', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 91, 'kod_daerah' => '1221', 'keterangan' => 'PENAMPANG', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 92, 'kod_daerah' => '1222', 'keterangan' => 'KOTA MARUDU', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 93, 'kod_daerah' => '1223', 'keterangan' => 'PITAS', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 94, 'kod_daerah' => '1224', 'keterangan' => 'KUNAK', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 95, 'kod_daerah' => '1225', 'keterangan' => 'TONGOD', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 96, 'kod_daerah' => '1226', 'keterangan' => 'PUTATAN', 'id_negeri' => 12, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 97, 'kod_daerah' => '1301', 'keterangan' => 'KUCHING', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 98, 'kod_daerah' => '1302', 'keterangan' => 'SRI AMAN', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 99, 'kod_daerah' => '1303', 'keterangan' => 'SIBU', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 100, 'kod_daerah' => '1304', 'keterangan' => 'MIRI', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 101, 'kod_daerah' => '1305', 'keterangan' => 'LIMBANG', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 102, 'kod_daerah' => '1306', 'keterangan' => 'SARIKEI', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 103, 'kod_daerah' => '1307', 'keterangan' => 'KAPIT', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 104, 'kod_daerah' => '1308', 'keterangan' => 'SAMARAHAN', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 105, 'kod_daerah' => '1309', 'keterangan' => 'BINTULU', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 106, 'kod_daerah' => '1310', 'keterangan' => 'MUKAH', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 107, 'kod_daerah' => '1311', 'keterangan' => 'BETONG', 'id_negeri' => 13, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 108, 'kod_daerah' => '1001', 'keterangan' => 'KLANG', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 109, 'kod_daerah' => '1002', 'keterangan' => 'KUALA LANGAT', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 110, 'kod_daerah' => '1004', 'keterangan' => 'KUALA SELANGOR', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 111, 'kod_daerah' => '1005', 'keterangan' => 'SABAK BERNAM', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 112, 'kod_daerah' => '1006', 'keterangan' => 'ULU LANGAT', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 113, 'kod_daerah' => '1007', 'keterangan' => 'ULU SELANGOR', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 114, 'kod_daerah' => '1008', 'keterangan' => 'PETALING', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 115, 'kod_daerah' => '1009', 'keterangan' => 'GOMBAK', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 116, 'kod_daerah' => '1010', 'keterangan' => 'SEPANG', 'id_negeri' => 10, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 117, 'kod_daerah' => '1101', 'keterangan' => 'BESUT', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 118, 'kod_daerah' => '1102', 'keterangan' => 'DUNGUN', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 119, 'kod_daerah' => '1103', 'keterangan' => 'KEMAMAN', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 120, 'kod_daerah' => '1104', 'keterangan' => 'KUALA TERENGGANU', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 121, 'kod_daerah' => '1105', 'keterangan' => 'HULU TERENGGANU', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 122, 'kod_daerah' => '1106', 'keterangan' => 'MARANG', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 123, 'kod_daerah' => '1107', 'keterangan' => 'SETIU', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 124, 'kod_daerah' => '1108', 'keterangan' => 'KUALA NERUS', 'id_negeri' => 11, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 125, 'kod_daerah' => '1401', 'keterangan' => 'KUALA LUMPUR', 'id_negeri' => 14, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 126, 'kod_daerah' => '1501', 'keterangan' => 'LABUAN', 'id_negeri' => 15, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['id' => 127, 'kod_daerah' => '1601', 'keterangan' => 'PUTRAJAYA', 'id_negeri' => 16, 'status' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ]);
        }
    }
}
