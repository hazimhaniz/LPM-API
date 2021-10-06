<?php

namespace Database\Seeders;

use App\Models\Constant\Negeri;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Peperiksaan\RefPeperiksaan\JenisPengguna;
use App\Models\User;
use App\Models\Kru\Kru;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UsersSeeder extends Seeder
{
    protected $phoneNumber;
    protected $noKadPengenalan;
    protected $domain;
    protected $idPeperiksaan;
    protected $jenisPengguna;

    public function __construct()
    {
        $this->phoneNumber = '0195599911';
        $this->noKadPengenalan = '800519027887';
        $this->domain = '@rania.dev';
        $this->idPeperiksaan = [Peperiksaan::ID_PEPERIKSAAN_STAM,Peperiksaan::ID_PEPERIKSAAN_PT3];
        $this->jenisPengguna = '';
    }

    public function run()
    {
        $json = File::get("database/json/users.json");
        $data = json_decode($json,true);

        if (!empty(User::all()) and !empty(Kru::all())) {
            User::truncate();
            Kru::truncate();
        }

        // 1) add user data for stam
        foreach($this->idPeperiksaan as $exam){
            foreach( $data['users'] as $item) {

                $this->jenisPengguna = $item['type'] == 1 ? JenisPengguna::ID_JENIS_PENGGUNA_KRU : JenisPengguna::ID_JENIS_PENGGUNA_CALON;

                if( $item['id'] == 'sup' and $exam == 2){

                    Sekolah::select('kod_sekolah', 'nama_sekolah', 'id', 'id_negeri')->get()->each(function($sekolah) use($item, $exam){

                        $user = User::updateOrCreate([
                            'id_peperiksaan'        => $exam,
                            'id_jenis_pengguna'     => $this->jenisPengguna,
                            'id_pengguna'           => strtoupper($item['id']).$sekolah->kod_sekolah,
                        ],[
                            'email'                 => str_replace(' ', '',strtolower($item['id'].$sekolah->kod_sekolah.$this->domain)),
                            'password'              => Hash::make('123456'),
                            'email_verified_at'     => now(),
                            'status'                => $item['status'],
                        ]);

                        $this->assignRole($user,$item['name']);
                        $this->createCrew($user,[
                            'id_sekolah'    => $sekolah->id,
                            'id_negeri'     => $sekolah->id_negeri,
                            'description'   => strtoupper($item['id']).' '.$sekolah->nama_sekolah
                        ]);
                    });

                } else if( $item['id'] == 'jpn' ) {

                    Negeri::select('id', 'keterangan')->get()->each(function($negeri) use($item, $exam) {
                        $user = User::updateOrCreate([
                            'id_peperiksaan'        => $exam,
                            'id_jenis_pengguna'     => $this->jenisPengguna,
                            'id_pengguna'           => '8005190254'.str_pad($negeri->id, 2, "0", STR_PAD_LEFT),
                        ],[
                            'email'                 => str_replace(' ', '',strtolower($item['id'].$negeri->keterangan.$this->domain)),
                            'password'              => Hash::make('kucingku'),
                            'email_verified_at'     => now(),
                            'status'                => $item['status'],
                        ]);

                        $this->assignRole($user,$item['name']);
                        $this->createCrew($user,[
                            'id_negeri'         => $negeri->id,
                            'no_kad_pengenalan' => $user->id_pengguna,
                            'description'       => strtoupper($item['id']).' '.$negeri->keterangan
                        ]);
                    });
                } else {
                    $user = User::updateOrCreate([
                        'id_peperiksaan'        => $exam,
                        'id_jenis_pengguna'     => $this->jenisPengguna,
                        'id_pengguna'           => $item['id'],
                    ],[
                        'email'                 => $item['id'].$this->domain,
                        'password'              => Hash::make('kucingku'),
                        'email_verified_at'     => now(),
                        'status'                => $item['status'],
                    ]);
                    $role = $item['name'] == 'Admin' ? 'SuperAdmin' : $item['name'];
                    $this->assignRole($user,$role);
                    $this->createCrew($user,$item);
                }
           
            }
        }
    }

    private function assignRole($user,$role){
        $user->assignRole($role);
    }

    private function createCrew($user,$item){
        $user->kru()->updateOrCreate([
            'id_peperiksaan'        => $user->id_peperiksaan,
            'id_pengguna'           => $user->id_pengguna,
        ],
        [
            'no_kad_pengenalan'     => $item['no_kad_pengenalan'] ?? $this->noKadPengenalan,
            'no_pengenalan_lain'    => null,
            'nama'                  => $item['description'],
            'nama_i18n'             => '',
            'no_telefon_bimbit'     => $this->phoneNumber,
            'no_telefon_rumah'      => '',
            'emel'                  => $user->email,
            'jawatan_perkhidmatan'  => '',
            'gred_jawatan'          => '',
            'id_jantina'            => 0,
            'id_keturunan'          => 0,
            'id_agama'              => 0,
            'id_sekolah'            => $item['id_sekolah'] ?? null,
            'id_negeri'             => $item['id_negeri'] ?? null,
            'id_jenis_perkhidmatan' => 0,
            'tarikh_lahir'          => Carbon::now(),
            'tarikh_bersara'        => Carbon::now(),
            'no_cukai_pendapatan'   => '',
            'no_gaji'               => '',
            'gaji_pokok'            => 0.0,
            'aktif'                 => true,
        ]);
    }
}
