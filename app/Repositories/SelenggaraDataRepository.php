<?php

namespace App\Repositories;

use App\Models\Calon\RefCalon\JenisKeperluanKhas;
use App\Models\Calon\RefCalon\JenisPendaftaran;
use App\Models\UserRole;
use App\Models\Peperiksaan\RefPeperiksaan\JenisKemasukan;
use App\Models\Constant\Agama;
use App\Models\Constant\Bandar;
use App\Models\Constant\Daerah;
use App\Models\Constant\Jantina;
use App\Models\Constant\Keturunan;
use App\Models\Constant\Negeri;
use App\Models\Peperiksaan\JadualKerja;
use App\Models\Peperiksaan\Peperiksaan;
use App\Models\Peperiksaan\RefPeperiksaan\JenisCalon;
use App\Models\Peperiksaan\RefPeperiksaan\MataPelajaran;
use App\Models\Peperiksaan\RefPeperiksaan\Pusat;
use App\Models\Peperiksaan\RefPeperiksaan\Sekolah;
use App\Models\Peperiksaan\TahunPeperiksaan;

class SelenggaraDataRepository extends BaseRepository
{
    public function peperiksaan($peperiksaan, $request)
    {
        $data = Peperiksaan::select('id', 'kod_peperiksaan', 'keterangan', 'keterangan_panjang')
                ->when($request->id_peperiksaan ?? '', function ($query) use ($request)
                {
                    $query->where('id_peperiksaan', $request->id_peperiksaan);
                })
                ->get();

        return $data;
    }

    public function tahunPeperiksaan($peperiksaan, $request)
    {
        $data = TahunPeperiksaan::select('id', 'tahun')
                ->where('id_peperiksaan', $peperiksaan->id)
                ->get();

        return $data;
    }

    public function kumpulanKawalan($peperiksaan, $request)
    {
        $data = UserRole::select('id', 'name', 'description')
                ->get();

        return $data;
    }

    public function jenisKemasukan($peperiksaan, $request)
    {
        $data = JenisKemasukan::select('id', 'kod_kemasukan', 'keterangan', 'status')
                ->where('id_peperiksaan', $peperiksaan->id)
                ->get();

        return $data;
    }

    public function jenisKecacatan($peperiksaan, $request)
    {
        $data = JenisKeperluanKhas::select('id', 'kod_jenis_keperluan_khas', 'keterangan', 'status')
                ->get();

        return $data;
    }
    public function jenisCalon($peperiksaan, $request)
    {
        $data = JenisCalon::select('id', 'kod_jenis_calon', 'keterangan', 'status')
                ->where('id_peperiksaan', $peperiksaan->id)
                ->get();

        return $data;
    }

    public function mataPelajaran($peperiksaan, $request)
    {
        $data = MataPelajaran::where('id_peperiksaan', $peperiksaan->id)->get();

        return $data;
    }

    public function jenisJantina($peperiksaan, $request)
    {
        $data = Jantina::select('id', 'kod_jantina', 'keterangan', 'status')
                ->get();

        return $data;
    }

    public function jenisKeturunan($peperiksaan, $request)
    {
        $data = Keturunan::select('id', 'kod_keturunan', 'keturunan', 'status')
                ->get();

        return $data;
    }

    public function jenisPendaftaran(){
        $data = JenisPendaftaran::select('id', 'keterangan', 'status')
            ->get();

        return $data;
    }

    public function agama($peperiksaan, $request)
    {
        $data = Agama::select('id', 'kod_agama', 'keterangan', 'status')
                ->get();

        return $data;
    }

    public function daerah($peperiksaan, $request)
    {
        $data = Daerah::select('id', 'kod_daerah', 'keterangan', 'id_negeri',  'status')
                ->when($request->negeri_id ?? '', function ($query) use ($request)
                {
                    $query->where('id_negeri', $request->negeri_id);
                })
                ->orderBy('keterangan', 'ASC')
                ->get();

        return $data;
    }

    public function bandar($peperiksaan, $request)
    {
        $data = Bandar::select('id','keterangan', 'kod_daerah', 'id_negeri', 'status')
                ->when($request->id_negeri ?? '', function ($query) use ($request)
                {
                    $query->where('id_negeri', $request->id_negeri);
                })
                ->when($request->kod_daerah ?? '', function ($query) use ($request)
                {
                    $query->where('kod_daerah', $request->kod_daerah);
                })
                ->get();

        return $data;
    }

    public function sekolah($peperiksaan, $request)
    {
        $data = Sekolah::select('id', 'kod_sekolah', 'nama_sekolah', 'id_jenis_sekolah', 'id_ppd', 'id_bandar', 'id_daerah', 'id_negeri')
                ->when($request->id_negeri ?? '', function ($query) use ($request)
                {
                    $query->where('id_negeri', $request->id_negeri);
                })
                ->when($request->id_daerah ?? '', function ($query) use ($request)
                {
                    $query->where('id_daerah', $request->id_daerah);
                })
                ->when($request->id_bandar ?? '', function ($query) use ($request)
                {
                    $query->where('id_bandar', $request->id_bandar);
                })
                ->get();

        return $data;
    }

    public function negeri($peperiksaan, $request)
    {
        $data = Negeri::select('id', 'kod_negeri', 'keterangan')
                ->get();

        return $data;
    }

    public function pusat($peperiksaan, $request)
    {
        $data = Pusat::select('id', 'kod_pusat', 'nama_pusat', 'status')
                ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                ->where('id_status_pendaftaran', 1)
                ->where('id_jenis_calon', 13)
                ->get();

        return $data;
    }

    public function jadualKerja($peperiksaan, $request)
    {
        $data = JadualKerja::select('id', 'keterangan', 'tarikh_mula', 'tarikh_tamat', 'status')
                ->where('id_tahun_peperiksaan', $peperiksaan->id_tahun_peperiksaan_semasa)
                ->when($request->id, function($query) use ($request){
                    $query->where('id', $request->id);
                })
                ->get();

        return $data;
    }
}
