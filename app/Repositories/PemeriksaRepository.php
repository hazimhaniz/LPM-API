<?php

namespace App\Repositories;

use App\Models\Pemeriksa\Permohonan;
use App\Models\Pemeriksa\AlamatJawapan;
use App\Models\Pemeriksa\AlamatSekolah;
use App\Models\Pemeriksa\AlamatRumah;
use App\Models\Pemeriksa\Perkhidmatan;
use App\Models\Pemeriksa\PermohonanKelulusaan;
use App\Models\Pemeriksa\PermohonanPengalamanMPStam;
use App\Models\Pemeriksa\PengalamanPetugas;
use App\Models\Pemeriksa\BorangJawapan;
use App\Models\Kru\Kru;
use App\Models\Status\StatusPengesahan;
use App\Models\Status\StatusKelulusan;
use App\Models\Status\StatusJanaan;
use App\Models\Pemeriksa\EmailContent;
use Illuminate\Support\Facades\DB;
use App\Events\SendEmailEvent;
class PemeriksaRepository extends BaseRepository
{

    private $permohonan;
    private $alamatJawapan;
    private $alamatSekolah;
    private $alamatRumah;
    private $perkhidmatan;
    private $permohonanKelulusaan;
    private $permohonanPengalamanMPStam;
    private $pengalamanPetugas;
    private $kru;
    private $borangJawapan;
    private $emailContent;

    public function __construct(
        Permohonan $permohonan,
        AlamatJawapan $alamatJawapan,
        AlamatSekolah $alamatSekolah,
        AlamatRumah $alamatRumah,
        Perkhidmatan $perkhidmatan,
        PermohonanKelulusaan $permohonanKelulusaan,
        PermohonanPengalamanMPStam $permohonanPengalamanMPStam,
        PengalamanPetugas $pengalamanPetugas,
        Kru $kru,
        BorangJawapan $borangJawapan,
        EmailContent $emailContent
    ){
        $this->permohonan                   = $permohonan;
        $this->alamatJawapan                = $alamatJawapan;
        $this->alamatSekolah                = $alamatSekolah;
        $this->alamatRumah                  = $alamatRumah;
        $this->perkhidmatan                 = $perkhidmatan;
        $this->permohonanKelulusaan         = $permohonanKelulusaan;
        $this->permohonanPengalamanMPStam   = $permohonanPengalamanMPStam;
        $this->pengalamanPetugas            = $pengalamanPetugas;
        $this->kru                          = $kru;
        $this->borangJawapan                = $borangJawapan;
        $this->emailContent                 = $emailContent;
        $this->PemeriksaRelationships   = [
          'Kru',
          'AlamatSekolah',
          'AlamatJawapan',
          'AlamatRumah',
          'PermohonanKelulusaan',
          'Perkhidmatan',
          'PermohonanPengalamanMPStam',
          'PengalamanPetugas',
          'statusPengesahan',
          'StatusKelulusan',
          'StatusJanaan',
          'EmailContent',
        ];
        $this->BorangJawapanRelationships  = [
          'AlamatSekolah',
          'AlamatRumah',
        ];
    }

    /*
    **  ========================== PEMERIKSA ==========================
    */

