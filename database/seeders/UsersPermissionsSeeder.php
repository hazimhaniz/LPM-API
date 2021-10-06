<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use Illuminate\Database\Seeder;

class UsersPermissionsSeeder extends Seeder
{
    public function run()
    {
        // check if table kod peperiksaan is empty
        if(UserPermission::get()->count() == 0){

            UserPermission::  insert([
                ['name' => 'Kawalan', 'description' => 'Kawalan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Maklumat', 'description' => 'Maklumat', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'LKC & LPD', 'description' => 'LKC & LPD', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Exspot Data', 'description' => 'Exspot Data', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Laporan Penyelenggaraan', 'description' => 'Laporan Penyelenggaraan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Laporan Analisis', 'description' => 'Laporan Analisis', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pendaftaran', 'description' => 'Pendaftaran', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Laporan Pendaftaran', 'description' => 'Laporan Pendaftaran', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pemeriksa', 'description' => 'Pemeriksa', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Surat Pemeriksa', 'description' => 'Surat Pemeriksa', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Laporan Pemeriksa', 'description' => 'Laporan Pemeriksa', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Markah', 'description' => 'Markah', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Markah [Pengesahan]', 'description' => 'Markah [Pengesahan]', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Keputusan', 'description' => 'Keputusan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Keputusan [Pengesahan]', 'description' => 'Keputusan [Pengesahan]', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Surat Markah & Keputusan', 'description' => 'Surat Markah & Keputusan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Laporan Markah', 'description' => 'Laporan Markah', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ]);

            UserPermission::insert([
                ['name' => 'Tahun Peperiksaan Baru', 'description' => 'Tahun Peperiksaan Baru', 'permission_id' => 1, 'type' => 'sub', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pengguna', 'description' => 'Pengguna', 'permission_id' => 1, 'type' => 'sub', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Kumpulan Kawalan', 'description' => 'Kumpulan Kawalan', 'permission_id' => 1, 'type' => 'sub', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Kawalan Sistem', 'description' => 'Kawalan Sistem', 'permission_id' => 1, 'type' => 'sub', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Audit Log', 'description' => 'Audit Log', 'permission_id' => 1, 'type' => 'sub', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Parlimen', 'description' => 'Parlimen', 'permission_id' => 1, 'type' => 'sub', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'DUN', 'description' => 'DUN', 'permission_id' => 1, 'type' => 'sub', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ]);
        }
    }
}
