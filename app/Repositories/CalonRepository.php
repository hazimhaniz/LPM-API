<?php

namespace App\Repositories;

use App\Models\Dokumen\RefDokumen\JenisDokumen;
use App\Models\Peperiksaan\RefPeperiksaan\JenisPengguna;
use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Permohonan\PermohonanCalon;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Status\StatusPembayaran;
use Illuminate\Support\Facades\Crypt;
use App\Models\Dokumen\DokumenCalon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Events\SendEmailEvent;
use App\Events\SendJpnSahLateEvent;
use App\Events\SendUmpkPmcEvent;
use App\Listeners\SendJpnSahLateNoti;
use App\Listeners\SendUmpkPmcNotification;
use App\Models\Bayaran\BayaranPendaftaranCalon;
use App\Models\Bayaran\BayaranPendaftaranCalonSekolah;
use Illuminate\Support\Str;
use App\Models\Calon\Calon;
use App\Models\Calon\CalonPembatalanPendaftaran;
use App\Models\Calon\CalonPembetulanMaklumat;
use App\Models\Calon\CalonPindahPusat;
use App\Models\Calon\CalonKeperluanKhas;
use App\Models\Calon\RefCalon\JenisPendaftaran;
use App\Models\Peperiksaan\JadualKerja;
use App\Models\Peperiksaan\RefPeperiksaan\JenisBayaran;
use App\Models\Permohonan\PermohonanCalonPindahPusat;
use App\Models\Permohonan\PermohonanPendaftaranLewat;
use App\Models\Status\StatusJanaan;
use App\Models\Status\StatusPendaftaran;
use App\Models\Status\StatusPengesahan;
use App\Models\Status\StatusTempohPendaftaran;
use GuzzleHttp\Client;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Models\Permohonan\PermohonanCalonPembetulan;

class CalonRepository extends BaseRepository
{

    private $calon;
    private $calonRelationships;
    private $permohonanPusatLewatRelationships;
    private $permohonanCalonPindahPusatRelationship;
    private $pembatalanRelationships;

    public function __construct(Calon $calon)
    {
        $this->calon = $calon;

        $this->calonRelationships  = [
            'permohonanDaftarLewat.statusPengesahan',
            'permohonan.statusPengesahan',
            'permohonan.tahunPeperiksaan',
            'permohonan.pusat',
            'permohonan.sekolah',
            'dokumen.jenisDokumen',
            'JenisPendaftaran',
            'pembetulanCalon',
            'permohonanPembatalan',
            'pusat',
            'bayaranLewat',
            'warganegara',
            'keturunan',
            'bayaran',
            'alamat',
            'cbk',
        ];

        $this->pembatalanRelationships = [
            'calon',
            'calon.pusat',
            'calon.dokumen',
            'alamat',
            'permohonan.pusat', 
            'statusPengesahan'
        ];


        $this->permohonanPusatLewatRelationships  = [
            'tahunPeperiksaan',
            'statusPengesahan',
            'pusat.statusPendaftaran',
            'calon',
            'bayaranPusat',
            'bayaranCalon',
        ];

        $this->permohonanCalonPindahPusatRelationship  = [
            'tahunPeperiksaan',
            'calon.bayaran',
            'calon.dokumen',
            'calon.dokumen.jenisDokumen',
            'pusat',
            'pusat.sekolah',
            'statusPengesahan',
            'pusatBaharu',
            'pusatBaharu.sekolah',
        ];
    }

    /*
    **  ========================== DAFTAR CALON ==========================
    */