    public function permohonanPemeriksa($pemeriksa, $request)
    {
        return DB::transaction(function () use ($pemeriksa, $request)
        {

          // Table Kru update
          $kruUpdate       = $this->kru
          ->when($request->id_user ?? '', function ($query) use ($request) {
            $query->where('id_user', $request->id_user);
          })
          ->when($request->id_kru ?? '', function ($query) use ($request) {
            $query->where('id', $request->id_kru);
          })
          ->update(
            [
              'no_kad_pengenalan'         => $request->no_kad_pengenalan_baru,
              'no_pengenalan_lain'        => $request->no_kad_pengenalan_lama,
              'nama'                      => $request->nama,
              'tarikh_Lahir'              => $request->tarikh_Lahir,
            ]
          );
          // Table Pemeriksa
            $permohonanPem = $this->permohonan->create(
              [
                        'id_kru'                => $request->id_kru,
                        'id_user'               => $request->id_user,
                        'tahun'                 => $request->tahun,
                        'status_permohonan_pertama'       => StatusPengesahan::TIDAK_SAH,
                        'status_pelawaan'                 => 0,
                        'status_pemeriksa_lain'           => 0,
                        'id_malatapelajaran_lain'         => 0,
                        'tahun_memeriksa'                 => date('Y'),
                        'status_kelulusan'                => 2,
                        'status_kelulusan_janaan'         => StatusJanaan::BELUM_DIJANA,
                        'status_janaan'                   => StatusJanaan::BELUM_DIJANA,
              ]
            );

            $pemeriksa_id      = $permohonanPem->id;

          // Table Pemeriksa alamat jawapan
            $alamatJawapanPem = $this->alamatJawapan->create(
            [
              'id_kru'                => $request->id_kru,
              'id_user'               => $request->id_user,
              'id_pemeriksa'          => $pemeriksa_id,
              'alamat_1'              => $request->jawapan_alamat_1,
              'alamat_2'              => $request->jawapan_alamat_2,
              'alamat_3'              => $request->jawapan_alamat_3,
              'poskod'                => $request->jawapan_poskod,
              'id_bandar'             => $request->jawapan_id_bandar,
              'id_negeri'             => $request->jawapan_id_negeri,
            ]
        );

        // Table Pemeriksa alamat rumah
          $alamatRumahPem   = $this->alamatRumah->create(
            [
              'id_kru'                        => $request->id_kru,
              'id_user'                       => $request->id_user,
              'id_pemeriksa'                  => $pemeriksa_id,
              'alamat_1'                      => $request->rumah_alamat_1,
              'alamat_2'                      => $request->rumah_alamat_2,
              'alamat_3'                      => $request->rumah_alamat_3,
              'poskod'                        => $request->rumah_poskod,
              'id_bandar'                     => $request->rumah_id_bandar,
              'id_negeri'                     => $request->rumah_id_negeri,
              'no_telefon_rumah'              => $request->rumah_no_telefon,
              'no_telefon_bimbit'             => $request->rumah_no_telefon_bimbit,
              'no_emel'                       => $request->rumah_no_emel,
              'no_cukai_pendapatan'           => $request->no_cukai_pendapatan,
            ]
          );
         // Table Pemeriksa alamat sekolah
          $alamatSekolahPem   = $this->alamatSekolah->create(
            [
              'id_kru'                        => $request->id_kru,
              'id_user'                       => $request->id_user,
              'id_pemeriksa'                  => $pemeriksa_id,
              'alamat_1'                      => $request->sekolah_alamt_1,
              'alamat_2'                      => $request->sekolah_alamt_2,
              'alamat_3'                      => $request->sekolah_alamt_3,
              'poskod'                        => $request->sekolah_poskod,
              'id_bandar'                     => $request->sekolah_bandar,
              'id_negeri'                     => $request->sekolah_negeri,
              'kod_sekolah'                   => $request->sekolah_kod,
              'no_sekolah'                    => $request->sekolah_telefon_no,
            ]
          );
        // Table kru perkhidmatan
        if(!empty($request->perkhidmatan))
        {
          $perkhidmatan[]   = $request->perkhidmatan;
          foreach($perkhidmatan as $pk)
          {
            for($k=0; $k < sizeof($pk); $k++)
            {
              $perkhidmatanPem   = $this->perkhidmatan->create(
                  [
                    'id_kru'                       => $request->id_kru,
                    'id_user'                      => $request->id_user,
                    'id_pemeriksa'                 => $pemeriksa_id,
                    'jawatan'                      => $pk[$k]['perkhidmatan_jawatan'],
                    'gred_jawatan'                 => $pk[$k]['perkhidmatan_gred_jawatan'],
                    'tetap_sandaran'               => $pk[$k]['perkhidmatan_tetap_sandaran'],
                    'tarikh_bersara'               => $pk[$k]['perkhidmatan_tarikh_bersara'],
                  ]
              );
            }
          }
        }

        // Table kru Permohonan kelulusan
        $permohonanKelulusaanPem  = $this->permohonanKelulusaan->create(
            [
              'id_kru'                        => $request->id_kru,
              'id_user'                       => $request->id_user,
              'id_pemeriksa'                  => $pemeriksa_id,
              'kelulusan_akademik_tertinggi'  => $request->kelulusan_akademik_tertinggi,
              'grade_akademik_tertinggi'      => $request->grade_akademik_tertinggi,
              'tahun_akademik_tertinggi'      => $request->tahun_akademik_tertinggi,
              'kelulusan_ikhtisas'            => $request->kelulusan_ikhtisas,
              'grade_ikhtisas'                => $request->grade_ikhtisas,
              'tahun_ikhtisas'                => $request->tahun_ikhtisas,
              'kelulusan_mp_utama'            => $request->kelulusan_mp_utama,
              'grade_mp_utama'                => $request->grade_mp_utama,
              'tahun_mp_utama'                => $request->tahun_mp_utama,
            ]
        );

        // Table Kru Permohonan pengalaman_mp_stam
        if(!empty($request->metapelajaran))
        {
          $metapelajaran[]   = $request->metapelajaran;
          foreach($metapelajaran as $mp)
          {
            for($i=0; $i < sizeof($mp); $i++)
            {
              $permohonanPengalamanMPStamPem  = $this->permohonanPengalamanMPStam->create(
                  [
                    'id_kru'                       => $request->id_kru,
                    'id_user'                      => $request->id_user,
                    'id_pemeriksa'                 => $pemeriksa_id,
                    'id_matapelajaran'             => $mp[$i]['id_metapelajaran'],
                    'darjah_tingkatan'             => $mp[$i]['darjah_tingkatan'],
                    'tahun_mula'                   => $mp[$i]['metapelajaran_tahun_mula'],
                    'tahun_tamat'                  => $mp[$i]['metapelajaran_tahun_tamat'],
                  ]
              );
            }
          }
        }

        // Table Kru Pengalaman Petugas peperiksaan
        if(!empty($request->peperiksaanJawatan))
        {
          $peperiksaanJawatan[]   = $request->peperiksaanJawatan;
          foreach($peperiksaanJawatan as $pp)
          {
            for($j=0; $j < sizeof($pp); $j++)
            {
              $pengalamanPetugasPem         = $this->pengalamanPetugas->create(
                  [
                    'id_kru'                      => $request->id_kru,
                    'id_user'                     => $request->id_user,
                    'id_pemeriksa'                => $pemeriksa_id,
                    'jawatan_nama'                => $pp[$j]['jawatan_nama'],
                    'nama_peperiksaan'            => $pp[$j]['nama_peperiksaan'],
                    'nama_matapelajaran'          => $pp[$j]['nama_metapelajaran'],
                    'tahun_mula'                  => $pp[$j]['jawatan_tahun_mula'],
                    'tahun_hingga'                => $pp[$j]['jawatan_tahun_hingga'],
                  ]
              );
            }
          }
        }

        return $pemeriksa_id;
        });
    }

