<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UsersRolesSeeder extends Seeder
{
    public function run()
    {
        // check if table user role is empty
        if(UserRole::count() == 0){

            UserRole::insert([
                ['name' => 'SuperAdmin', 'description' => 'Super Admin', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Calon', 'description' => 'Calon Peperiksaan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'SUP', 'description' => 'Setiausaha Peperiksaan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pentadbir Sekolah', 'description' => 'Pentadbir Sekolah', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'PPD', 'description' => 'Pejabat Pelajaran Daerah', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'JPN', 'description' => 'Jabatan Pendidikan Negeri ', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pengarah JPN', 'description' => 'Pengarah JPN', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Timbalan Pengarah JPN', 'description' => 'Timbalan Pengarah JPN', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Ketua Pemeriksa', 'description' => 'Ketua Pemeriksa', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Ketua Pemeriksa Sekolah', 'description' => 'Ketua Pemeriksa Sekolah', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pemeriksa', 'description' => 'Pemeriksa', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Penyelia Kawasan', 'description' => 'Penyelia Kawasan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'KPs', 'description' => 'Ketua Pengawas', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'TKPs', 'description' => 'Timbalan Ketua Pengawas', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pengawas', 'description' => 'Pengawas', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'KPK', 'description' => 'Ketua Pentaksir Kebangsaan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'KPN', 'description' => 'Ketua Pentaksir Negeri', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'KPKw', 'description' => 'Ketua Pentaksir Kawasan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'PKw', 'description' => 'Pentaksir Kawasan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pentaksir Sekolah', 'description' => 'Pentaksir Sekolah', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pengarah LP', 'description' => 'Pengarah Lembaga Peperiksaan Malaysia', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UMPK', 'description' => 'Unit Maklumat dan Pemprosesan Keputusan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UPU', 'description' => 'Unit Pra Universiti', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'Pegawai Meja UP', 'description' => 'Pegawai Meja Unit Pra Universiti', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'KPP UPU', 'description' => 'KPP Unit Pra Universiti', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UPT Admin', 'description' => 'Admin Unit Pembangunan Teknologi', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UPDPS', 'description' => 'Unit Pengurusan Data dan Penentuan Standard', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'SPI', 'description' => 'Sektor Pemibaan Instrumen', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UPDP', 'description' => 'Unit Perolehan dan Pembangunan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UBAP', 'description' => 'Unit Bahan Am Peperiksaan', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UPIL', 'description' => 'Unit Pengajian Islam Lanjut', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
                ['name' => 'UIDP', 'description' => 'UIDP', 'status' => 1, 'guard_name' => 'web', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
            ]);
        }
    }
}