    public function daftarCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {
            return $this->daftar($peperiksaan, $request);
        });
    }

    public function daftarSenaraiCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {
            $pusat =    Pusat::whereHas('tahunPeperiksaan.peperiksaan', function ($query) use ($peperiksaan) {
                $query->where('id', $peperiksaan->id);
            })->find($request->permohonan['id_pusat']);


            if ($pusat->jumlah_calon < (count($request->senarai_calon) + count($pusat->calon))) {
                return abort(401, 'Pusat ini telah melebihi had jumlah calon, hanya jumlah dibenarkan ' . $pusat->jumlah_calon . ' calon sahaja');
            }

            $senaraiCalonRequest                = $request->senarai_calon;
            $senaraiCalon                       = [];

            foreach ($senaraiCalonRequest as $senaraiRequest) {
                $senaraiRequest['permohonan']  = $request->permohonan;
                $senaraiCalon[]                = $this->daftar($peperiksaan, $senaraiRequest);
            }

            return $senaraiCalon;
        });
    }

    /*
    **  ========================== DAFTAR AKAUN Calon ==========================
    */

    public function daftarAkaunCalonPersendirian($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {
                return $this->daftarAkaunCalonPT3($peperiksaan, $request);
            } else if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {
                return $this->daftarAkaunCalonSTAM($peperiksaan, $request);
            }
        });
    }

    /*
    **  ========================== TINDAKAN CALON ==========================
    */


    public function kemaskiniCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {
                $update = $this->kemaskini($peperiksaan, $request); 
            }

            else if($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {
                $update = $this->kemaskiniPt3($peperiksaan, $request); 
            }

            $calon  = $this->calon->with($this->calonRelationships)->find($update->id);
            return $calon;
        });
    }

    public function padamCalon($peperiksaan, $request)
    {   
        return DB::transaction(function () use ($peperiksaan, $request) {

            return $this->calon->findOrFail($request->id_calon)->delete();
        });
    }

    /*
    **  ========================== SEMAK CALON ==========================
    */

    public function semakCalon($peperiksaan, $request)
    {
        return  Calon::with($this->calonRelationships)
            ->where('id_peperiksaan', $peperiksaan->id)
            ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
            ->find($request->id_calon);
    }

    public function semakSenaraiCalon($peperiksaan, $request)
    {
        $isCalon = Auth::user()->id_jenis_pengguna == 2?:false;
        $query = Calon::with($this->calonRelationships);

        if (!$isCalon) {
            $id_pusat =  Auth::user()->kru->pusat->first()->id ?? 0;
            $calon = $query->where('id_peperiksaan', $peperiksaan->id)
                ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                ->when($request->id_pusat, function ($query) use ($request, $id_pusat) {
                    $query->where('id_pusat', $request->id_pusat ?? $id_pusat);
                })
                ->get();

            return $calon;
        }
        $calon = $query->where('id_peperiksaan', $peperiksaan->id)
            ->where('id_user', Auth::user()->id)
            ->first();

        return $calon;
    }

    public function semakStatusPendaftaran($peperiksaan, $request)
    {
        $id_pusat = Auth::user()->kru->pusat->first()->id ?? 0;

        return  Calon::with($this->calonRelationships)
            ->when($request->id_pusat, function ($query) use ($request, $id_pusat) {
                $query->where('id_pusat', $request->id_pusat ?? $id_pusat);
            })
            ->when($request->id_calon, function ($query) use ($request) {
                $query->where('id', $request->id_calon);
            })
            ->get();
    }

    /*
    **  ========================== MODUL INDEN - PENGURUSAN CBK ==========================
    */

    public function senaraiCbk($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            return Calon::with($this->calonRelationships)
            ->when($request->nama ?? '', function ($query) use ($request) {
                $query->where('nama', $request->nama);
            })
            ->when($request->no_kad_pengenalan ?? '', function ($query) use ($request) {
                $query->where('no_kad_pengenalan', $request->no_kad_pengenalan);
            })
            ->when($request->id_negeri ?? '', function ($query) use ($request) {
                $query->whereHas('pusat.sekolah', function($query) use ($request) {
                    $query->where('id_negeri', $request->id_negeri ?? '');
                });       
            })      
            ->whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
                $query->where('id_peperiksaan'  , $peperiksaan->id);
            }) 
            ->whereNotNull('id_keperluan_khas')
            ->get();
        });

    }

    public function pengesahanCbk($peperiksaan, $request)
    {
        foreach($request as $data){
            foreach($data as $i => $value){
                $data = CalonKeperluanKhas::updateOrCreate(
                    [   'id_calon'      =>  $value['id'] ],
                                                            
                    [   'bantuan_oku'   =>  $value['khas'],
                    ]   
                );
            }
        }
     
        return $data;
    }


    /*
    **  ========================== DAFTAR MATA PELAJARAN ==========================
    */

    public function daftarMataPelajaran($peperiksaan, $request)
    {

        $calon = Calon::findOrFail($request->id_calon);
        $ids_mata_pelajaran = $request->ids_mata_pelajaran;

        if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {

            if ($calon->mataPelajaranPt3) {
                // $ids_mata_pelajaran =  array_merge($request->ids_mata_pelajaran, $calon->mataPelajaranPt3->ids_mata_pelajaran);
            }

            $calon->mataPelajaranPt3()->updateOrCreate(

                [
                    'id_calon'              => $request->id_calon,
                ],
                [
                    'ids_mata_pelajaran'    => $ids_mata_pelajaran,
                    'id_status_pengesahan'  => StatusPengesahan::SAH,
                ]

            );
        } elseif ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {

            $calon->mataPelajaranStam()->updateOrCreate(

                [
                    'id_calon'              => $request->id_calon,
                ],
                [
                    'ids_mata_pelajaran'    => $ids_mata_pelajaran,
                    'id_status_pengesahan'  => StatusPengesahan::SAH,
                ]

            );
        }

        return  MataPelajaran::whereIn('id', array($ids_mata_pelajaran))->get();
    }

    public function daftarSenaraiMataPelajaran($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $calons = Calon::whereIn('id', $request['ids_calon'])->get();

            foreach ($calons as $calon) {

                $ids_mata_pelajaran = $request->ids_mata_pelajaran;

                if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {

                    if ($calon->mataPelajaranPt3) {
                        // $ids_mata_pelajaran = array_merge($ids_mata_pelajaran, $calon->mataPelajaranPt3->ids_mata_pelajaran);
                    }

                    $calon->mataPelajaranPt3()->updateOrCreate(

                        [
                            'id_calon'              => $calon->id,
                        ],
                        [
                            'ids_mata_pelajaran'    => array_values(array_unique($ids_mata_pelajaran)),
                            'id_status_pengesahan'  => StatusPengesahan::SAH,
                        ]
                    );
                } elseif ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {

                    if ($calon->mataPelajaranStam) {
                        // $ids_mata_pelajaran = array_merge($ids_mata_pelajaran, $calon->mataPelajaranStam->ids_mata_pelajaran);
                    }

                    $calon->mataPelajaranStam()->updateOrCreate(

                        [
                            'id_calon'              => $calon->id,
                        ],
                        [
                            'ids_mata_pelajaran'    => array_values(array_unique($ids_mata_pelajaran)),
                            'id_status_pengesahan'  => StatusPengesahan::SAH,
                        ]
                    );
                }
            }

            return  MataPelajaran::whereIn('id', $ids_mata_pelajaran)->get();
        });
    }

    public function padamMataPelajaran($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $calon = Calon::findOrFail($request['id_calon']);

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {

                $mataPelajaran = $calon->mataPelajaranPt3;

                if ($mataPelajaran) {

                    $ids        = $mataPelajaran->ids_mata_pelajaran;
                    $ids_temp   = [];

                    foreach ($ids as $id) {
                        if ($id != $request['id_mata_pelajaran']) {
                            $ids_temp[] = $id;
                        }
                    }

                    $mataPelajaran->updateOrCreate(

                        [
                            'id_calon'              => $request['id_calon'],
                        ],
                        [
                            'ids_mata_pelajaran'    => $ids_temp,
                            'id_status_pengesahan'  => StatusPengesahan::SAH,
                        ]

                    );
                }
            } elseif ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {

                $mataPelajaran = $calon->mataPelajaranStam;

                if ($mataPelajaran) {

                    $ids        = $mataPelajaran->ids_mata_pelajaran;
                    $ids_temp   = [];

                    foreach ($ids as $id) {
                        if ($id != $request['id_mata_pelajaran']) {
                            $ids_temp[] = $id;
                        }
                    }

                    $mataPelajaran->updateOrCreate(

                        [
                            'id_calon'              => $request['id_calon'],
                        ],
                        [
                            'ids_mata_pelajaran'    => $ids_temp,
                            'id_status_pengesahan'  => StatusPengesahan::SAH,
                        ]

                    );
                }
            }

            return $mataPelajaran;
        });
    }

    public function semakMataPelajaran($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $calon          = Calon::findOrFail($request['id_calon']);
            $mataPelajaran  = [];

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {
                $mataPelajaran  = MataPelajaran::whereIn('id', $calon->mataPelajaranPt3->ids_mata_pelajaran  ?? [0])->get();
            } else if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {
                $mataPelajaran  = MataPelajaran::whereIn('id', $calon->mataPelajaranStam->ids_mata_pelajaran ?? [0])->get();
            }

            return $mataPelajaran;
        });
    }

    /*
    **  ========================== SELENGGARA ==========================
    */

    public function janaNumberLP($peperiksaan, $request)
    {

        $code       = 'L';
        $tahun      = Carbon::now()->format('y');
        $pusat      = strtoupper(Str::random(2)) . rand(1000, 20);
        $sekolah    = strtoupper(Str::random(3)) . rand(1000, 9999);
        $index      = rand(1, 20);
        $data       = $code . $tahun . $pusat . str_pad($index, 4, "0", STR_PAD_LEFT);

        return $data;
    }

    public function janaAngkaGiliran($peperiksaan, $request)
    {
        $code       = 'L';
        $tahun      = Carbon::now()->format('y');
        $pusat      = strtoupper(Str::random(2)) . rand(1000, 20);
        $sekolah    = strtoupper(Str::random(3)) . rand(1000, 9999);
        $index      = rand(1, 20);
        $data       = $code . $tahun . $pusat . str_pad($index, 4, "0", STR_PAD_LEFT);

        return $data;
    }

    /*
    **  ========================== INTEGRASI ==========================
    */

    public function semakCalonJPN($peperiksaan, $request)
    {
        return Calon::factory([
            'no_kad_pengenalan' => $request->carian ?? (string) rand(970000000000, 999999999999)
        ])->count(rand(1, 3))->make();
    }

    public function semakCalonAPDM($peperiksaan, $request)
    {
        return Calon::factory()->count(rand(5, 15))->make();
    }

    /*
    **  ========================== MUAT NAIK DOKUMEN ==========================
    */

    public function muatNaikDokumen($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $jenisDokumen = JenisDokumen::find($request->id_jenis_dokumen);

            $dokumen = DokumenCalon::updateOrCreate(
                [
                    'id_calon'              => $request->id_calon,
                    'id_jenis_dokumen'      => $jenisDokumen->id,
                ],
                [
                    'dokumen'               => '',
                    'id_status_pengesahan'  => $request->id_status_pengesahan,
                    'keterangan'            => $request->keterangan,
                    'size'                  => $request->size,
                ]
            );

            $dokumen->clearMediaCollection($jenisDokumen->keterangan);

            $dokumen->addMediaFromRequest('dokumen')->toMediaCollection($jenisDokumen->keterangan);

            $dokumen->update(
                [
                    'dokumen' => $dokumen->getMedia($jenisDokumen->keterangan)->first()->url,
                ]
            );

            return $dokumen->setHidden(['media']);
        });
    }

    public function padamDokumen($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $dokumen = DokumenCalon::find($request->id_dokumen);

            if ($dokumen) {
                $dokumen->clearMediaCollection($dokumen->jenisDokumen->keterangan);
                $dokumen->delete();

                return true;
            }

            return false;
        });
    }



    public function senaraiDokumen($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $dokumen = DokumenCalon::with('jenisDokumen')->where('id_calon', $request->id_calon)->get();

            return $dokumen;
        });
    }


    public function pengesahanPusat($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            if (!$request->id_status_pendaftaran_calon) {
                $request->id_status_pendaftaran_calon = StatusPendaftaran::TIADA;
            }

            $data = Pusat::whereHas('tahunPeperiksaan.peperiksaan', function ($query) use ($peperiksaan) {
                $query->where('id', $peperiksaan->id);
            })->find($request->id_pusat);

            if ($data == null) {
                throw new Exception("Pusat ini tidak wujud");
            }

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM && $request->id_status_pendaftaran_calon == StatusPendaftaran::BELUM_DAFTAR) {

                foreach ($data->calon as $key => $calon) {

                    if ($calon->id_jenis_pendaftaran == JenisPendaftaran::PINDAH) {

                        $calon->permohonan()->updateOrCreate([
                            'id_calon'              => $calon->id,
                            'id_peperiksaan'        => $peperiksaan->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        ],[
                            'id_pusat'              => $calon->pusat ? $calon->pusat->id : null,
                            'id_status_pengesahan'  => StatusPengesahan::SAH,
                            'id_negeri'             => $request->id_negeri ?? 0
                        ]);
                    } else {
                        $increment = str_pad(++$key, 3, '0',STR_PAD_LEFT);

                        $calon->angka_giliran = $calon->pusat->kod_pusat . $increment;
                        
                        $this->daftarAkaunCalonSTAM($peperiksaan, $calon);

                        $request->request->add(['id_calon' => $calon->id]);
                        $request->request->add(['ids_mata_pelajaran' =>  $calon->pusat->ids_mata_pelajaran]);

                        $this->daftarMataPelajaran($peperiksaan, $request);
                    }
                }
            }
            elseif($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM && $request->id_status_pendaftaran_calon == StatusPendaftaran::TELAH_DAFTAR)
            {
                foreach($data->calon as $calon)
                {
                    if($calon->id_jenis_pendaftaran != JenisPendaftaran::PINDAH && ( $calon->permohonan->id_status_pengesahan == StatusPengesahan::DALAM_PENGESAHAN || $calon->permohonan->id_status_pengesahan == StatusPengesahan::SAH) )
                    {
                        $calon->permohonan()->updateOrCreate([
                            'id_calon'              => $calon->id,
                            'id_peperiksaan'        => $peperiksaan->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        ], [
                            'id_status_pengesahan'  => StatusPengesahan::SAH 
                        ]);
                    }else{
                        $calon->permohonan()->updateOrCreate([
                            'id_calon'              => $calon->id,
                            'id_peperiksaan'        => $peperiksaan->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        ], [
                            'id_status_pengesahan'  => 99 // tidak membuat kemaskini 
                        ]);
                    }
                }
                //to allow daftar lewat in pusat
            } else if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {
                //pt3 StatusPendaftaran::BELUM_DAFTAR

                $calonDontHaveUserId = ($data->calon()->where('id_user', null)->get());
                
                foreach ($calonDontHaveUserId as $key => $calon) {

                    if ($calon->id_jenis_pendaftaran == JenisPendaftaran::PINDAH) {

                        $calon->permohonan()->updateOrCreate([
                            'id_calon'              => $calon->id,
                            'id_peperiksaan'        => $peperiksaan->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        ],[
                            'id_pusat'              => $calon->pusat ? $calon->pusat->id : null,
                            'id_status_pengesahan'  => StatusPengesahan::SAH,
                            'id_negeri'             => $request->id_negeri ?? 0
                        ]);
                    } else {
                        $increment = str_pad(++$key, 3, '0',STR_PAD_LEFT);
                        $calon->angka_giliran = $calon->pusat->kod_pusat . $increment;
                        $this->daftarAkaunCalonPT3($peperiksaan, $calon);

                        // no need to save/update because already save in process daftar calon
                        // $request->request->add(['id_calon' => $calon->id]);
                        // $request->request->add(['ids_mata_pelajaran' =>  $calon->pusat->ids_mata_pelajaran]);

                        // $this->daftarMataPelajaran($peperiksaan, $request);
                    }
                }

            } elseif($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3 && $request->id_status_pendaftaran_calon == StatusPendaftaran::TELAH_DAFTAR) {
                //pt3 StatusPendaftaran::TELAH_DAFTAR
                foreach($data->calon as $calon)
                {

                    if($calon->id_jenis_pendaftaran != JenisPendaftaran::PINDAH && ( $calon->permohonan->id_status_pengesahan == StatusPengesahan::DALAM_PENGESAHAN || $calon->permohonan->id_status_pengesahan == StatusPengesahan::SAH) )
                    {
                        $calon->permohonan()->updateOrCreate([
                            'id_calon'              => $calon->id,
                            'id_peperiksaan'        => $peperiksaan->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        ], [
                            'id_status_pengesahan'  => StatusPengesahan::SAH 
                        ]);
                    }else{
                        $calon->permohonan()->updateOrCreate([
                            'id_calon'              => $calon->id,
                            'id_peperiksaan'        => $peperiksaan->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        ], [
                            'id_status_pengesahan'  => 99 // tidak membuat kemaskini 
                        ]);
                    }
                }
            }

            $data->update([
                'id_status_pendaftaran_calon'       => $request->id_status_pendaftaran_calon ?? StatusPendaftaran::TIADA,
                'id_status_janaan_angka_giliran'    => StatusJanaan::TELAH_DIJANA,
            ]);

            return $data;
        });
    }

    public function pengesahanPusatLewat($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $pusat = Pusat::whereHas('tahunPeperiksaan.peperiksaan', function ($query) use ($peperiksaan) {
                $query->where('id', $peperiksaan->id);
            })->find($request->id_pusat);

            if ($pusat == null) {
                throw new Exception("Pusat ini tidak wujud: " . $request->id_status_pengesahan);
            }

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {
                if ($request->id_status_pengesahan >= StatusPengesahan::DALAM_PENGESAHAN) {

                    $bayaranPendaftaran = BayaranPendaftaranCalonSekolah::where('id_pusat', $pusat->id)
                        ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                        ->where('id_penjenisan_bayaran', JenisBayaran::CALON_LEWAT)
                        ->first();

                    $permohonan = PermohonanPendaftaranLewat::updateOrCreate(
                        [
                            'id_pusat'              => $pusat->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        ],
                        [
                            'jumlah_calon'          => $request->jumlah_calon,
                            'id_status_pengesahan'  => $request->id_status_pengesahan,
                            'jumlah_calon'          => $bayaranPendaftaran->jumlah_calon // Why twice?
                        ]
                    );

                    return $permohonan;
                } elseif ($request->id_status_pengesahan == StatusPengesahan::SAH) {

                    $permohonan = PermohonanPendaftaranLewat::updateOrCreate(
                        [
                            'id_pusat'              => $request->id_pusat,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        ],
                        [
                            'id_status_pengesahan'  => $request->id_status_pengesahan,
                        ]
                    );

                    $pusat_baru = $pusat->replicate();

                    $pusat_baru->id_status_tempoh_pendaftaran       = StatusTempohPendaftaran::LUAR_TEMPOH;
                    $pusat_baru->id_status_pendaftaran              = StatusPendaftaran::TELAH_DAFTAR;
                    $pusat_baru->id_status_pendaftaran_calon        = 3;
                    $pusat_baru->id_status_janaan_angka_giliran     = 2;
                    $pusat_baru->jumlah_calon                       = $permohonan->jumlah_calon;

                    $pusat_baru->created_at = Carbon::now();
                    $pusat_baru->save();

                    return $permohonan;
                } elseif ($request->id_status_pengesahan == StatusPengesahan::DALAM_PENGESAHAN_KPP_UPU) {

                    $permohonan = PermohonanPendaftaranLewat::updateOrCreate(
                        [
                            'id_pusat'              => $pusat->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        ],
                        [
                            'id_status_pengesahan'  => $request->id_status_pengesahan,
                        ]
                    );

                    return $permohonan;
                }
            } else if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {
            }
        });
    }


    public function senaraiPermohonanCalonLewat($peperiksaan, $request)
    {

        if(Auth::user()->hasRole(["KPP UPU"])){
            $request->request->add(['role'=>'kpp_upu']);
        }

        return DB::transaction(function () use ($peperiksaan, $request) {
            $data = PermohonanPendaftaranLewat
                ::whereHas('tahunPeperiksaan.peperiksaan', function ($query) use ($peperiksaan) {
                    $query->where('id', $peperiksaan->id);
                })
                ->when($request->id_tahun_peperiksaan, function ($query) use ($request) {
                    $query->where('id_tahun_peperiksaan', $request->id_tahun_peperiksaan);
                })
                ->when($request->id_status_pengesahan, function ($query) use ($request) {
                    $query->where('id_status_pengesahan', $request->id_status_pengesahan);
                })
                ->when($request->id_pusat, function ($query) use ($request) {
                    $query->where('id_pusat', $request->id_pusat);
                })
                ->when($request->role, function ($query) {
                    $query->whereHas('calon',function ($query){
                        $query->where('id_jenis_pendaftaran','!=',7);
                    });
                })
                ->whereNotNull('id_calon')
                ->with($this->permohonanPusatLewatRelationships)
                ->get();

            return $data;
        });
    }

    public function pengesahanCalonLewat($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM) {
                if ($request->id_status_pengesahan == StatusPengesahan::DALAM_PENGESAHAN_JPN) {

                    $permohonan = PermohonanPendaftaranLewat::updateOrCreate(
                        [
                            'id_calon'              => $request->id_calon,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        ],
                        [
                            'id_status_pengesahan'  => $request->id_status_pengesahan,
                            'jumlah_calon'          => 1
                        ]
                    );

                    return $permohonan;
                } elseif ($request->id_status_pengesahan == StatusPengesahan::SAH) {

                    $permohonan = PermohonanPendaftaranLewat::updateOrCreate(
                        [
                            'id_calon'              => $request->id_calon,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        ],
                        [
                            'id_status_pengesahan'  =>  StatusPengesahan::SAH,
                        ]
                    );

                    return $permohonan;
                }
            } else if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {

                if ($request->id_status_pengesahan == StatusPengesahan::DALAM_PENGESAHAN_JPN) {

                    $permohonan = PermohonanPendaftaranLewat::updateOrCreate(
                        [
                            'id_calon'              => $request->id_calon,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        ],
                        [
                            'id_status_pengesahan'  => $request->id_status_pengesahan,
                            'jumlah_calon'          => 1
                        ]
                    );

                    return $permohonan;
                } elseif ($request->id_status_pengesahan == StatusPengesahan::SAH) {

                    $permohonan = PermohonanPendaftaranLewat::updateOrCreate(
                        [
                            'id_calon'              => $request->id_calon,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        ],
                        [
                            'id_status_pengesahan'  =>  StatusPengesahan::SAH,
                        ]
                    );

                    return $permohonan;
                }
            }
        });
    }

    public function permohonanCalon($peperiksaan, $request)
    {   
        return DB::transaction(function () use ($peperiksaan, $request) {
           
            return PermohonanCalon::with('calon.dokumen.jenisDokumen', 'calon.bayaran', 'calon.JenisPendaftaran', 'statusPengesahan', 'pusat.sekolah', 'calon.alamat')
                ->where('id_peperiksaan',       $peperiksaan->id)
                ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                ->when($request->id_negeri, function ($query) use ($request) {
                    $query->where('id_negeri', $request->id_negeri);
                })
                ->when($request->id_status_pengesahan, function ($query) use ($request) {
                    $query->where('id_status_pengesahan', $request->id_status_pengesahan);
                })
                ->when($request->id_jenis_pendaftaran, function ($query) use ($request) {
                    $query->whereHas('calon', function ($query) use ($request) {
                        $query->where('id_jenis_pendaftaran', $request->id_jenis_pendaftaran);
                    });
                })
                ->when(!$request->id_status_pengesahan && !$request->id_jenis_pendaftaran, function ($query) {
                    $query->whereHas('calon', function ($query) {
                        $query->whereIn('id_jenis_pendaftaran', [JenisPendaftaran::KOHORT, JenisPendaftaran::PERSENDIRIAN]);
                    });
                })
                ->get();
        });
    }

    public function senaraiCalonSekolah($peperiksaan, $request){
        return DB::transaction(function () use($request) {
            $calon = Calon::with($this->calonRelationships)
                ->when($request->id_jenis_pendaftaran, function ($query) use ($request) {
                    $query->whereIn('calon.id_jenis_pendaftaran', $request->id_jenis_pendaftaran);
                })
                ->when($request->id_pusat, function ($query) use ($request) {
                    $query->where('calon.id_pusat','=', $request->id_pusat);
                })
                ->when($request->no_kad_pengenalan, function ($query) use ($request) {
                    $query->where('calon.no_kad_pengenalan','=', $request->no_kad_pengenalan);
                })
                ->when($request->angka_giliran, function ($query) use ($request) {
                    $query->where('calon.angka_giliran','=', $request->angka_giliran);
                })
                ->when($request->nama, function ($query) use ($request) {
                    $query->where('calon.nama','LIKE', '%'.$request->nama.'%');
                })
                ->leftjoin('ref_peperiksaan__kod_pusat','calon.id_pusat','=','ref_peperiksaan__kod_pusat.id')
                ->leftjoin('ref_calon__jenis_pendaftaran', 'calon.id_jenis_pendaftaran', '=', 'ref_calon__jenis_pendaftaran.id')
                ->select('calon.id as id_calon','calon.id_pusat as id_calon_pusat','calon.*','ref_peperiksaan__kod_pusat.*', 'ref_calon__jenis_pendaftaran.keterangan as jenis_pendaftaran_calon',
                'ref_peperiksaan__kod_pusat.kod_pusat as kod_pusat_calon', 'ref_peperiksaan__kod_pusat.nama_pusat as  nama_pusat_calon')
                ->get();

            return $calon;
        });
    }

    public function listPembetulanCalon($request, $peperiksaan){
        return DB::transaction(function () use($request, $peperiksaan) {
            if($request['current_role'] == 'SUP'){
                return CalonPembetulanMaklumat::with('calon')->where('id_peperiksaan', $peperiksaan->id)
                    ->where('id_jenis_pendaftaran', '!=' , 7)
                    ->get();
            }elseif($request['current_role'] == 'JPN'){
                return CalonPembetulanMaklumat::with('calon')->where('id_peperiksaan', $peperiksaan->id)
                    ->where('id_jenis_pendaftaran', 7)
                    ->get();
            }else{
                return CalonPembetulanMaklumat::with('calon')->where('id_peperiksaan', $peperiksaan->id)
                    ->when($request['id_calon'], function($query) use($request){
                        $query->where('id_calon', $request['id_calon']);
                    })->get();
            }
        });
    }

    public function senaraiCalonLewat($peperiksaan, $request){
        return DB::transaction(function () use($request, $peperiksaan) {
            $calon = $this->calon->with($this->calonRelationships)
                ->has('permohonanDaftarLewat')
                ->where('id_peperiksaan', $peperiksaan->id)
                ->get();

            return $calon;
        });
    }

    public function senaraiCalonPmc($peperiksaan, $request){
        return DB::transaction(function () use($request, $peperiksaan) {
            $calon = $this->calon->with($this->calonRelationships)
                ->has('pembetulanCalon')
                ->where('id_peperiksaan', $peperiksaan->id)
                ->get();

            return $calon;
        });
    }

    public function getNotification ($peperiksaan, $request){
        return DB::transaction(function () use($request, $peperiksaan) {

            Log::info('getNotification');
           
            SendJpnSahLateEvent::dispatch($peperiksaan->id);
            //event(new SendJpnSahLateEvent($peperiksaan->id));

            $notifications = auth()->user()->unreadNotifications;
            return $notifications;
           
        });
    }

    // private function isJpnSahLate(){

    //         $lebih7Hari = [];
    //         $calon_id = [];
    
    //         $now = Carbon::now();
    //         $allCalon = PermohonanCalon::all();
    
    //         $allCalon->filter(function ($calon, $key) use(&$lebih7Hari, &$calon_id){
    //             array_push($calon_id, $calon->id);
    //             array_push($lebih7Hari, $calon->created_at->addDays(7));
    //         });
    
    //         (array)$combined = array_combine($calon_id, $lebih7Hari);

    //         $calonSahLewat = collect();
    //         collect($combined)->filter(function ($date, $id_calon) use($now, &$calonSahLewat){

    //             if($now > $date){
    //                 $calon = PermohonanCalon::whereIn('id_status_pengesahan',[0,99])
    //                 ->where('id_calon', $id_calon)
    //                 ->get();
    //                 if($calon->isNotempty()){
    //                     $calonSahLewat->push($calon);
    //                 }
    //             }
                
    //         });
        
    // }

    public function pembetulanCalon($peperiksaan, $request){
        return DB::transaction(function () use($request) {
            $calon = Calon::with($this->calonRelationships)
                ->where('id', $request->id)->first();

            return $calon;
        });
    }

    public function permohonanpembetulanPt3($peperiksaan, $request){

        return DB::transaction(function () use($request, $peperiksaan) {

             //tarikh jadual kerja pmc pt3 kat id 33 tabel jadualkerja
            $due = JadualKerja::find(33);

            //kalau permohonan pmc lewat baru kene bayar
            if (!Carbon::now()->betweenIncluded($due['tarikh_mula'], $due['tarikh_tamat'])){

                //SUP or JPN je bleh buat permohonan pmc for PT3
                if (Auth::user()->hasAnyRole(['SUP', 'JPN'])){

                $response = app('PembayaranModule')
                ->setPeperiksaan($peperiksaan)
                ->setRef()
                ->setToken()
                ->setJumlahBayaran(JenisBayaran::find(JenisBayaran::PEMBETULAN_MAKLUMAT_CALON_PT3))
                ->setClient()
                ->pembayaran(Auth::user()->kru);
                    
                 $calonPmc = CalonPembetulanMaklumat::updateOrCreate(
                    [
                        'id_calon'                  => $request['id_calon'],
                        'id_jenis_pendaftaran'      => $request['id_jenis_pendaftaran'],
                        'id_peperiksaan'            => $peperiksaan->id,
                        'id_jenis_pembetulan'       =>  1, //for now 1 refer to pembetulan maklumat calon
                        'id_penjenisan_bayaran'     =>  JenisBayaran::PEMBETULAN_MAKLUMAT_CALON_PT3
                    ],[
                        'no_resit'              => $response->RefNo,
                        'tarikh_resit'          => now('Asia/Kuala_Lumpur'),
                        'maklumat_asal'         => $request['maklumat_lama'],
                        'maklumat_baharu'       => $request['maklumat_baharu'],
                        'status_pembayaran'     => StatusPembayaran::ID_BELUM_BAYAR,
                        'id_status_permohonan'  => 0, //pt3 xde status permohonan
                        'jumlah_bayaran'        => $response->Jumlah,
                        'url_bayaran'           => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway',
                        'url_status'            => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway'
                    ]
                );
                
                event(new SendUmpkPmcEvent($calonPmc, $peperiksaan->id));
                return $calonPmc;
             }
            }

            else{
                    
                $calonPmc = CalonPembetulanMaklumat::updateOrCreate(
                    [
                        'id_calon'                  => $request['id_calon'],
                        'id_jenis_pendaftaran'      => $request['id_jenis_pendaftaran'],
                        'id_peperiksaan'            => $peperiksaan->id,
                        'id_jenis_pembetulan'       =>  1, 
                        'id_penjenisan_bayaran'     => 0
                    ],[
                        'no_resit'              => 0,
                        'tarikh_resit'          => now('Asia/Kuala_Lumpur'),
                        'maklumat_asal'         => $request['maklumat_lama'],
                        'maklumat_baharu'       => $request['maklumat_baharu'],
                        'status_pembayaran'     => 0,
                        'id_status_permohonan'  => 0, //pt3 xde status permohonan
                        'jumlah_bayaran'        => 0,
                        'url_bayaran'           => 0,
                        'url_status'            => 0
                    ]
                );

                event(new SendUmpkPmcEvent($calonPmc, $peperiksaan->id));
                return $calonPmc;
            }
        });

        
    }

    public function permohonanPembetulan($peperiksaan, $request){
        return DB::transaction(function () use($request, $peperiksaan) {

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {
                $token = "elpportal608f9770b1037";
                $jenis = "990301";
            } else {
                $token = "elpportal608f975a16136";
                $jenis = "990404";
            }

            $client = new Client([
                'base_uri'          => 'https://elp-lab.moe.gov.my/eportal/api/payment/' . $token . '/',
                'headers'           => [
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ],
            ]);

            $jumlah = JenisBayaran::find(JenisBayaran::PEMBETULAN_MAKLUMAT_MP)->first()->jumlah;
            $calon  = Calon::where('id',$request['id_calon'])->first();

            if( $calon->no_kad_pengenalan != null) {

                $response = $client->post('apisetformrequest', [
                    'json' => [
                        "NamaPenuh"             => $calon->nama,
                        "NoKP"                  => $calon->no_kad_pengenalan,
                        "NoTelefon"             => $calon->no_telefon,
                        "Email"                 => $calon->emel,
                        "Jumlah"                => $jumlah,
                        "JenisPeperiksaan"      => $jenis,
                    ],
                ]);

            }

            else {

                $response = $client->post('apisetformrequest', [
                    'json' => [
                        "NamaPenuh"             => $calon->nama,
                        "NoKP"                  => $calon->no_pengenalan_lain,
                        "NoTelefon"             => $calon->no_telefon,
                        "Email"                 => $calon->emel,
                        "Jumlah"                => $jumlah,
                        "JenisPeperiksaan"      => $jenis,
                    ],
                ]);

            }

            $data = json_decode($response->getBody()->getContents())->data;

            if($calon->id_jenis_pendaftaran != 7) {
                $status = StatusPengesahan::DALAM_PENGESAHAN;
            }else{
                $status = StatusPengesahan::DALAM_PENGESAHAN_JPN;
            }

            return CalonPembetulanMaklumat::updateOrCreate(
                [
                    'id_calon'                  => $request['id_calon'],
                    'id_jenis_pendaftaran'      => $request['id_jenis_pendaftaran'],
                    'id_peperiksaan'            => $peperiksaan->id,
                    'id_jenis_pembetulan'       =>  2, //for now 2 refer to stam
                    'id_penjenisan_bayaran'     =>  JenisBayaran::PEMBETULAN_MAKLUMAT_MP
                ],[
                    'no_resit'              => $data->RefNo,
                    'tarikh_resit'          => now('Asia/Kuala_Lumpur'),
                    'maklumat_asal'         => $request['maklumat_lama'],
                    'maklumat_baharu'       => $request['maklumat_baharu'],
                    'status_pembayaran'     => StatusPembayaran::ID_BELUM_BAYAR,
                    'id_status_permohonan'  => $status,
                    'jumlah_bayaran'        => $jumlah,
                    'url_bayaran'           => 'https://elp-lab.moe.gov.my/eportal/payment/' . $data->RefNo . '/gateway',
                    'url_status'            => 'https://elp-lab.moe.gov.my/eportal/payment/' . $data->RefNo . '/gateway'
                ]
            );
        });
    }


    public function pembayaranPembetulan($peperiksaan, $request){
        return DB::transaction(function () use($request, $peperiksaan) {

            $user =  CalonPembetulanMaklumat::where('id_calon',$request['id'])
                ->where('id_peperiksaan', $peperiksaan->id)
                ->firstOrFail();

                $res = app('PembayaranModule')
                ->setPeperiksaan($peperiksaan)
                ->setToken()
                ->setClient()
                ->getPembayaran($user);
                
                 $user->status_pembayaran = $res->PaymentStatus == 'success' ? 1 : 2;
                 $user->save();
                 return $user;
                    
        });
    }

    public function updateStatusPembetulan($peperiksaan, $request){

        return DB::transaction(function () use($peperiksaan, $request) {
            return CalonPembetulanMaklumat::where('id_calon', $request['id'])
                ->update(['id_status_permohonan' => StatusPengesahan::SAH]);
        }); 
    }

    public function permohonanPembatalan($peperiksaan, $request){

        return DB::transaction(function () use($peperiksaan, $request) {
            return CalonPembatalanPendaftaran::updateOrCreate([
                'id_calon'                  => $request['id'],
            ],[
                'no_kad_pengenalan_ibubapa' => $request['no_kad_pengenalan'] ?? $request['no_pengenalan_lain'],
                'nama_ibubapa'              => $request['nama'],
                'alasan_pembatalan'         => $request['sebab_pembatalan'],
                'id_status_pengesahan'      => StatusPengesahan::DALAM_PENGESAHAN_KPP_UPU
            ]);
        }); 
    }

    public function calonPembatalan($peperiksaan, $request){

        return DB::transaction(function () use($peperiksaan, $request) {
            return CalonPembatalanPendaftaran::with('calon','alamat','permohonan.pusat')
                ->whereHas('calon', function ($query) use ($peperiksaan) {
                    $query->where('id_peperiksaan', $peperiksaan->id);
                })
                ->where('id_calon',$request['id'])
                ->first();
        }); 
    }
    public function pengesahanPembatalan($peperiksaan, $request){

        return DB::transaction(function () use($peperiksaan, $request) {

            return CalonPembatalanPendaftaran::where('id_calon', $request['id'])
            ->update(['id_status_pengesahan' => $request['id_status_pengesahan']]);

        }); 
    }

    public function calonPembatalanStatus($peperiksaan, $request){
        return DB::transaction(function () use($peperiksaan, $request) {

            if($request['id_status_pengesahan']){
            return CalonPembatalanPendaftaran::with($this->pembatalanRelationships)
                 ->whereHas('calon', function ($query) use ($peperiksaan) {
                    $query->where('id_peperiksaan', $peperiksaan->id);
                })
                ->where('id_status_pengesahan', $request['id_status_pengesahan'])
                ->get();
            }
            else{
                return CalonPembatalanPendaftaran::with($this->pembatalanRelationships)
                ->whereHas('calon', function ($query) use ($peperiksaan) {
                    $query->where('id_peperiksaan', $peperiksaan->id);
                })
                ->where('id_calon', $request['id'])->get();
            }

        }); 
    }

    public function senaraiCalonDibatalkan($peperiksaan, $request){
        return DB::transaction(function () use($peperiksaan, $request) {
            return Calon::with($this->calonRelationships)
            ->where('id_peperiksaan', $peperiksaan->id)
            ->onlyTrashed()->get();
        }); 
    }

    public function pengesahanCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $calon = Calon::with($this->calonRelationships)->find($request->id_calon);

            if ($request->id_pusat && $calon->id_jenis_pendaftaran == JenisPendaftaran::PERSENDIRIAN) {
                $pusat = Pusat::findOrFail($request->id_pusat);

                $calon->angka_giliran           = $pusat->kod_pusat . str_pad($pusat->calon->count(), 3, '0', STR_PAD_LEFT);
                $calon->id_pusat                = (int) $request->id_pusat;
                $calon->permohonan->id_pusat    = (int) $request->id_pusat;

                $calon->save();
                $calon->permohonan->save();
            }
            else if ($calon->id_jenis_pendaftaran == JenisPendaftaran::PINDAH && $request->id_status_pengesahan == StatusPengesahan::SAH)
            {
                $calon->angka_giliran                           = $calon->pusat->kod_pusat . str_pad($calon->pusat->calon->count(), 3, '0', STR_PAD_LEFT);
                $calon->pusat->id_status_janaan_angka_giliran   = StatusJanaan::TELAH_DIJANA;


                $calon->pusat->save();
                $calon->save();
            }

            $this->isDaftarLewat($calon, $peperiksaan);

            $calon->permohonan()->updateOrCreate([
                'id_calon'              => $calon->id,
                'id_peperiksaan'        => $peperiksaan->id,
                'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
            ], [
                'id_status_pengesahan'  => $request->id_status_pengesahan
            ]);

            return $calon;
        });
    }

    public function statusPengesahan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            return Pusat::whereHas('tahunPeperiksaan.peperiksaan', function ($query) use ($peperiksaan) {
                $query->where('id', $peperiksaan->id);
            })->find($request->id_pusat);
        });
    }

    public function permohonanPendaftaranLewat($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $data = PermohonanPendaftaranLewat::whereHas('tahunPeperiksaan.peperiksaan', function ($query) use ($peperiksaan) {
                $query->where('id', $peperiksaan->id);
            })->find($request->id_pusat);


            return $data;
        });
    }

    public function pembayaranPendaftaranLewat($peperiksaan, $request)
    {   
        if($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM){
            return $this->pembayaran($peperiksaan, $request, JenisBayaran::CALON_LEWAT);
        }

        else if($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3){
            return $this->pembayaran($peperiksaan, $request, JenisBayaran::CALON_LEWAT_PT3);

        }
    }

    public function pembayaranPendaftaranPT3($peperiksaan, $request){

        if($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3){

            return $this->pembayaran($peperiksaan, $request, JenisBayaran::YURAN_PEPERIKSAAN_ASAS_PT3);
        }

    }

    public function pembayaranPermohonanPembetulan($peperiksaan, $request){
       return $this->pembayaran($peperiksaan, $request, JenisBayaran::PEMBETULAN_MAKLUMAT_CALON);
    }

    public function pembayaranPendaftaran($peperiksaan, $request){
        
        if($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_STAM){
            return $this->pembayaran($peperiksaan, $request, JenisBayaran::YURAN_PEPERIKSAAN_ASAS);
        } 
        else if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3){
            return $this->pembayaran($peperiksaan, $request, JenisBayaran::YURAN_PEPERIKSAAN_ASAS_PT3);

        }  
    }

    public function pembayaran($peperiksaan, $request, $jenisBayaran)
    { 
        $role =  Auth::user()->roles->first()->name;
        $pusat = null;

        if($role === 'Calon') {
            
            // check if user already make a payment
            $res = app('PembayaranModule')
                    ->setPeperiksaan($peperiksaan)
                    ->setRole($role)
                    ->setJumlahBayaran(JenisBayaran::find($jenisBayaran))
                    ->checkPembayaran(Auth::user(), $request->id_pusat);

        }elseif($role === 'SUP') {
            //check either pusat exist or not
          
            $pusat  = Pusat::where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                        ->where('id', $request->id_pusat)
                        ->first(); 

            if(!$pusat) {
                throw "This pusat is not acknowledge";
            }

            // check if user already make a payment
            if($jenisBayaran == JenisBayaran::CALON_LEWAT_PT3){

                $jumlahCalon = $request->jumlah_calon;

            } else{
            
                $jumlahCalon = $pusat->calon->count();
            }
            
                 $res = app('PembayaranModule')
                    ->setPeperiksaan($peperiksaan)
                    ->setRole($role)
                    ->setJumlahBayaran(JenisBayaran::find($jenisBayaran), $pusat->calon, $jumlahCalon)
                    ->checkPembayaran(Auth::user(), $request->id_pusat, $request->ids_calon);
                
        }

        // DB Transaction
        return DB::transaction(function () use($role, $res, $peperiksaan, $request, $jenisBayaran, $pusat) {

            // Calon Use Case
            if($role === 'Calon' && $res) {
                $response = app('PembayaranModule')
                    ->setPeperiksaan($peperiksaan)
                    ->setToken()
                    ->setClient()
                    ->getPembayaran($res);
                
                // update data
                return BayaranPendaftaranCalon::updateOrCreate([
                    'id_user'               => Auth::user()->id,
                    'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                    'id_calon'              => Auth::user()->calon->id,
                    'id_penjenisan_bayaran' => $jenisBayaran,
                ], [
                    'id_status_pembayaran'  => $response->PaymentStatus == 'success' ? 1 : 2,
                ]);

            }else if($role === 'Calon' && !$res){
                
                $response = app('PembayaranModule')
                    ->setPeperiksaan($peperiksaan)
                    ->setRef()
                    ->setToken()
                    ->setJumlahBayaran(JenisBayaran::find($jenisBayaran), Auth::user()->calon)
                    ->setClient()
                    ->pembayaran(Auth::user()->calon);
               
                // update data
                //dah check pembayaran, kalau xde record, buat record baru, no need updateorCreate
                return BayaranPendaftaranCalon::Create(
                    [
                        'id_user'               => Auth::user()->id,
                        'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        'id_penjenisan_bayaran' => $jenisBayaran,


                        'id_calon'              => Auth::user()->calon->id,
                        'id_status_pembayaran'  => StatusPembayaran::ID_BELUM_BAYAR,
                        'no_resit'              => $response->RefNo,
                        'tarikh_resit'          => Carbon::parse($response->created_at)->format('Y-m-d H:i:s'),
                        'jumlah_bayaran'        => $response->Jumlah,
                        'url_bayaran'           => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway',
                        'url_status'            => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway'
                    ]
                );

            }else if($role === 'SUP' && $res){
                
                $response = app('PembayaranModule')
                    ->setPeperiksaan($peperiksaan)
                    ->setToken()
                    ->setClient()
                    ->getPembayaran($res);

                // update data
                foreach((array)$request->ids_calon as $id) {
                    BayaranPendaftaranCalon::updateOrCreate([
                        'id_user'               => Auth::user()->id,
                        'id_pusat'              => $request->id_pusat,
                        'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        'id_calon'              => $id,
                        'id_penjenisan_bayaran' => $jenisBayaran,
                    ], [
                        'id_status_pembayaran'  => $response->PaymentStatus == 'success' ? 1 : 2,
                    ]);
                }

                return BayaranPendaftaranCalonSekolah::updateOrCreate([
                    'id_user'               => Auth::user()->id,
                    'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                    'id_pusat'              => $request->id_pusat,
                ], [
                    'id_status_pembayaran'  => $response->PaymentStatus == 'success' ? 1 : 2,
                ]);

            }else if($role == 'SUP' && !$res){

                if($jenisBayaran == JenisBayaran::CALON_LEWAT_PT3){

                    $jumlahCalon = $request->jumlah_calon;


                }else{
                    $jumlahCalon = $pusat->calon->count();

                }
                
                $response = app('PembayaranModule')
                    ->setPeperiksaan($peperiksaan)
                    ->setRef()
                    ->setToken()
                    ->setJumlahBayaran(JenisBayaran::find($jenisBayaran), $pusat->calon, $jumlahCalon)
                    ->setClient()
                    ->pembayaran(Auth::user()->kru);
                
                
                // update data
                foreach((array)$request->ids_calon as $id) {
                
                    BayaranPendaftaranCalon::updateOrCreate(

                        [   'id_pusat'              => $request->id_pusat,
                            'id_calon'              => $id,
                            'id_user'               => Auth::user()->id,
                            'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                            'id_penjenisan_bayaran' => $jenisBayaran
                        ],
                        [
                            'id_status_pembayaran'  => StatusPembayaran::ID_BELUM_BAYAR,
                            'no_resit'              => $response->RefNo,
                            'tarikh_resit'          => Carbon::parse($response->created_at)->format('Y-m-d H:i:s'),
                            'jumlah_bayaran'        => $response->Jumlah ?? 0,
                            'id_calon'              => $id,
                            'url_bayaran'           => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway',
                            'url_status'            => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway'
                        ]
                    );
            }
                
                return BayaranPendaftaranCalonSekolah::Create(

                    [
                        'id_pusat'              => $request->id_pusat,
                        'id_user'               => Auth::user()->id,
                        'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                        'id_penjenisan_bayaran' => $jenisBayaran,
                 
                        'id_status_pembayaran'  => StatusPembayaran::ID_BELUM_BAYAR,
                        'no_resit'              => $response->RefNo,
                        'tarikh_resit'          => Carbon::parse($response->created_at)->format('Y-m-d H:i:s'),
                        'jumlah_bayaran'        => $response->Jumlah ?? 0,
                        'jumlah_calon'          => $pusat->jumlah_calon,
                        'url_bayaran'           => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway',
                        'url_status'            => 'https://elp-lab.moe.gov.my/eportal/payment/' . $response->RefNo . '/gateway'
                    ]
                );
            }
        });
    }

    public function statusPembayaran($peperiksaan, $request)
    {

        return DB::transaction(function () use ($peperiksaan, $request) {
            $user = Auth::user();

            if ($user->hasRole(["SUP"])) {

                $bayaran = BayaranPendaftaranCalonSekolah::where('id_user', $user->id)
                    ->where('id_pusat', $request->id_pusat)
                    ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                    ->where('id_penjenisan_bayaran', JenisBayaran::YURAN_PEPERIKSAAN_ASAS)
                    ->first();
            } else {

                $bayaran = BayaranPendaftaranCalon::where('id_user', $user->id)
                    ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                    ->where('id_penjenisan_bayaran', JenisBayaran::YURAN_PEPERIKSAAN_ASAS)
                    ->first();

            }

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3) {
                $token = "elpportal608f9770b1037";
            } else {
                $token = "elpportal608f975a16136";
            }

            if ($bayaran) {

                $client = new Client([
                    'base_uri' => 'https://elp-lab.moe.gov.my/eportal/api/payment/' . $token . '/',
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json'
                    ],
                ]);

                $response = $client->post('apigetformrequest', [
                    'json' => [
                        "RefNo" => $bayaran->no_resit
                    ],
                ]);

                $data = json_decode($response->getBody()->getContents())->data;

                $bayaran->update([
                    'id_status_pembayaran'  => $data->PaymentStatus == 'success' ? 1 : 2,
                ]);
            }

            return $bayaran;
        });
    }

    public function daftar($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            $calonRequest                           = $request['calon']         ?? null;
            $permohonanRequest                      = $request['permohonan']    ?? null;

            $calon = Calon::updateOrCreate(
                [
                    'id_tahun_peperiksaan'          => $peperiksaan->id_tahun_peperiksaan_semasa,
                    'id_peperiksaan'                => $peperiksaan->id,
                    'no_kad_pengenalan'             => $calonRequest['no_kad_pengenalan'],
                    'no_janaan_lp'                  => $calonRequest['no_janaan_lp'] ?? null
                ],
                [
                    'id_pusat'                      => $permohonanRequest['id_pusat']               ?? 0,
                    'nama'                          => $calonRequest['nama']                        ?? '',
                    'nama_i18n'                     => $calonRequest['nama_i18n']                   ?? '',
                    'no_pengenalan_lain'            => $calonRequest['no_pengenalan_lain']          ?? '',
                    'emel'                          => $calonRequest['emel']                        ?? '',
                    'no_telefon'                    => $calonRequest['no_telefon']                  ?? '',
                    'tarikh_lahir'                  => $calonRequest['tarikh_lahir']                ?? '',
                    'id_keturunan'                  => $calonRequest['id_keturunan']                ?? '',
                    'id_agama'                      => $calonRequest['id_agama']                    ?? '',
                    'id_warganegara'                => $calonRequest['id_warganegara']              ?? '',
                    'id_negara'                     => $calonRequest['id_negara']                   ?? 1,
                    'id_jantina'                    => $calonRequest['id_jantina']                  ?? '',
                    'tahun_peperiksaan_terakhir'    => $calonRequest['tahun_peperiksaan_terakhir']  ?? 0,
                    'id_jenis_kecacatan'            => $calonRequest['id_jenis_kecacatan']          ?? 0,
                    'id_jenis_pendaftaran'          => $permohonanRequest['id_jenis_pendaftaran']   ?? 0,
                ]
            );

            $calon->permohonan()->updateOrCreate([
                'id_calon'              => $calon->id,
                'id_peperiksaan'        => $peperiksaan->id,
                'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
            ], [
                'id_pusat'              => $calon->pusat ? $calon->pusat->id : $request['permohonan']['id_pusat'],
                'id_kemasukan'          => (int) $permohonanRequest['id_kemasukan'],
                'tahun_peperiksaan_spm' => $permohonanRequest['tahun_peperiksaan_spm'] ?? 0,
                'angka_giliran_spm'     => $permohonanRequest['angka_giliran_spm'] ?? 0,
                'id_status_pengesahan'  => $request->id_status_pengesahan ?? 0,
            ]);

            $calon->alamat()->updateOrCreate(
                [
                    'id_calon'                      => $calon->id,
                ],
                [
                    'id_jenis_alamat'               => $calonRequest['jenis_alamat']    ?? 0,
                    'alamat'                        => $calonRequest['alamat']          ?? '',
                    'poskod'                        => $calonRequest['poskod']          ?? '',
                    'id_bandar'                     => $calonRequest['id_bandar']       ?? 0,
                    'id_negeri'                     => $calonRequest['id_negeri']       ?? 0,
                ]
            );

            if ($peperiksaan->id == Peperiksaan::ID_PEPERIKSAAN_PT3){

                $this->isDaftarLewatPt3($calon, $peperiksaan);
                
            }

            return $calon;
        });
    }

    public function kemaskini($peperiksaan, $request){;
        return DB::transaction(function () use ($peperiksaan, $request) {

            $calon = $this->calon->find($request['id_calon']);
            $pusat = Pusat::findOrFail($request['calon']['permohonan']['id_pusat']);

            $calon->update([

                'no_kad_pengenalan'             => $request['calon']['no_kad_pengenalan'] ?? null,
                'no_pengenalan_lain'            => $request['calon']['no_pengenalan_lain'] ?? null,
                'no_janaan_lp'                  => $request['calon']['no_janaan_lp'] ?? null,
                'nama'                          => $request['calon']['nama'],
                'nama_i18n'                     => $request['calon']['nama_i18n'],
                'emel'                          => $request['calon']['emel'],
                'tarikh_lahir'                  => $request['calon']['tarikh_lahir'],
                'no_telefon'                    => $request['calon']['no_telefon'],
                'id_keperluan_khas'             => $request['calon']['id_keperluan_khas'] ?? null,
                'no_kad_oku'                    => $request['calon']['no_kad_oku'] ?? null,
                'id_jantina'                    => $request['calon']['id_jantina'],
                'id_agama'                      => $request['calon']['id_agama'],
                'id_keturunan'                  => $request['calon']['id_keturunan'],
                'id_warganegara'                => $request['calon']['id_warganegara'],
                'id_negara'                     => $request['calon']['id_negara'],
                'tahun_peperiksaan_terakhir'    => $request['calon']['tahun_peperiksaan_terakhir'] ?? null,
                'angka_giliran_terkahir'        => $request['calon']['angka_giliran_terkahir'] ?? null,
                'id_pusat'                      => $request['calon']['permohonan']['id_pusat'],
                'angka_giliran'                 => $pusat->kod_pusat . str_pad($pusat->calon->count(), 3, '0', STR_PAD_LEFT)
            ]);

            $calon->permohonan()->updateOrCreate([
                'id_calon'              => $calon->id,
                'id_peperiksaan'        => $peperiksaan->id,
                'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
            ], [
                'id_pusat'              => $calon->pusat ? $calon->pusat->id : $request['calon']['permohonan']['id_pusat'],
                'id_kemasukan'          => (int) $request['calon']['permohonan']['id_kemasukan'],
                'tahun_peperiksaan_spm' => $request['calon']['permohonan']['tahun_peperiksaan_spm'],
                'angka_giliran_spm'     => $request['calon']['permohonan']['angka_giliran_spm'],
            ]);

            $calon->alamat()->updateOrCreate(
                [
                    'id_calon'                      => $calon->id,
                ],
                [
                    'id_jenis_alamat'               => $request['calon']['id_jenis_alamat'] ?? 0,
                    'alamat'                        => $request['calon']['alamat'],
                    'poskod'                        => $request['calon']['poskod'],
                    'id_negeri'                     => $request['calon']['id_negeri'],
                    'id_bandar'                     => $request['calon']['id_bandar'],
                ]

            );

            return $calon;
        });
    }

    public function kemaskiniPt3($peperiksaan, $request){;
        return DB::transaction(function () use ($peperiksaan, $request) {

            $calon = $this->calon->find($request['id_calon']);
            $pusat = Pusat::findOrFail($request['calon']['permohonan']['id_pusat']);

            $calon->update([

                'no_kad_pengenalan'             => $request['calon']['no_kad_pengenalan'] ?? null,
                'no_pengenalan_lain'            => $request['calon']['no_pengenalan_lain'] ?? null,
                'no_janaan_lp'                  => $request['calon']['no_janaan_lp'] ?? null,
                'nama'                          => $request['calon']['nama'],
                'emel'                          => $request['calon']['emel'],
                'tarikh_lahir'                  => $request['calon']['tarikh_lahir'],
                'no_telefon'                    => $request['calon']['no_telefon'],
                'id_keperluan_khas'             => $request['calon']['id_keperluan_khas'] ?? null,
                'no_kad_oku'                    => $request['calon']['no_kad_oku'] ?? null,
                'id_jantina'                    => $request['calon']['id_jantina'],
                'id_agama'                      => $request['calon']['id_agama'],
                'id_keturunan'                  => $request['calon']['id_keturunan'],
                'id_warganegara'                => $request['calon']['id_warganegara'],
                'id_negara'                     => $request['calon']['id_negara'],
                'tahun_peperiksaan_terakhir'    => $request['calon']['tahun_peperiksaan_terakhir'] ?? null,
                'angka_giliran_terkahir'        => $request['calon']['angka_giliran_terkahir'] ?? null,
                'id_pusat'                      => $request['calon']['permohonan']['id_pusat'],
                'angka_giliran'                 => $pusat->kod_pusat . str_pad($pusat->calon->count(), 3, '0', STR_PAD_LEFT)
            ]);

            $calon->permohonan()->updateOrCreate([
                'id_calon'              => $calon->id,
                'id_peperiksaan'        => $peperiksaan->id,
                'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
            ], [
                'id_pusat'              => $calon->pusat ? $calon->pusat->id : $request['calon']['permohonan']['id_pusat'],
            ]);

            $calon->alamat()->updateOrCreate(
                [
                    'id_calon'                      => $calon->id,
                ],
                [
                    'id_jenis_alamat'               => $request['calon']['id_jenis_alamat'] ?? 0,
                    'alamat'                        => $request['calon']['alamat'],
                    'poskod'                        => $request['calon']['poskod'],
                    'id_negeri'                     => $request['calon']['id_negeri'],
                    'id_bandar'                     => $request['calon']['id_bandar'],
                ]

            );

            return $calon;
        });
    }


    public function daftarAkaunCalonPT3($peperiksaan, $request)
    {   
        return DB::transaction(function () use ($peperiksaan, $request) {
            $emel = $request['emel'];
            $password = $request->password ?? Str::random(8);

            $user = User::with('calon')->updateOrCreate([
                'id_peperiksaan'        => $peperiksaan->id,
                'id_jenis_pengguna'     => JenisPengguna::ID_JENIS_PENGGUNA_CALON,
                'id_pengguna'           => $request['no_kad_pengenalan'] ?? $request['no_janaan_lp'],
            ], [
                'email'                 => $emel,
                'password'              => Hash::make($password),
                'email_verified_at'     => now(),
                'status'                => 1,
            ]);

            $calon = Calon::updateOrCreate(

                [
                    'id_peperiksaan'                => $peperiksaan->id,
                    'id_tahun_peperiksaan'          => $peperiksaan->id_tahun_peperiksaan_semasa,
                    'no_kad_pengenalan'             => $request['no_kad_pengenalan'],
                ],
                [
                    'id_user'                       => $user->id,
                    'nama'                          => $request['nama'],
                    'emel'                          => $request['emel'],
                    'no_telefon'                    => $request['no_telefon'],
                    'id_keturunan'                  => $request['id_keturunan']         ?? 0,
                    'id_jantina'                    => $request['id_jantina']           ?? 0,
                    'id_agama'                      => $request['id_agama']             ?? 0,
                    'id_warganegara'                => $request['id_warganegara']       ?? 0,
                    'id_jenis_pendaftaran'          => $request['id_jenis_pendaftaran'] ?? 6,
                    'angka_giliran'                 => $request['angka_giliran']        ?? null,

                ]

            );

            $calon->permohonan()->updateOrCreate([
                'id_calon'              => $calon->id,
                'id_peperiksaan'        => $peperiksaan->id,
                'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
            ], [
                'id_pusat'              => $calon->pusat ? $calon->pusat->id : null,
                'id_status_pengesahan'  => $request->id_status_pengesahan ?? StatusPengesahan::DALAM_PENGESAHAN,
                'id_negeri'             => $request->id_negeri,
                'tahun_peperiksaan_spm' => 0, //0 means dont have
                'angka_giliran_spm'     => 0,
            ]);

            $this->isDaftarLewatPt3($calon, $peperiksaan);

            $user->assignRole('Calon');

            DB::commit();

            $data = [
                'title' => 'Pendaftaran Calon',
                'emails' => $user->calon->emel,
                'nama' => $user->calon->nama,
                'no_kad_pengenalan' => $user->calon->no_kad_pengenalan,
                'id_pengguna' => $user->calon->no_kad_pengenalan,
                'kata_laluan' => $password,
                'token' => Crypt::encryptString($user->calon->id),
                'view' => 'emails.pendaftaranAkaunCalon'
            ];

            event(new SendEmailEvent($data));

            return $user->calon;
        });
    }

    public function daftarAkaunCalonSTAM($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {
            $password = $request->password ?? Str::random(8);

            $user = User::with('calon')->updateOrCreate([
                'id_peperiksaan'        => $peperiksaan->id,
                'id_jenis_pengguna'     => JenisPengguna::ID_JENIS_PENGGUNA_CALON,
                'id_pengguna'           => $request['no_kad_pengenalan'] ?? $request['no_janaan_lp'],
            ], [
                'email'                 => $request['emel'],
                'password'              => Hash::make($password),
                'email_verified_at'     => now(),
                'status'                => 1,
            ]);

            

            $calon = Calon::updateOrCreate(

                [
                    'id_peperiksaan'                => $peperiksaan->id,
                    'id_tahun_peperiksaan'          => $peperiksaan->id_tahun_peperiksaan_semasa,
                    'no_kad_pengenalan'             => $request['no_kad_pengenalan'] ?? null, 
                    'no_janaan_lp'                  => $request['no_janaan_lp'] ?? null,
                ],
                [
                    'no_pengenalan_lain'            => $request['no_pengenalan_lain'] ?? null,
                    'id_user'                       => $user->id,
                    'nama'                          => $request['nama'],
                    'emel'                          => $request['emel'],
                    'no_telefon'                    => $request['no_telefon'],
                    'id_keturunan'                  => $request['id_keturunan']         ?? 0,
                    'id_jantina'                    => $request['id_jantina']           ?? 0,
                    'id_agama'                      => $request['id_agama']             ?? 0,
                    'id_warganegara'                => $request['id_warganegara']       ?? 0,
                    'id_jenis_pendaftaran'          => $request['id_jenis_pendaftaran'] ?? 6,
                    'angka_giliran'                 => $request['angka_giliran']        ?? null,

                ]
            );

            $calon->permohonan()->updateOrCreate([
                'id_calon'              => $calon->id,
                'id_peperiksaan'        => $peperiksaan->id,
                'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
            ], [
                'id_pusat'              => $calon->pusat ? $calon->pusat->id : null,
                'id_negeri'             => $request->id_negeri,
                'tahun_peperiksaan_spm' => 0,
                'angka_giliran_spm'     => 0
            ]);

            $this->isDaftarLewat($calon, $peperiksaan);
           
            $user->assignRole('Calon');

            DB::commit();

            $id_pengguna =  $user->calon->no_kad_pengenalan == null ? $user->calon->no_janaan_lp : $user->calon->no_kad_pengenalan;
            $data = [
                'title' => 'Pendaftaran Calon',
                'emails' => [$user->calon->emel],
                'nama' => $user->calon->nama,
                'no_kad_pengenalan' => $user->id_pengguna,
                'id_pengguna' => $id_pengguna,
                'kata_laluan' => $password,
                'token' => Crypt::encryptString($user->calon->id),
                'view' => 'emails.pendaftaranAkaunCalon'
            ];

            event(new SendEmailEvent($data));

            return $user->calon;
        });
    }

    public function cetakanPendaftaran($request)
    {

        $calon = Calon::findOrFail($request->id_calon);

        // view()->share('calon', $calon);
        // $pdf = PDF::loadView('pdf.cetakan-pendaftaran', $calon );

        return view('pdf.cetakan-pendaftaran', compact('calon'));
    }

    public function cetakanLabelMeja($request)
    {

        $calon = Calon::findOrFail($request->id_calon);

        return view('pdf.cetakan-label-meja', compact('calon'));
    }

    public function permohonanPindahCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {
            return $this->daftarPermohonanPindahCalon($peperiksaan, $request);
        });
    }

    public function daftarPermohonanPindahCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {

            // $calonRequest                           = $request['senarai_calon']                 ?? null;
            $permohonanRequest                      = $request['permohonan_pindah']             ?? null;

            $calon = Calon::where('id' , '=', $permohonanRequest['id_calon'])
                ->where('id_peperiksaan', '=', Peperiksaan::ID_PEPERIKSAAN_STAM)
                ->where('id_pusat', '=', $permohonanRequest['id_pusat'])
                ->first();

            if ($permohonanRequest['id_jenis_pindah'] == 2)
            {
                $permohonanCalonPindahPusat = PermohonanCalonPindahPusat::updateOrCreate(
                    [
                        'id_peperiksaan'                    => $peperiksaan->id,
                        'id_tahun_peperiksaan'              => $peperiksaan->id_tahun_peperiksaan_semasa,
                        'id_calon'                          => $permohonanRequest['id_calon'],
                    ],
                    [
                        'id_pusat'                          => $permohonanRequest['id_pusat'],
                        'id_pusat_baharu'                   => (int) $permohonanRequest['id_pusat_baru'],
                        'id_status_pindah'                  => PermohonanCalonPindahPusat::PINDAH_KELUAR,
                        'id_jenis_pindah'                   => PermohonanCalonPindahPusat::PINDAH_MENUMPANG,
                        'id_status_pengesahan'              => StatusPengesahan::DALAM_PENGESAHAN_JPN_ASAL,
                    ]
                );

                $calon->update([
                    'id_pusat'                      => (int) $permohonanRequest['id_pusat_baru'],
                    'id_jenis_pendaftaran'          => JenisPendaftaran::PINDAH,
                ]);
            }
            else
            {
                $permohonanCalonPindahPusat = PermohonanCalonPindahPusat::updateOrCreate(
                    [
                        'id_peperiksaan'                    => $peperiksaan->id,
                        'id_tahun_peperiksaan'              => $peperiksaan->id_tahun_peperiksaan_semasa,
                        'id_calon'                          => $permohonanRequest['id_calon'],
                    ],
                    [
                        'id_pusat'                          => $permohonanRequest['id_pusat'],
                        'id_pusat_baharu'                   => (int) $permohonanRequest['id_pusat_baru'],
                        'id_status_pindah'                  => PermohonanCalonPindahPusat::PINDAH_KELUAR,
                        'id_jenis_pindah'                   => PermohonanCalonPindahPusat::PINDAH_PUSAT,
                        'id_status_pengesahan'              => StatusPengesahan::DALAM_PENGESAHAN_UMPK,
                    ]
                );

                $calon->update([
                    'id_pusat'                      => (int) $permohonanRequest['id_pusat_baru'],
                    'id_jenis_pendaftaran'          => JenisPendaftaran::PINDAH,
                ]);
            }
            
            return $permohonanCalonPindahPusat;
        });
    }

    public function senaraiPermohonanPindahCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request) {
            $data = PermohonanCalonPindahPusat
                ::whereHas('tahunPeperiksaan.peperiksaan', function ($query) use ($peperiksaan) {
                    $query->where('id', $peperiksaan->id);
                })
                ->when($request->id_calon, function ($query) use ($request) {
                    $query->where('id_calon', $request->id_calon);
                })
                ->when($request->id_tahun_peperiksaan, function ($query) use ($request) {
                    $query->where('id_tahun_peperiksaan', $request->id_tahun_peperiksaan);
                })
                ->when($request->id_status_pengesahan, function ($query) use ($request) {
                    $query->where('id_status_pengesahan', $request->id_status_pengesahan);
                })
                ->when($request->id_status_pindah, function ($query) use ($request) {
                    $query->where('id_status_pindah', $request->id_status_pindah);
                })
                ->when($request->id_jenis_pindah, function ($query) use ($request) {
                    $query->where('id_jenis_pindah', $request->id_jenis_pindah);
                })
                ->when($request->id_pusat, function ($query) use ($request) {
                    $query->where('permohonan__calon_pindah_pusat.id_pusat', $request->id_pusat);
                })
                ->when($request->angka_giliran, function ($query) use ($request) {
                    $query->where('calon.angka_giliran', $request->angka_giliran);
                })
                ->when($request->nama, function ($query) use ($request) {
                    $query->where('nama','LIKE', '%'.$request->nama.'%');
                })
                ->when($request->id_negeri ?? '', function ($query) use ($request) {
                    $query->whereHas('pusat.sekolah', function($query) use ($request) {
                        $query->where('id_negeri', $request->id_negeri ?? '');
                    });
                })
                ->when($request->id_negeri_masuk ?? '', function ($query) use ($request) {
                    $query->whereHas('pusatBaharu.sekolah', function($query) use ($request) {
                        $query->where('id_negeri', $request->id_negeri_masuk ?? '');
                    });
                })
                ->leftjoin('calon','permohonan__calon_pindah_pusat.id_calon','=','calon.id')
                ->with($this->permohonanCalonPindahPusatRelationship)
                ->get();
            
            return $data;
        });
    }

    public function pengesahanPermohonanPindahCalon($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $pengesahan = PermohonanCalonPindahPusat::where('id_calon', '=', $request['id_calon'])
                ->first();
            
            if ($request['current_user_role'] == 'UMPK') {
                if($request['id_status_pindah']) {
                    $pengesahan->id_status_pindah = $request['id_status_pindah'];
                    $pengesahan->id_status_pengesahan = StatusPengesahan::DALAM_PENGESAHAN_UMPK;
                    $pengesahan->save();

                } else {
                    $pengesahan->id_status_pindah = PermohonanCalonPindahPusat::PINDAH_KELUAR;
                    $pengesahan->id_status_pengesahan = StatusPengesahan::DALAM_PENGESAHAN_JPN_ASAL;
                    $pengesahan->save();
                }
            } elseif ($request['current_user_role'] == 'JPN') {

                // pindah keluar
                if ($request['status'] == 0) {

                    $pengesahan->id_status_pengesahan = StatusPengesahan::DALAM_PENGESAHAN_JPN_BARU;
                    $pengesahan->id_status_pindah = PermohonanCalonPindahPusat::PINDAH_MASUK;
                    $pengesahan->id_pusat_baharu = $request['id_pusat_baharu'];
                    $pengesahan->save();

                // pindah masuk
                } elseif ($request['status'] == 1 && $request['id_pusat_baharu'] != null) {

                    $pengesahan->id_status_pengesahan = StatusPengesahan::DALAM_PENGESAHAN_SUP_BARU;
                    $pengesahan->id_status_pindah = PermohonanCalonPindahPusat::PINDAH_MASUK;
                    $pengesahan->id_pusat_baharu = $request['id_pusat_baharu'];
                    $pengesahan->save();

                }
            } elseif ($request['current_user_role'] == 'SUP') {
                if ($request['id_status_pindah'] == 2) {

                    $calon = Calon::where('id' , '=', $request['id_calon'])
                        ->where('id_peperiksaan', '=', Peperiksaan::ID_PEPERIKSAAN_STAM)
                        ->first();
                    
                    $pusat = Pusat::find($request['id_pusat_baharu']);

                    if ($pusat->id_status_pendaftaran_calon == 3) {
                        $pusat->id_status_pendaftaran_calon = StatusPendaftaran::TIADA;
                    } else if ($pusat->id_status_pendaftaran_calon == 2) {
                        $pusat->id_status_pendaftaran_calon = StatusPendaftaran::BELUM_DAFTAR;
                    } else if ($pusat->id_status_pendaftaran_calon == 1) {
                        $pusat->id_status_pendaftaran_calon = StatusPendaftaran::TELAH_DAFTAR;
                    }

                    if ($request['id_pusat_baharu'] && $pusat->id_status_pendaftaran_calon == StatusPendaftaran::TIADA && $pengesahan->id_status_pengesahan = StatusPengesahan::DALAM_PENGESAHAN_SUP_BARU)
                    {
                        $calon->update([
                            'angka_giliran'                 => $pusat->kod_pusat . str_pad($pusat->calon->count(), 3, '0', STR_PAD_LEFT),
                            'id_jenis_pendaftaran'          => JenisPendaftaran::PINDAH,
                            'id_pusat'                      => $request['id_pusat_baharu'],
                        ]);

                        $pusat->id_status_pendaftaran_calon             = StatusPendaftaran::BELUM_DAFTAR;
                        $pusat->id_status_janaan_angka_giliran          = StatusJanaan::TELAH_DIJANA;

                        $pusat->save();

                    } else if ($request['id_pusat_baharu'] && ( $pusat->id_status_pendaftaran_calon == StatusPendaftaran::BELUM_DAFTAR || $pusat->id_status_pendaftaran_calon == StatusPendaftaran::TELAH_DAFTAR ) && $pengesahan->id_status_pengesahan = StatusPengesahan::DALAM_PENGESAHAN_SUP_BARU)
                    {
                        $calon->update([
                            'angka_giliran'                 => $pusat->kod_pusat . str_pad($pusat->calon->count(), 3, '0', STR_PAD_LEFT),
                            'id_jenis_pendaftaran'          => JenisPendaftaran::PINDAH,
                            'id_pusat'                      => $request['id_pusat_baharu'],
                        ]);

                        $pusat->id_status_pendaftaran_calon             = StatusPendaftaran::TELAH_DAFTAR;
                        $pusat->id_status_janaan_angka_giliran          = StatusJanaan::TELAH_DIJANA;

                        $pusat->save();
                    }

                    $calon->permohonan()->updateOrCreate([
                        'id_calon'              => $calon->id,
                        'id_peperiksaan'        => $peperiksaan->id,
                        'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,
                    ],[
                        'id_pusat'  => $request['id_pusat_baharu']
                    ]);

                    $pengesahan->id_status_pengesahan = StatusPengesahan::SAH;
                    $pengesahan->id_status_pindah = PermohonanCalonPindahPusat::PINDAH_COMPLETE;
                    $pengesahan->save();
                }
            }

            return $pengesahan;
        });
    }

    public function isDaftarLewat($calon, $peperiksaan){
         // if daftar lewat calon persendirian
         if($calon->id_jenis_pendaftaran == JenisPendaftaran::PERSENDIRIAN){
            $due = JadualKerja::find(3);
            $status = 4;
        }else{
            $due = JadualKerja::find(2);
            $status = 11;
        }

        $calonLewat = PermohonanPendaftaranLewat::find($calon->id);

        if ((isset($calonLewat->id_status_pengesahan) != StatusPengesahan::SAH) and !Carbon::now()->between($due['tarikh_mula'], $due['tarikh_tamat'])) {
            PermohonanPendaftaranLewat::updateOrCreate([
                'id_calon'  => $calon->id,
            ],[
                'id_pusat'  => $calon->id_pusat ?? null,
                'jumlah_calon'  => 1,
                'id_tahun_peperiksaan' => $peperiksaan->id_tahun_peperiksaan_semasa,
                'id_status_pengesahan'  => $status,
            ]);
        };
    }

    public function isDaftarLewatPt3($calon, $peperiksaan){
         
        if($calon->id_jenis_pendaftaran == JenisPendaftaran::PERSENDIRIAN){
            $due = JadualKerja::find(30); 
            $status = 4;
        }else{
            $due = JadualKerja::find(30); 
            $status = 4;
        }

        $calonLewat = PermohonanPendaftaranLewat::where('id_calon',$calon->id)->first();

        // if daftar lewat calon persendirian
        if(($calon->id_jenis_pendaftaran == JenisPendaftaran::PERSENDIRIAN) || ($calon->id_jenis_pendaftaran == JenisPendaftaran::BARU)){
            $due = JadualKerja::find(32);
            $status = 4;
        }else{
            // apdm go here
            $due = JadualKerja::find(32);
            $status = 4;
        }

        if($calonLewat == null){

            if ((isset($calonLewat->id_status_pengesahan) != StatusPengesahan::SAH) and !Carbon::now()->between($due['tarikh_mula'], $due['tarikh_tamat'])) {
                PermohonanPendaftaranLewat::updateOrCreate([
                    'id_calon'  => $calon->id,
                    ],
                    [
                    'id_pusat'  => $calon->id_pusat ?? null,
                    'jumlah_calon'  => 1,
                    'id_tahun_peperiksaan' => $peperiksaan->id_tahun_peperiksaan_semasa,
                    'id_status_pengesahan'  => $status,
                    ]);     
            };
        }    
    }

    public function cetakanCalonDibatalkan($id_peperiksaan){
        $exam = $id_peperiksaan == 1 ? 'PENTAKSIRAN TINGKATAN TIGA' : 'SIJIL TINGGI AGAMA MALAYSIA';
        $calonDibatalkan = $this->calon
        ->onlyTrashed()
        ->Where('id_peperiksaan', $id_peperiksaan)
        ->get();
        return view('pdf.cetakan-laporan-calon-dibatalkan', compact('calonDibatalkan', 'exam'));
        
    }

    public function cetakanPmc($id_peperiksaan){

        $exam = $id_peperiksaan == 1 ? 'PENTAKSIRAN TINGKATAN TIGA' : 'SIJIL TINGGI AGAMA MALAYSIA';
        $calonPmc = $this->calon
        ->with($this->calonRelationships)
        ->has('pembetulanCalon')
        ->where('id_peperiksaan', $id_peperiksaan)
        ->get();
            
        return view('pdf.cetakan-laporan-calon-pmc', compact('calonPmc', 'exam'));
            
        }
    

    public function cetakanLaporanCalon($peperiksaan, $id_jenis_pendaftaran){
        $title = null;
        $isSekolah = null;
        $isPersendirian = null;
        
        if ($id_jenis_pendaftaran == 'cs') { 
            $isSekolah = true;
            $title = 'Laporan Pendaftaran Calon Sekolah';
        }
        else if ($id_jenis_pendaftaran == 'cp') { 
            $isPersendirian = true;
            $title = 'Laporan Pendaftaran Calon Persendirian';
        }

        //calon stam
        if ($peperiksaan == 2) {
            $calon = $this->calon->where('id_peperiksaan', $peperiksaan)
            ->when($isSekolah, function ($query) {
                $query->wherein('id_jenis_pendaftaran', [1,2,3,4,5]);
            })
            ->when($isPersendirian, function ($query) {
                $query->wherein('id_jenis_pendaftaran', [6,7,8]);
            })
            ->get();
            return view('pdf.cetakan-laporan-calon', compact('calon', 'title'));
        }
        //Calon PT3
        if ($peperiksaan == 1) {
            $calon = $this->calon->where('id_peperiksaan', $peperiksaan)
            ->when($isSekolah, function ($query) {
                $query->wherein('id_jenis_pendaftaran', [1,2,3,4,5]);
            })
            ->when($isPersendirian, function ($query) {
                $query->wherein('id_jenis_pendaftaran', [6,7,8]);
            })
            ->get();
            return view('pdf.cetakan-laporan-calon', compact('calon', 'title'));
        }

    }
}