    public function senaraiPermohonanPemeriksa($pemeriksa, $request)
    {
      return DB::transaction(function () use ($pemeriksa, $request)
        {
          $data = $this->permohonan
          ->when($request->id_user ?? '', function ($query) use ($request) {
            $query->where('id_user', $request->id_user);
          })
          ->when($request->id ?? '', function ($query) use ($request) {
            $query->where('id', $request->id);
          })
          ->with($this->PemeriksaRelationships)
          ->get();
          return $data;
        });
    }
    // kemaskini permohonan pemeriksa
    public function kemaskiniPermohonanPemeriksa($pemeriksa, $request)
    {
      return DB::transaction(function () use ($pemeriksa, $request)
        {
           // Table Kru update
           $kruUpdate       = $this->kru
           ->when($request->id_user ?? '', function ($query) use ($request) {
             $query->where('id_user', $request->id_user);
           })
           ->when($request->id_kru ?? '', function ($query) use ($request) {
             $query->where('id', $request->id_kru);
           })
           ->update(
             [
               'no_kad_pengenalan'         => $request->no_kad_pengenalan_baru,
               'no_pengenalan_lain'        => $request->no_kad_pengenalan_lama,
               'nama'                      => $request->nama,
               'tarikh_Lahir'              => $request->tarikh_Lahir,
             ]
           );
          // Table sekolah alamt jawapan
          $alamatSekolahPem  = $this->alamatSekolah
          ->when($request->id_pemeriksa ?? '', function ($query) use ($request) {
            $query->where('id_pemeriksa', $request->id_pemeriksa);
          })
          ->update(
            [
              'alamat_1'              => $request->sekolah_alamt_1,
              'alamat_2'              => $request->sekolah_alamt_2,
              'alamat_3'              => $request->sekolah_alamt_3,
              'kod_sekolah'           => $request->sekolah_kod,
              'no_sekolah'            => $request->sekolah_telefon_no,
              'poskod'                => $request->sekolah_poskod,
              'id_bandar'             => $request->sekolah_bandar,
              'id_negeri'             => $request->sekolah_negeri,
            ]
          );
          // Table Pemeriksa alamt jawapan
            $alamatJawapanPem = $this->alamatJawapan
            ->when($request->id_pemeriksa ?? '', function ($query) use ($request) {
              $query->where('id_pemeriksa', $request->id_pemeriksa);
            })
            ->update(
                          [
                            'alamat_1'              => $request->jawapan_alamat_1,
                            'alamat_2'              => $request->jawapan_alamat_2,
                            'alamat_3'              => $request->jawapan_alamat_3,
                            'poskod'                => $request->jawapan_poskod,
                            'id_bandar'             => $request->jawapan_id_bandar,
                            'id_negeri'             => $request->jawapan_id_negeri,
                          ]
                      );

        // Table Pemeriksa alamt rumah
          $alamatRumahPem   = $this->alamatRumah
          ->when($request->id_pemeriksa ?? '', function ($query) use ($request) {
            $query->where('id_pemeriksa', $request->id_pemeriksa);
          })
          ->update(
                  [
                    'alamat_1'                      => $request->rumah_alamat_1,
                    'alamat_2'                      => $request->rumah_alamat_2,
                    'alamat_3'                      => $request->rumah_alamat_3,
                    'poskod'                        => $request->rumah_poskod,
                    'id_bandar'                     => $request->rumah_id_bandar,
                    'id_negeri'                     => $request->rumah_id_negeri,
                    'no_telefon_rumah'              => $request->rumah_no_telefon,
                    'no_telefon_bimbit'             => $request->rumah_no_telefon_bimbit,
                    'no_emel'                       => $request->rumah_no_emel,
                    'no_cukai_pendapatan'           => $request->no_cukai_pendapatan,
                  ]
                );

        // Table kru Permohonan kelulusaan
        $permohonanKelulusaanPem  = $this->permohonanKelulusaan
        ->when($request->id_pemeriksa ?? '', function ($query) use ($request) {
          $query->where('id_pemeriksa', $request->id_pemeriksa);
        })
        ->update(
            [
              'kelulusan_akademik_tertinggi'  => $request->kelulusan_akademik_tertinggi,
              'grade_akademik_tertinggi'      => $request->grade_akademik_tertinggi,
              'tahun_akademik_tertinggi'      => $request->tahun_akademik_tertinggi,
              'kelulusan_ikhtisas'            => $request->kelulusan_ikhtisas,
              'grade_ikhtisas'                => $request->grade_ikhtisas,
              'tahun_ikhtisas'                => $request->tahun_ikhtisas,
              'kelulusan_mp_utama'            => $request->kelulusan_mp_utama,
              'grade_mp_utama'                => $request->grade_mp_utama,
              'tahun_mp_utama'                => $request->tahun_mp_utama,
            ]
        );

        // Table Kru Permohonan pengalaman_mp_stam
        if(!empty($request->metapelajaran))
        {
          $metapelajaran[]   = $request->metapelajaran;
          foreach($metapelajaran as $mp)
          {
            for($i=0; $i < sizeof($mp); $i++)
            {
            $permohonanPengalamanMPStamPem  = $this->permohonanPengalamanMPStam
            ->when($request->id_pemeriksa ?? '', function ($query) use ($request) {
              $query->where('id_pemeriksa', $request->id_pemeriksa);
            })
            ->where('id', $mp[$i]['id'])
            ->update(
              [
                'id_matapelajaran'             => $mp[$i]['id_metapelajaran'],
                'darjah_tingkatan'             => $mp[$i]['darjah_tingkatan'],
                'tahun_mula'                   => $mp[$i]['metapelajaran_tahun_mula'],
                'tahun_tamat'                  => $mp[$i]['metapelajaran_tahun_tamat'],
              ]
            );
            }
          }
        }

        //Table kru perkhidmatan
        if(!empty($request->perkhidmatan))
        {
          $perkhidmatan[]   = $request->perkhidmatan;
          foreach($perkhidmatan as $pk)
          {
            for($k=0; $k < sizeof($pk); $k++)
            {
              $perkhidmatanPem   = $this->perkhidmatan
              ->when($request->id_pemeriksa ?? '', function ($query) use ($request) {
                $query->where('id_pemeriksa', $request->id_pemeriksa);
              })
              ->where('id', $pk[$k]['id'])
              ->update(
                [
                  'jawatan'                      => $pk[$k]['perkhidmatan_jawatan'],
                  'gred_jawatan'                 => $pk[$k]['perkhidmatan_gred_jawatan'],
                  'tetap_sandaran'               => $pk[$k]['perkhidmatan_tetap_sandaran'],
                  'tarikh_bersara'               => $pk[$k]['perkhidmatan_tarikh_bersara'],
                ]
            );
          }
          }
        }

        // Table Kru Petugas peperiksaan
        if(!empty($request->peperiksaanJawatan))
        {
          $peperiksaanJawatan[]   = $request->peperiksaanJawatan;
          foreach($peperiksaanJawatan as $pp)
          {
            for($j=0; $j < sizeof($pp); $j++)
            {
            $pengalamanPetugasPem         = $this->pengalamanPetugas
            ->when($request->id_pemeriksa ?? '', function ($query) use ($request) {
              $query->where('id_pemeriksa', $request->id_pemeriksa);
            })
            ->where('id', $pp[$j]['id'])
            ->update(
                [
                  'jawatan_nama'                => $pp[$j]['jawatan_nama'],
                  'nama_peperiksaan'            => $pp[$j]['nama_peperiksaan'],
                  'nama_metapelajaran'          => $pp[$j]['nama_metapelajaran'],
                  'tahun_mula'                  => $pp[$j]['jawatan_tahun_mula'],
                  'tahun_hingga'                => $pp[$j]['jawatan_tahun_hingga'],
                ]
            );
          }
          }
        }
    //     return $request->id_pemeriksa;
    //     });

    // }
     // status update
     if(!empty($request->status_permohonan_pertama))
     {
       $permohonanPem = $this->permohonan
       ->where('id', $request->id_pemeriksa)
       ->update(
         [
                   'status_permohonan_pertama'       => $request->status_permohonan_pertama,
         ]
       );
     }
     if(!empty($request->status_kelulusan))
     {
       $permohonanPem = $this->permohonan
       ->where('id', $request->id_pemeriksa)
       ->update(
         [
                   'id_malatapelajaran_lain' => $request->id_metapelajaran_lain,
                   'status_kelulusan'       => $request->status_kelulusan,
         ]
       );
     }
     if(!empty($request->tajuk_emel))
     {
       $email  = $this->emailContent->updateOrCreate
       (
         [
                   'id'               => $request->id_emel,
         ],
         [
                   'id_user'          => $request->id_user,
                   'id_kru'           => $request->id_kru,
                   'id_pemeriksa'     => $request->id_pemeriksa,
                   'tajuk_emel'       => $request->tajuk_emel,
                   'kandungan_emel'   => $request->kandungan_emel,
                   'tambahan_kandungan_emel' => $request->tambahan_kandungan_emel,
                   'kod_status'       => $request->kod_status,
                   'status'           => 2,
         ]
       );
       $email_id  =  $email->id ?? $request->id_emel;
       $emaildata = [
         'title' => $this->decode_html($request->tajuk_emel),
         'emails' => [$request->rumah_no_emel],
         'tajuk_emel'       => $this->decode_html($request->tajuk_emel),
         'kandungan_emel'   => $this->decode_html($request->kandungan_emel),
         'tambahan_kandungan_emel' => $this->decode_html($request->tambahan_kandungan_emel),
         'view' => 'emails.pemeriksaLatihan'
     ];
     if(event(new SendEmailEvent($emaildata)))
     {
        $this->emailContent
         ->where('id',$email_id)
         ->update(
         [
           'status'           => 1,
         ]
       );
       if($request->kod_status == "KOD_LATIHAN")
       {
       $this->permohonan
       ->where('id', $request->id_pemeriksa)
       ->update(
         [
               'status_kelulusan_janaan'       => 1,
         ]
       );}
       if($request->kod_status == "KOD_PELAWAAN"){
       $this->permohonan
       ->where('id', $request->id_pemeriksa)
       ->update(
         [
               'status_janaan'       => 1,
         ]
       );}
     }

     }
    //  }
    //  if(!empty($request->status_janaan))
    //  {
    //    $permohonanPem = $this->permohonan
    //    ->where('id', $request->id_pemeriksa)
    //    ->update(
    //      [
    //                'status_janaan'       => $request->status_janaan,
    //      ]
    //    );
    //  }
     return $request->id_pemeriksa;
     });

 }

