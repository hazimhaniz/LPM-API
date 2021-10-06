<?php

namespace App\Repositories;

use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Permohonan\PermohonanPendaftaranLewat;
use App\Models\Permohonan\PermohonanPusat;
use App\Models\Status\StatusPendaftaran;
use App\Models\Status\StatusPengesahan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PusatPeperiksaanRepository extends BaseRepository
{

    private $pusat;
    private $pusatRelationships;

    private $permohonanPusat;
    private $permohonanPusatRelationships;
    private $permohonanPusatLewatRelationships;
    private $calonRepository;

    public function __construct(
        Pusat $pusat,
        PermohonanPusat $permohonanPusat,
        CalonRepository $calonRepository
    ){
        $this->pusat                = $pusat;
        $this->permohonanPusat      = $permohonanPusat;
        $this->calonRepository      = $calonRepository;

        $this->pusatRelationships   = [
            'sekolah.kru',
            'tahunPeperiksaan',
            'statusPendaftaran',
            'jenisCalon',
            'bayaran',
            'daftarLewat.statusPengesahan',
            'calon.permohonanDaftarLewat',
            'calon.bayaran',
            'calon.permohonan',
        ];

        $this->permohonanPusatRelationships  = [
            'sekolah',
            'tahunPeperiksaan',
            'statusPengesahan',
            'pusat.statusPendaftaran',
        ];

        $this->permohonanPusatLewatRelationships  = [
            'tahunPeperiksaan',
            'statusPengesahan',
            'pusat.statusPendaftaran',
            'calon',
            'bayaranPusat',
            'bayaranCalon',
        ];
    }

    /*
    **  ========================== PERMOHONAN PUSAT ==========================
    */

    public function permohonanPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $permohonan = $this->permohonanPusat->create
                (
                    [
                        'id_peperiksaan'        => $peperiksaan->id,
                        'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                        'id_sekolah'            => $request->id_sekolah,
                        "bekalan_elektrik"      => $request->bekalan_elektrik   ?? '',
                        "bangku_calon"          => $request->bangku_calon       ?? '',
                        "bekalan_air"           => $request->bekalan_air        ?? '',
                        "meja_calon"            => $request->meja_calon         ?? '',
                        "telefon"               => $request->telefon            ?? '',
                        "tandas"                => $request->tandas             ?? '',
                        'alasan'                => $request->alasan             ?? '',

                        'id_status_pengesahan'  => StatusPengesahan::DALAM_PENGESAHAN_PENGETUA_SEKOLAH,
                    ]
                );

            $permohonan = $permohonan
                            ->with($this->permohonanPusatRelationships)
                            ->find($permohonan->id);

            return $permohonan;
        });
    }

    public function kemaskiniPermohonanPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $permohonan = $this->permohonanPusat->with($this->permohonanPusatRelationships)->find($request->id_permohonan_pusat);

            if($request->id_status_pengesahan)
            {
                $permohonan->id_status_pengesahan   = $request->id_status_pengesahan;
                $permohonan->save();
            }

            return $permohonan;
        });
    }

    public function pengesahanPermohonanPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $permohonan = $this->permohonanPusat->with($this->permohonanPusatRelationships)->find($request->id_permohonan_pusat);

            $pusat = $this->pusat->updateOrCreate
            (
                [
                    'id'                        => $permohonan->id_pusat,
                ],
                [
                    'id_tahun_peperiksaan'      => $peperiksaan->id_tahun_peperiksaan_semasa,
                    'id_sekolah'                => $request->id_sekolah         ?? 0,
                    'no_sekolah'                => $request->no_sekolah         ?? 0,
                    'kod_pusat'                 => $request->kod_pusat          ?? '',
                    'id_jenis_calon'            => $request->id_jenis_calon     ?? 0,

                    'nama_pusat'                => $request->nama_pusat         ?? null,
                    'nama_pusat_i18n'           => $request->nama_pusat_i18n    ?? null,
                    'jumlah_calon'              => $request->jumlah_calon       ?? 0,
                    'id_bilik_kebal'            => $request->id_bilik_kebal     ?? 0,

                    'ids_mata_pelajaran'        => array_values(array_unique($request->ids_mata_pelajaran)) ?? [],
                    'id_status_pendaftaran'     => StatusPendaftaran::BELUM_DAFTAR,
                ]
            );

            $permohonan->id_status_pengesahan   = $request->id_status_pengesahan ?? StatusPengesahan::SAH;
            $permohonan->id_pusat               = $pusat->id;
            $permohonan->save();

            return $permohonan;
        });
    }

    public function semakPermohonanPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $data = $this->permohonanPusat
                ->whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
                    $query->where('id'  , $peperiksaan->id);
                })
                ->with($this->permohonanPusatRelationships)
                ->find($request->id_permohonan_pusat);

            return $data;
        });
    }

    public function senaraiPermohonanPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $data = $this->permohonanPusat
                ->whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
                    $query->where('id'  , $peperiksaan->id);
                })
                ->when($request->kod_sekolah, function ($query) use ($request) {
                    $query->whereHas('sekolah', function($query) use ($request) {
                        $query->where('kod_sekolah', $request->kod_sekolah);
                    });
                })
                ->when($request->id_sekolah, function ($query) use ($request) {
                    $query->where('id_sekolah', $request->id_sekolah);
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
                ->with($this->permohonanPusatRelationships)
                ->get();

            return $data;
        });
    }

    public function SenaraiPermohonanPusatLewat($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $data = PermohonanPendaftaranLewat
                ::whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
                    $query->where('id'  , $peperiksaan->id);
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
                ->whereNotNull('id_pusat')
                ->with($this->permohonanPusatLewatRelationships)
                ->get();

            return $data;
        });
    }

    public function senaraiPermohonanCalonPusat($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {

            $permohonan = PermohonanPusat::with(
                'calon.alamat',
                'calon.keturunan',
                'calon.warganegara',
                'calon.permohonan.pusat',
                'calon.JenisPendaftaran',
                'calon.permohonan.sekolah',
                'calon.dokumen.jenisDokumen',
                'calon.permohonan.statusPengesahan',
                'calon.permohonan.tahunPeperiksaan',

                'pusat.statusPendaftaran',
                'pusat.statusPendaftaranCalon',
            )
                ->where('id_peperiksaan', $peperiksaan->id)
                ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                ->where('id_status_pengesahan', $request->id_status_pengesahan ?? StatusPengesahan::SAH)
                ->get();

            return $permohonan;

        });
    }


    /*
    **  ========================== DAFTAR PUSAT ==========================
    */

    public function daftarPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {

            $pusat = $this->pusat->create
            (
                [
                    'id_tahun_peperiksaan'      => $peperiksaan->id_tahun_peperiksaan_semasa,

                    'id_sekolah'                => $request->id_sekolah         ?? 0,
                    'no_sekolah'                => $request->no_sekolah         ?? 0,
                    'kod_pusat'                 => $request->kod_pusat          ?? '',
                    'nama_pusat'                => $request->nama_pusat         ?? null,
                    'nama_pusat_i18n'           => $request->nama_pusat_i18n    ?? null,
                    'jumlah_calon'              => $request->jumlah_calon       ?? 0,
                    'id_bilik_kebal'            => $request->id_bilik_kebal     ?? 0,
                    'id_jenis_calon'            => $request->id_jenis_calon     ?? 0,
                    'ids_mata_pelajaran'        => $request->ids_mata_pelajaran ?? [],

                    'id_status_pendaftaran'     => StatusPendaftaran::BELUM_DAFTAR,
                ]
            );

            $pusat = $pusat->with($this->pusatRelationships)
                    ->find($pusat->id);

            $this->permohonanPusat->create
            (
                [
                    'id_peperiksaan'        => $peperiksaan->id,
                    'id_tahun_peperiksaan'  => $peperiksaan->id_tahun_peperiksaan_semasa,

                    'id_sekolah'            => $request->id_sekolah         ?? 0,
                    'id_pusat'              => $pusat->id                   ?? 0,
                    "bekalan_elektrik"      => $request->bekalan_elektrik   ?? '',
                    "bangku_calon"          => $request->bangku_calon       ?? '',
                    "bekalan_air"           => $request->bekalan_air        ?? '',
                    "meja_calon"            => $request->meja_calon         ?? '',
                    "telefon"               => $request->telefon            ?? '',
                    "tandas"                => $request->tandas             ?? '',
                    'alasan'                => $request->alasan             ?? '',

                    'id_status_pengesahan'  => StatusPengesahan::SAH,
                ]
            );

            return $pusat;
        });
    }

    public function PengesahanPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $data = $this->pusat->with($this->pusatRelationships)
                    ->find($request->id_pusat);

            $data->update(
                [
                    'nama_pusat'                => $request->nama_pusat,
                    'nama_pusat_i18n'           => $request->nama_pusat_i18n,
                    'id_status_pendaftaran'     => $request->id_status_pendaftaran,
                ]
            );

            return $data;
        });
    }

    public function kemaskiniPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $data = $this->pusat->with($this->pusatRelationships)
                    ->find($request->id_pusat);


            $data->update(
                [
                    'kod_pusat'                 => $request->kod_pusat,
                    'no_sekolah'                => $request->no_sekolah,
                    'id_sekolah'                => $request->id_sekolah,
                    'nama_pusat'                => $request->nama_pusat,
                    'nama_pusat_i18n'           => $request->nama_pusat_i18n,
                    'jumlah_calon'              => $request->jumlah_calon,
                    'id_jenis_calon'            => $request->id_jenis_calon,
                    'ids_mata_pelajaran'        => $request->ids_mata_pelajaran,
                    'id_status_pendaftaran'     => $request->id_status_pendaftaran,
                ]
            );

            return $data;
        });
    }

    public function semakPusatPeperiksaan($peperiksaan, $request)
    {

        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $data = $this->pusat
                ->whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
                    $query->where('id'  , $peperiksaan->id);
                })
                ->when($request->kod_pusat ?? '', function ($query) use ($request) {
                    $query->where('kod_pusat', $request->kod_pusat);
                })
                ->when($request->kod_sekolah ?? '', function ($query) use ($request) {
                    $query->whereHas('sekolah', function($query) use ($request) {
                        $query->where('kod_sekolah', $request->kod_sekolah ?? '');
                    });
                })
                ->when($request->id_pusat ?? '', function ($query) use ($request) {
                    $query->where('id', $request->id_pusat);
                })
                ->when($request->id_sekolah ?? '', function ($query) use ($request) {
                    $query->where('id_sekolah', $request->id_sekolah);
                })
                ->with($this->pusatRelationships)
                ->first();

            return $data;
        });
    }

    public function senaraiPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $query = $this->pusat
                ->whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
                    $query->where('id_peperiksaan'  , $peperiksaan->id);
                })
                ->when($request->kod_pusat ?? '', function ($query) use ($request) {
                    $query->where('kod_pusat', $request->kod_pusat);
                })
                ->when($request->kod_sekolah ?? '', function ($query) use ($request) {
                    $query->whereHas('sekolah', function($query) use ($request) {
                        $query->where('kod_sekolah', $request->kod_sekolah ?? '');
                    });
                })
                ->when($request->id_negeri ?? '', function ($query) use ($request) {
                    $query->whereHas('sekolah', function($query) use ($request) {
                        $query->where('id_negeri', $request->id_negeri ?? '');
                    });
                })
                ->when($request->id_pusat ?? '', function ($query) use ($request) {
                    $query->where('id', $request->id_pusat);
                })
                ->when($request->id_sekolah ?? '', function ($query) use ($request) {
                    $query->where('id_sekolah', $request->id_sekolah);
                })
                ->when($request->id_status_pendaftaran ?? '', function ($query) use ($request) {
                    $query->where('id_status_pendaftaran', $request->id_status_pendaftaran);
                })
                ->when($request->id_status_pendaftaran_calon ?? '', function ($query) use ($request) {
                    $query->where('id_status_pendaftaran_calon', $request->id_status_pendaftaran_calon);
                })
                ->when($request->nama_pusat ?? '', function ($query) use ($request) {
                    $query->where('nama_pusat', $request->nama_pusat);
                })
                ->when($request->nama_pusat_i18n ?? '', function ($query) use ($request) {
                    $query->where('nama_pusat_i18n', $request->nama_pusat_i18n);
                })
                ->when($request->id_jenis_calon ?? '', function ($query) use ($request) {
                    $query->where('jenisCalon.id', $request->id_jenis_calon);
                });

            $data = $query->with($this->pusatRelationships)
                ->when($request->id_sekolah, fn($q) => $q->where('id_jenis_calon', '!=', 13))
                ->get();

            return $data;
        });
    }

    public function senaraiSemuaPusatPeperiksaan($peperiksaan, $request)
    {
        return DB::transaction(function () use ($peperiksaan, $request)
        {
            $data = $this->pusat
                ->whereHas('tahunPeperiksaan.peperiksaan', function($query) use ($peperiksaan) {
                    $query->where('id'  , $peperiksaan->id);
                })
                ->when($request->id_status_pendaftaran ?? '', function ($query) use ($request) {
                    $query->where('id_status_pendaftaran', $request->id_status_pendaftaran);
                })
                ->where('id', '!=', $request->id_pusat)
                ->with($this->pusatRelationships)
                ->get();

            return $data;
        });
    }

    public function cetakanLaporanSemuaPusat()
    {
        // $pusats = Pusat::get();
        $pusats = $this->pusat->get();

        return view('pdf.cetakan-laporan-semua-pusat', compact('pusats'));
    }
}
