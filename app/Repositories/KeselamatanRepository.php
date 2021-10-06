<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;
use App\Models\Peperiksaan\RefPeperiksaan\JenisPengguna;

class KeselamatanRepository extends BaseRepository
{
    public function logMasuk($peperiksaan, $request)
    {
        $user   =   User::with(
                        'calon',
                        'kru.sekolah.ppd',
                        'kru.sekolah.negeri',
                        'kru.sekolah.daerah',
                        'kru.sekolah.bandar',
                        'kru.sekolah.jenisSekolah',
                        'kru.alamat'
                    )
                    ->where('id_pengguna', $request->id_pengguna)
                    ->where('id_peperiksaan', $peperiksaan->id)
                    ->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                if($user->hasRole('Calon') && $user->id_jenis_pengguna == JenisPengguna::ID_JENIS_PENGGUNA_CALON){

                    if($user->calon->aktif){

                        $token      = $user->createToken('token')->plainTextToken;
                        $userRole   = UserRole::with('userPermissions')->whereIn('id', $user->roles->pluck('id'))->first();

                        $response   = [
                            'user'          => $user->makeHidden('roles'),
                            'role'          => $userRole,
                            'token'         => $token,
                        ];

                        return $response;

                    }else{

                        return abort(401, 'Akaun Tidak Aktif');

                    }

                }elseif($user->id_jenis_pengguna == JenisPengguna::ID_JENIS_PENGGUNA_KRU){

                    if($user->kru->aktif){

                        $token      = $user->createToken('token')->plainTextToken;
                        $userRole   = UserRole::with('userPermissions')->whereIn('id', $user->roles->pluck('id'))->first();

                        $response   = [
                            'user'          => $user->makeHidden('roles'),
                            'role'          => $userRole,
                            'token'         => $token,
                        ];

                        return $response;

                    }else{

                        return abort(401, 'Akaun Tidak Aktif');

                    }

                }else{
                    return abort(401, 'Pengguna tidak betul');
                }

            } else {

                return abort(401, 'Kata Laluan tidak betul');
            }

        } else {

            return abort(401, 'ID Pengguna tidak betul');
        }
    }

    public function logKeluar($peperiksaan, $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }
}