 // borang jawapan
 public function borangJawapan($borang, $request)
 {
   return DB::transaction(function () use ($borang, $request)
     {
       // Table Pemeriksa
       $borangPem = $this->borangJawapan->create(
         [
           'id_user'                  => $request->id_user,
           'id_kru'                   => $request->id_kru,
           'id_pemeriksa'             => $request->id_pemeriksa,
           'kod_kertas'               => $request->kod_kertas,
           'kod_sek'                  => $request->kod_sek,
           'alamat_sek_1'             => $request->alamat_sek_1,
           'alamat_sek_2'             => $request->alamat_sek_2,
           'alamat_sek_3'             => $request->alamat_sek_3,
           'poskod'                   => $request->poskod,
           'no_faks_sek'              => $request->no_faks_sek,
           'no_tel_sek'               => $request->no_tel_sek,
           'alamat_rmh_1'             => $request->alamat_rmh_1,
           'alamat_rmh_2'             => $request->alamat_rmh_2,
           'alamat_rmh_3'             => $request->alamat_rmh_3,
           'ic_no'                    => $request->ic_no,
           'no_tel'                   => $request->no_tel,
           'kelulusan_akademik'       => $request->kelulusan_akademik,
           'gred_jawatan'             => $request->gred_jawatan,
           'pengalaman_memeriksa'     => $request->pengalaman_memeriksa,
           'pengalaman_memeriksa_hingga' => $request->pengalaman_memeriksa_hingga,
           'subject_ngajar'           => json_encode($request->subject_ngajar) ?? [],
           'subject_lain'             => $request->subject_lain,
           'mata_pelajaran'           => $request->meta_pelajaran,
           'tahun_ngajar'             => $request->tahun_ngajar,
           'status'                   => $request->status
         ]
       );
       return $borangPem->id;

     });
 }
 // senarai borang jawapan
 public function senaraiBorangJawapan($borang, $request)
 {
   return DB::transaction(function () use ($borang, $request)
     {
       $data = $this->borangJawapan
       ->when($request->id_user ?? '', function ($query) use ($request) {
         $query->where('id_user', $request->id_user);
       })
       ->get();
       return $data;
     });
 }
 // kemaskini borang jawapan
 public function kemaskiniBorangJawapan($borang, $request)
 {
   return DB::transaction(function () use ($borang, $request)
     {
       // Table Pemeriksa
       $borangPem = $this->borangJawapan
       ->when($request->id_user ?? '', function ($query) use ($request) {
         $query->where('id_user', $request->id_user);
       })
       ->when($request->id ?? '', function ($query) use ($request) {
         $query->where('id', $request->id);
       })
       ->update(
         [
           'id_user'                  => $request->id_user,
           'id_kru'                   => $request->id_kru,
           'id_pemeriksa'             => $request->id_pemeriksa,
           'kod_kertas'               => $request->kod_kertas,
           'kod_sek'                  => $request->kod_sek,
           'alamat_sek_1'             => $request->alamat_sek_1,
           'alamat_sek_2'             => $request->alamat_sek_2,
           'alamat_sek_3'             => $request->alamat_sek_3,
           'poskod'                   => $request->poskod,
           'no_faks_sek'              => $request->no_faks_sek,
           'no_tel_sek'               => $request->no_tel_sek,
           'alamat_rmh_1'             => $request->alamat_rmh_1,
           'alamat_rmh_2'             => $request->alamat_rmh_2,
           'alamat_rmh_3'             => $request->alamat_rmh_3,
           'ic_no'                    => $request->ic_no,
           'no_tel'                   => $request->no_tel,
           'kelulusan_akademik'       => $request->kelulusan_akademik,
           'gred_jawatan'             => $request->gred_jawatan,
           'pengalaman_memeriksa'     => $request->pengalaman_memeriksa,
           'pengalaman_memeriksa_hingga' => $request->pengalaman_memeriksa_hingga,
           'subject_ngajar'           => json_encode($request->subject_ngajar) ?? [],
           'subject_lain'             => $request->subject_lain,
           'mata_pelajaran'           => $request->meta_pelajaran,
           'tahun_ngajar'             => $request->tahun_ngajar,
           'status'                   => $request->status
         ]
       );
       return $request->id;

     });
 }
 // Borang Jawapan pemeriksa rekod
 public function pemeriksaRekod($borang, $request)
 {
   return DB::transaction(function () use ($borang, $request)
     {
       $data = $this->permohonan
       ->when($request->id_user ?? '', function ($query) use ($request) {
         $query->where('id_user', $request->id_user);
       })
       ->when($request->tahun ?? '', function ($query) use ($request) {
         $query->where('tahun', $request->tahun);
       })
       ->where('status_permohonan_pertama', 1)
       ->where('status_pelawaan', 1)
       ->with($this->BorangJawapanRelationships)
       ->get();
       return $data;
     });
  }
  //Borang Pendaftran Pemeriksa rekod
  public function pendaftaranpemeriksaRekod($pemeriksa, $request)
  {
     return DB::transaction(function () use ($pemeriksa,$request)
     {
      $data = $this->permohonan
        ->when($request->id_user ?? '', function ($query) use ($request) {
          $query->where('id_user', $request->id_user);
        })
        ->when($request->tahun ?? '', function ($query) use ($request) {
          $query->where('tahun', $request->tahun);
        })
        ->where('status_permohonan_pertama', 1)
        ->with($this->PendaftaranPemeriksaRelationship)
        ->get();
        return $data;
      });
  }
     // status Pengesahan
     public function statusPengesahanRekod($pemeriksa, $request)
     {
       $data = StatusPengesahan::select('id', 'keterangan')
                 ->get();
         return $data;
     }
     // status kelulusan
     public function statusKelulusanRekod($pemeriksa, $request)
     {
       $data = StatusKelulusan::select('id', 'keterangan')
                 ->get();
         return $data;
     }
     // status janaan 
     public function statusJanaanRekod($pemeriksa, $request)
     {
       $data = StatusJanaan::select('id', 'keterangan')
                 ->get();
         return $data;
     }
     public function clear_tags($str)
     {
         return htmlentities(
             strip_tags(
                 $str,
                 '<span><div><a><br><p><b><i><u><img><blockquote><small><ul><ol><li><hr><big><pre><code><strong><em><table><tr><td><th><tbody><thead><tfoot><h3><h4><h5><h6>'
             ),
             ENT_QUOTES | ENT_XHTML | ENT_HTML5,
             'UTF-8'
         );
     }
     public function decode_html($str)
     {
         return html_entity_decode($str, ENT_QUOTES | ENT_XHTML | ENT_HTML5, 'UTF-8');
     }
 

}